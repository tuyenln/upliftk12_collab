<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Lesson;
use App\Note;
use Illuminate\Support\Facades\File;

use App\Libs\Upload;
use Storage;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $aQvars = $request->query();
        $aRows = Lesson::get();
        return view('admin.note.index',compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $aRow = array();
        return view('admin.note.add',compact('aRow', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSubDirectories($dir)
    {
        $subDir = array();
        // Get and add directories of $dir
        $directories = array_filter(glob($dir), 'is_dir');

        // Foreach directory, recursively get and add sub directories
        foreach ($directories as $directory) {
            if (in_array("index.html", scandir($directory))) {
                return $directory;
            }

            return $this->getSubDirectories($directory.'/*');
        }
    }
    public function store(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
            'notes' => 'required',
        ]);

        $note = Note::create($aVals);
        $lesson = Lesson::find($id);
        $arr = $lesson->note_list;
        $arr[] = $note->id;
        $lesson->note_list = $arr;
        $lesson->save();


        return redirect()->route("admin.note.index")->with('message', 'Note was successful added!');
    }
    public function ajaxStore(Request $request, $id)
    {
        $aVals = $request->all();
        $this->validate($request, [
            'notes' => 'required',
        ]);

        $note = Note::create($aVals);
        $lesson = Lesson::find($id);
        $arr = $lesson->note_list;
        $arr[] = $note->id;
        $lesson->note_list = $arr;
        $lesson->save();


        return "OK";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aRow = Note::where('lesson_id', $id)->first();
        return view('admin.note.list',compact('aRow', 'id'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'notes' => 'required',
        ]);
        $note = Note::where('lesson_id', $id)->first();
        if (empty($note)) {
            $record = array(
                'lesson_id' =>  $id,
                'notes'     =>  $request->notes
            );
            Note::create($record);
        } else {
            $note->update(['notes' => $request->notes]);
        }
        return 'success';
        //return redirect()->route("admin.note.index")->with('message', 'Note was successful edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lesson_id, $id)
    {
    }
}
