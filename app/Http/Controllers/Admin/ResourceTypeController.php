<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ResourceType;

class ResourceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $aQvars = $request->query();
        $aRows = ResourceType::get();
        return view('admin.resource_type.index',compact('aRows'));
    }

    public function create()
    {
        $aRow = array();
        return view('admin.resource_type.add',compact('aRow'));
    }
    public function store(Request $request)
    {

         $this->validate($request, [
             'name' => 'required|string|max:255|unique:subjects',
        ]);

        ResourceType::create($request->all());
        return redirect('admin/resource_type')->with('message', 'New Subject Added Successfully.');
    }

    public function edit($id)
    {
        $aRow = ResourceType::findOrFail($id);
        return view('admin.resource_type.add',compact('aRow'));
    }


    public function update(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
             'name' => 'required|string|max:255|unique:subjects,name,'.$id,
        ]);

        $aRow = ResourceType::find($id);
        $aRow->update($aVals);

        return redirect('admin/subject')->with('message', 'Subject updated Successfully.');
    }

    public function destroy($id)
    {
        $aRow = ResourceType::findOrFail($id);
        $aRow->delete();
        return redirect('admin/subject')->with('message', 'Subject deleted Successfully.');
    }


}
