<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\GradeLevel;

class GradeLevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {    
        $aQvars = $request->query();
        $aRows = GradeLevel::get(); 
        return view('admin.gradelevel.index',compact('aRows'));
    }

    public function create()
    {
        $aRow = array();
        return view('admin.gradelevel.add',compact('aRow'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
             'name' => 'required|string|max:255|unique:grade_levels',        
        ]);

        GradeLevel::create($request->all());
        return redirect('admin/gradelevel')->with('message', 'New GradeLevel Added Successfully.');
    }

    public function edit($id)
    {
        $aRow = GradeLevel::findOrFail($id);
        return view('admin.gradelevel.add',compact('aRow'));
    }

   
    public function update(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
             'name' => 'required|string|max:255|unique:grade_levels,name,'.$id,       
        ]);

        $aRow = GradeLevel::find($id);
        $aRow->update($aVals);

        return redirect('admin/gradelevel')->with('message', 'GradeLevel updated Successfully.');
    }
    
    public function destroy($id)
    {
        $aRow = GradeLevel::findOrFail($id);
        $aRow->delete();        
        return redirect('admin/gradelevel')->with('message', 'GradeLevel deleted Successfully.');
    }
    
    
}
