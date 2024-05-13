<?php
namespace App\Http\Controllers\Principal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Role\UserRole;
use Illuminate\Support\Facades\Hash;
use App\SchoolClass;

class StudentController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        abort(404);
        $aQvars = $request->query();
        $aRows = User::get()->where('user_type','=',UserRole::STUDENT)->where('parent_user_id','=',Auth::user()->id);
        return view('principal.student.list',compact('aRows'));
    }

    public function uploadcsv(Request $request)
    {
        $user = Auth::user();
    	if($request->file('uploadcsv'))
		{
			$path = $request->file('uploadcsv')->getRealPath();
			$aVals = array_map('str_getcsv', file($path));
			array_shift($aVals);

			if($aVals)
			{
				foreach ($aVals as $key => $aVal) {
					$aChk = User::where('user_type','=',UserRole::STUDENT)->where('student_id','=',$aVal[0])->first();
					if(!$aChk)
					{
						$aVal['name'] = $aVal[1];
						$aVal['mname'] = $aVal[2];
						$aVal['lname'] = $aVal[3];
						$aVal['student_id'] = $aVal[0];
						$aRow = $this->preparevalue($aVal);
	        			User::create($aRow);
	        			//return redirect('principal/student')->with('message', 'New Student Added Successfully.');
					}
				}

			}
			return redirect('principal/student')->with('message', 'New Student Added Successfully.');
		}

        return view('principal.student.uploadcsv', compact('user'));
    }

    public function create()
    {
        $aRow = array();
        $user = Auth::user();
        return view('principal.student.add',compact('aRow', 'user'));
    }
    public function store(Request $request)
    {
        // print_r($request->all());
        // die;

        $this->validate($request, [
             'student_id' => 'required|string|max:255|unique:users',
        ]);

        $aRows = $this->preparevalue($request->all());
        User::create($aRows);
        return redirect('principal/home')->with('message', 'New Student Added Successfully.');
    }

    public function edit($id)
    {
        $aRow = User::findOrFail($id);
        $user = Auth::user();
        return view('principal.student.add',compact('aRow', 'user'));
    }


    public function update(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
             'student_id' => 'required|string|max:255|unique:users,student_id,'.$id,
        ]);

        $aRow = User::find($id);
        $aVals = $this->preparevalue($aVals,$id);
        $aRow->update($aVals);

        return redirect('principal/home')->with('message', 'Student updated Successfully.');
    }

    public function destroy($id)
    {

        // delete student from class
        $aClasses = SchoolClass::whereJsonContains('student_lists', $id)->get();
        if($aClasses)
        {
            foreach ($aClasses as $aClass) {
                SchoolClass::deleteStudent($aClass->id,$id);
            }
        }
        $aRow = User::findOrFail($id);
        $aRow->delete();
        return redirect('principal/student')->with('message', 'Student deleted Successfully.');
    }

    private function preparevalue($aRows,$aID = 0)
    {
    	if($aID > 0)
    	{
    		$newId = $aID;
    	}
    	else
    	{
    		$lastRecord = User::orderBy('created_at', 'desc')->first();
    		$lastId = $lastRecord->id;
    		$newId = $lastId+1;
    	}

    	$aUser = array();
    	$username = strtolower($aRows['name'].$newId);

    	$aUser['name'] = $aRows['name'];
    	$aUser['mname'] = $aRows['mname'];
    	$aUser['lname'] = $aRows['lname'];
    	$aUser['username'] = $username;
    	$aUser['email'] = $username.'@upliftk12.com';
    	$aUser['password'] = Hash::make($username);
    	$aUser['user_type'] = UserRole::STUDENT;
    	$aUser['student_id'] = $aRows['student_id'];
        $aUser['parent_user_id'] = Auth::user()->id;
    	return $aUser;
    }

}
