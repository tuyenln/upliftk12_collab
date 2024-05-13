<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use App\User;
use App\Assessment;
use App\PlacementTest;
use App\SpeechResult;
use App\SpeechWord;
use App\Syllable;
use App\Phoneme;

use Storage;
use Str;

use App\SpeechacePhp\RenderData;
use App\SpeechacePhp\ProcessData;

class AssessmentController extends Controller
{
    protected $user;
    public function __construct()
    {
      $this->user = Auth::user();
    }

    public function index($id)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);
      return view('assessment.index', compact('user', 'assessment'));
    }
   
    public function sections($id)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);

      return view('assessment.sections', compact('user', 'assessment'));
    }
   
    public function sectionsStep($id, $step)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);
      $section = $assessment->sections[$step-1] ?? false;
      if(!$section) return abort(404);

      // find or create new placement test
      $pl = new PlacementTest();
      $params = [
        'user_id' => $user->id,
        'assessment_id' => $assessment->id,
        'section_id' => $step,
      ];
      $placement_test = $pl->firstOrCreate($params);

      return view('assessment.section-quiz', compact('user', 'assessment', 'section', 'step', 'placement_test'));
    }
   
    public function sectionsStepNext(Request $request, $id, $step)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);
      $section = $assessment->sections[$step-1] ?? false;
      if(!$section) return abort(404);
      $words = explode(',', $section['words']);
      $word = $words[$request->position + 1] ?? '';
      $end = ($word == end($words)) ? true : false;
      return response()->json([
        'status' => 'success',
        'word' => $word,
        'end' => $end
      ]);
      
    }
   
    public function ajaxSpeech(Request $request, $id)
    {
      $user = Auth::user();
      // find or create new placement test
      $placement_test = PlacementTest::findOrFail($id);
      if(!$user || !$placement_test) return response()->json([
                                          'status' => 'error',
                                          'messsage' => 'Not found'
                                        ]);
      $text = $request->text ?? "";

      $result = new ProcessData($text, $_FILES['audio_data']);

    	if($result->checkError()){
        return array(
          'status' => 'error',
          'messsage' => $result->results["detail_message"]
        );
      } else {

        $cal = $result->calculateTotals();
        if(!$cal){
          return array(
            'status' => 'error',
            'messsage' => "Error"
          );
        }

        $spw = new SpeechWord();
        $syl = new Syllable();
        $phm = new Phoneme();

        $detailed = $cal['detailed'];
        if($words = $detailed['words']){
          //remove old data
          if($placement_test->passage_id){
            $placement_test->speech_words()->delete();
          }
          foreach ($words as $key => $word_item) {
            $params = [
              'user_id' => $user->id,
              'pt_id' => $placement_test->id,
              'word' => $word_item['word'],
              'score' => $word_item['quality_score']
            ];
            $spw = $spw->create($params);
          }
        }
        if($syllables = $detailed['syllables']){
          //remove old data
          if($placement_test->passage_id){
            $placement_test->syllables()->delete();
          }
          foreach ($syllables as $key => $syllable) {
            $params = [
              'user_id' => $user->id,
              'pt_id' => $placement_test->id,
              'syllable' => $syllable['letters'],
              'score' => $syllable['quality_score']
            ];
            $syl = $syl->create($params);
          }
        }
        if($phonemes = $detailed['phonemes']){
          //remove old data
          if($placement_test->passage_id){
            $placement_test->phonemes()->delete();
          }
          foreach ($phonemes as $key => $phoneme) {
            $params = [
              'user_id' => $user->id,
              'pt_id' => $placement_test->id,
              'phoneme' => $phoneme['phone'],
              'score' => $phoneme['quality_score']
            ];
            $phm = $phm->create($params);
          }
        }

        //remove detail params
        unset($cal['detailed']);

        //store audio passage
        if($placement_test->passage_id){
          $storage = Storage::disk('public');
          $blobInput = $request->file('audio_data');
          $file_name = 'audio/'.Str::slug($user->full_name).'-'.time().'.mp3';
          $storage->put($file_name, file_get_contents($blobInput));
          $url = Storage::url($file_name);
        }

        $sr = new SpeechResult();
        $speech_result = $sr->firstOrCreate(["user_id" => $user->id,"pt_id" => $placement_test->id,"word" => $text]);
        $speech_result->result = $cal;
        $speech_result->audio_url = $url ?? null;
        $speech_result->save();
        
        $assessment = $placement_test->assessment;
        $link = route('assessment.passage.success', $assessment->id);
        return array(
          'status' => 'success',
          'url' => $link,
          'data' => $result->calculateTotals()
        );
      }
    }

   
    public function passageSuccess($id)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);
      if(!$assessment) return abort(404);

      return view('assessment.passage-success', compact('user', 'assessment'));
    }
   
    public function passageStep($id, $step)
    {
      $user = Auth::user();
      $assessment = Assessment::findOrFail($id);
      $passage = $assessment->passages[$step-1] ?? false;
      if(!$passage) return abort(404);

      // find or create new placement test
      $pl = new PlacementTest();
      $params = [
        'user_id' => $user->id,
        'assessment_id' => $assessment->id,
        'passage_id' => $step,
      ];
      $placement_test = $pl->firstOrCreate($params);

      return view('assessment.passage-quiz', compact('user', 'assessment', 'passage', 'step', 'placement_test'));
    }




}