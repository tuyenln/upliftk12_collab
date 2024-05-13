<?php
namespace App\Http\Controllers\Admin;
use App\CaseTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use Auth;
use App\Contact;
use App\Subject;
use App\GradeLevel;
use App\Assessment;
use App\Lesson;
use App\DemoRequest;

use App\Moodle\CaseTbl;
use Dcblogdev\Dropbox\Facades\Dropbox;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $districts=DB::table('districts')->where('status',1)->get();
        //return view('admin.home');
        return view('admin.test');
    }

    public function addprincipal()
    {
        $districts=DB::table('districts')->where('status',1)->get();
        return view('admin.addprincipal',compact('districts'));
    }

    public function contact()
    {
        $contacts = Contact::all();
        return view('admin.contact', compact('contacts'));
    }

    public function assessments()
    {
        $aRows = Assessment::get();
        $subjects = Subject::all();
        $grade_levels = GradeLevel::all();
        return view('admin.assessment.index', compact('aRows', 'subjects', 'grade_levels'));
    }

    public function addAssessment()
    {
        $aRow = array();
        $subjects = Subject::all();
        $grade_levels = GradeLevel::all();
        return view('admin.assessment.add', compact('aRow', 'subjects', 'grade_levels'));
    }

    public function storeAssessment(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:6|max:255|unique:assessments',
            'subject' => 'required',
            'grade_level' => 'required',
        ]);
        $request['subject'] = (int) $request->subject;
        $request['sections'] = $request->sections ?? null;
        $request['passages'] = $request->passages ?? null;

        Assessment::create($request->all());
        return redirect()->route('admin.assessment')->with('message', 'New Assessment Added Successfully.');
    }

    public function editAssessment($id)
    {
        $aRow = Assessment::findOrFail($id);
        $subjects = Subject::all();
        $grade_levels = GradeLevel::all();
        return view('admin.assessment.add',compact('aRow', 'subjects', 'grade_levels'));
    }


    public function updateAssessment(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:subjects,name,'.$id,
            'subject' => 'required',
            'grade_level' => 'required',
        ]);

        $request['subject'] = (int) $request->subject;
        $request['sections'] = $request->sections ?? null;
        $request['passages'] = $request->passages ? array_values($request->passages) : null;
        // dd($request['passages']);

        $aRow = Assessment::find($id);
        $aRow->update($request->all());

        return redirect()->route('admin.assessment')->with('message', 'Assessment updated Successfully.');
    }

    public function destroyAssessment($id)
    {
        $aRow = Assessment::findOrFail($id);
        $aRow->delete();
        return redirect()->route('admin.assessment')->with('message', 'Assessment deleted Successfully.');
    }

    /* add function get ass*/
     public function listAssessment()
    {
        $aRow = array();
        $subjects = Subject::all();
        $grade_levels = GradeLevel::all();
        return view('admin.assessment.ListPage', compact('aRow', 'subjects', 'grade_levels'));
    }

    public function library() {
         $results =  Dropbox::files()->listContents('cptxs');
         $cptxs = Lesson::where('cptx_url', '!=', null)->get();
         $quiz_cptxs = Lesson::where('quiz_cptx_url', '!=', null)->get();
         $grades = GradeLevel::all();
         $subjects = Subject::all();

         return view('admin.library', compact('cptxs', 'grades', 'subjects', 'quiz_cptxs'));
    }

    public function demo_requests() {
         $aRows = DemoRequest::all();
         return view('admin.demo_requests', compact('aRows'));
    }

    public function lesson_log() {
        
    }

    public function manageShortcode() {
        /*this is custom file get list of case*/
        /*ini_set('max_execution_time', 600); //300 seconds = 5 minutes
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://teks-api.texasgateway.org/ims/case/v1p0/CFPackages/bc997e24-7f3b-5df0-a0cd-3a8ac9cf0e2e",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer dXBsaWZ0azEyLmNvbTpSbS1pcj9LV2FBd2xT",
            "Content-Type: text/plain"
          ),
        ));*/
        /*$uniqueAddresses = [];
            $duplicates = [];

        CaseTbl::all()
        ->map(function(CaseTbl $venue) use (&$uniqueAddresses, &$duplicates) {
            $address = sprintf("%s",
                $venue->case_data);

            if (in_array($address, $uniqueAddresses)) {
                // address is a duplicate
                $duplicates[] = $venue->id;
            } else {
                $uniqueAddresses[] = $address;
            }
        });

        CaseTbl::whereIn('id', $duplicates)->delete();*/

        /*$response = curl_exec($curl);
        curl_close($curl);
        $row=json_decode($response,true);
        $collection = collect($row['CFItems']);*/
        /*foreach ($collection->all() as $t) {
            CaseTable::create($t);
        }
        return 'OK';*/
        /*$aRows = CaseTbl::where('case_data', '!=', '')->where('case_level', '!=', '')
                ->orderBy('case_level')
                ->distinct('case_data')
                ->paginate(20);*/
        $aRows = CaseTable::paginate(20);
        return view('admin.shortcode', compact('aRows'));
    }

    public function updateShortcode(Request $request) {
        $validator = Validator::make($request->all(), array(
            'id' => 'required',
            'value' => 'required',
        ));
        if ($validator->fails())
        {
            return response()->json(['message'=> $validator->errors()->first()], 404);
        }
        // check unique
        $check = CaseTbl::where('short_code', $request->value)->whereNotIn('id', [$request->id])->count();
        if($check > 0){
            return response()->json(['message'=>'Shortcode must be unique'], 404);
        }
        $aRow = CaseTbl::findOrFail($request->id);
        $aRow->short_code = $request->value;
        $aRow->save();
        return response()->json(['message'=>'Success']);
    }

}
