<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

use Auth;
use Session;
use Hash;
use Gate;
use Validator;
use DB;
use View;
use App\Course;
use App\QuizData;
use App\SurveyData;

class HomeController extends Controller
{

    public function testquiz(Request $request){
    	if($request->has('Filedata')){
	    	$string = $request->Filedata;

	    	$xml = simplexml_load_string($string);
			$json = json_encode($xml);
			$data = json_decode($json,TRUE);

            $var = [];
            foreach($data as $key=>$ele){
                if(isset($ele['@attributes'])){
                    $var[$key] = $ele['@attributes']['value'];
                }
                else {
                    $var_child = [];
                    foreach($ele as $key_1=>$e){
                        if(isset($e['@attributes'])){
                            $var_child[$key_1] = $e['@attributes']['value'];
                        }else{
                            $var_child_child = [];
                            /*foreach($e as $key_2=>$chau){
                              if(isset($chau['@attributes'])){
                                $var_child_child[$key_2] = $chau['@attributes']['value'];
                              }
                            }*/
                            $var_child[$key_1] = $var_child_child;
                        }
                    }
                    $var[$key] = $var_child;
                }
            }
            if (empty($data['Result']['CoreData']['Score'])) {
                //$interactions = json_encode($data['Result']['InteractionData']['Interactions']);
                foreach($data['Result']['InteractionData']['Interactions'] as $interaction) {
                    $result = array();
                    $result['question_name'] = $interaction['InteractionID']['@attributes']['value'];
                    $question = explode('_', $result['question_name']);
                    $question[0] = '';
                    $result['question_name'] = implode(" ", $question);
                    $result['sv_answer'] = $interaction['StudentResponse']['@attributes']['value'];
                    $result['student_id'] = $var['LearnerID'];
                    $result['lesson_id'] = $var['LearnerName'];
                    $s_data = SurveyData::where('lesson_id', $result['lesson_id'])->where('student_id', $result['student_id'])->where('question_name', $result['question_name'])->first();
                    /*if (!empty($s_data)) {
                        SurveyData::where('lesson_id', $result['lesson_id'])->where('student_id', $result['student_id'])->where('question_name', $result['question_name'])->update($result);
                    } else {
                        SurveyData::create($result);
                    }*/
                    $today = date('Y-m-d');
                    if (!empty($s_data) && date('Y-m-d', $s_data['created_at']) >= $today) {
                        return response()->jsoin('Error');
                    }
                    SurveyData::create($result);
                }
                return response()->json('Success');              
            } else {
                $var['Result']['CoreData']['Status'] = ($data['Result']['CoreData']['Status']['@attributes']['value']);
                $var['Result']['CoreData']['Score'] = ($data['Result']['CoreData']['Score']['@attributes']['value']);
    
    
                $array = [];
                $array['student_id'] = $var['LearnerID'];
                $array['invite_id'] = $var['LearnerName'];
                $array['quiz_name'] = $var['LessonName'];
                $array['quiz_attempts'] = $var['QuizAttempts'];
                $array['total_questions'] = $var['TotalQuestions'];
                $array['status'] = $var['Result']['CoreData']['Status'];
                $array['score'] = $var['Result']['CoreData']['Score'];
                
    
                $cnt = QuizData::where('student_id', $array['student_id'])->where('invite_id', $array['invite_id'])->count();
                if($cnt > 0) {
                    //return response()->json('Error');
                    QuizData::where('student_id', $array['student_id'])->where('invite_id', $array['invite_id'])->update($array);
                } else {
                    QuizData::create($array);
                }
                return response()->json('Success');
            }

	        // return response()->json([$array], 200);
        }else if($request->has('data')) {
    	    $data = $request->data;
            $var = [];
            foreach($data as $key=>$ele){
                if(isset($ele['@attributes'])){
                    $var[$key] = $ele['@attributes']['value'];
                }
                else {
                    $var_child = [];
                    foreach($ele as $key_1=>$e){
                        if(isset($e['@attributes'])){
                            $var_child[$key_1] = $e['@attributes']['value'];
                        }else{
                            $var_child_child = [];
                            /*foreach($e as $key_2=>$chau){
                              if(isset($chau['@attributes'])){
                                $var_child_child[$key_2] = $chau['@attributes']['value'];
                              }
                            }*/
                            $var_child[$key_1] = $var_child_child;
                        }
                    }
                    $var[$key] = $var_child;
                }
            }
            $var['Result']['CoreData']['Status'] = ($data['Result']['CoreData']['Status']['@attributes']['value']);
            $var['Result']['CoreData']['Score'] = ($data['Result']['CoreData']['Score']['@attributes']['value']);

            $array = [];
            $array['student_id'] = $var['LearnerID'];
            $array['invite_id'] = $var['LearnerName'];
            $array['quiz_name'] = $var['LessonName'];
            $array['quiz_attempts'] = $var['QuizAttempts'];
            $array['total_questions'] = $var['TotalQuestions'];
            $array['status'] = $var['Result']['CoreData']['Status'];
            $array['score'] = $var['Result']['CoreData']['Score'];

            $cnt = QuizData::where('student_id', $array['student_id'])->where('invite_id', $array['invite_id'])->count();
            if($cnt > 0) {
                QuizData::where('student_id', $array['student_id'])->where('invite_id', $array['invite_id'])->update($array);

                //return response()->json('Error');
            } else {
                QuizData::create($array);
            }
    		return response()->json('Success');
        }

    	return response()->json('Error');
    }

    public function storeQuizData(Request $request){
    	if($request->has('Filedata')){
	    	$string = $request->Filedata;

	    	$data = [
	    		'user_id' => Auth::id() ?? 1,
	    		'data' => $string
	    	];
	    	QuizData::create($data);
    		return response()->json('Success');
        }

    	return response()->json('Error');
    }
}
