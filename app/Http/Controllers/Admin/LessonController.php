<?php

namespace App\Http\Controllers\Admin;

use App\CaseTable;
use App\Moodle\CaseTbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Lesson;
use App\Subject;
use App\ResourceType;
use App\GradeLevel;
use Illuminate\Support\Facades\File;

use App\Libs\Upload;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Storage;

class LessonController extends Controller
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
        return view('admin.lesson.index',compact('aRows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aRow = array();
        $subjects = Subject::all();
        $resource_types = ResourceType::all();
        $grade_levels = GradeLevel::all();
        //$short_codes = CaseTbl::where('short_code', '!=', null)->where('short_code', '!=', 'duplicate')->get();
        $short_codes = CaseTable::all();
        return view('admin.lesson.add',compact('aRow','subjects', 'grade_levels','short_codes', 'resource_types'));
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
    public function store(Request $request)
    {

        $aVals = $request->all();
        $this->validate($request, [
            'name' => 'required|max:255|unique:lessons,name',
            'subject_id' => 'required',
            'grade_levels' => 'required',
            'objective' => 'required',
            'description' => 'required',
        ]);


        //store image
        if($request->hasFile('image')){

            $lessonImage = time() . 'lessonimage.' . request()->image->getClientOriginalExtension();
            $lessonName = '/lessonImages/' . $lessonImage;

            if(File::exists($lessonName)) {
                File::delete($lessonName);
            }
            request()->image->move('public/lessonImages/', $lessonImage);
            $aVals['image_url'] = $lessonName;
        }
        if ($request->hasFile('lesson')) {
            $file_origin = request()->lesson->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $lessons = time() . '_' . $file_name . '.' .request()->lesson->getClientOriginalExtension();
            $lessonName = 'public/lessons/' . $lessons;



            if(File::exists($lessonName)) {
                File::delete($lessonName);
            }
            request()->lesson->move('public/lessons/', $lessons);
            $aVals['lessons_url'] = $lessonName;
            $extracted_file_url = 'public/lessons/' . time() . '_' . $file_name;

            \Zipper::make($lessonName)->extractTo($extracted_file_url);
            $full_html_url = $this->getSubDirectories($extracted_file_url) . '/index.html';


            $contents = file_get_contents($full_html_url);
            if ($request->resource_type_id != 4) {
                $custom_js_url = 'public/commonjs/custom.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);    
            } else {
                $contents = file_get_contents($full_html_url);
                $custom_js_url = 'public/commonjs/custom1.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);

            }
            $aVals['lessons_url'] = $full_html_url;
            Dropbox::files()->upload('lessons', $lessonName);
        }
        if ($request->hasFile('quiz')) {
            $file_origin = request()->quiz->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->quiz->getClientOriginalExtension();
            $quizName = 'public/quizzes/' . $quiz;



            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->quiz->move('public/quizzes/', $quiz);
            $aVals['quiz_url'] = $quizName;
            $extracted_file_url = 'public/quizzes/' . time() . '_' . $file_name;

            \Zipper::make($quizName)->extractTo($extracted_file_url);
            $full_html_url = $this->getSubDirectories($extracted_file_url) . '/index.html';

            if ($request->resource_type_id != 4) {
                $contents = file_get_contents($full_html_url);
                $custom_js_url = 'public/commonjs/custom.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);
            } else {
                $contents = file_get_contents($full_html_url);
                $custom_js_url = 'public/commonjs/custom1.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);

            }
            $aVals['quiz_url'] = $full_html_url;
            Dropbox::files()->upload('quizzes', $quizName);
        }

        if ($request->hasFile('cptx')) {


            $file_origin = request()->cptx->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->cptx->getClientOriginalExtension();
            $quizName = 'public/cptxs/' . $quiz;

            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->cptx->move('public/cptxs/', $quiz);
            $aVals['cptx_url'] = $quizName;
            Dropbox::files()->upload('cptxs', $quizName);
        }

        if ($request->hasFile('quiz_cptx')) {


            $file_origin = request()->cptx->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->cptx->getClientOriginalExtension();
            $quizName = 'public/quiz_cptxs/' . $quiz;

            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->quiz_cptx->move('public/quiz_cptxs/', $quiz);
            $aVals['quiz_cptx_url'] = $quizName;
            Dropbox::files()->upload('quiz_cptxs', $quizName);
        }

        Lesson::create($aVals);
        return redirect()->route("admin.lesson.index")->with('message', 'Lesson was successful added!');
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
        $aRow = Lesson::findOrFail($id);
        $subjects = Subject::all();
        $grade_levels = GradeLevel::all();
        //$short_codes = CaseTbl::where('short_code', '!=', null)->where('short_code', '!=', 'duplicate')->get();
        $short_codes = CaseTable::all();
        $resource_types = ResourceType::all();
        return view('admin.lesson.add',compact('aRow','subjects', 'grade_levels', 'short_codes', 'resource_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aVals = $request->except('old_lesson_file');
        $this->validate($request, [
            'name' => 'required|max:255|unique:lessons,name,'.$id,
            'subject_id' => 'required',
            'grade_levels' => 'required',
            'objective' => 'required',
            'description' => 'required',
        ]);

        //store image
        if($request->hasFile('image')){
            $lessonImage = time() . 'lessonimage.' . request()->image->getClientOriginalExtension();
            $lessonName = '/lessonImages/' . $lessonImage;

            if(File::exists($lessonName)) {
                File::delete($lessonName);
            }
            request()->image->move('public/lessonImages/', $lessonImage);
            $aVals['image_url'] = $lessonName;
        }

        if ($request->hasFile('lesson')) {

            $file_origin = request()->lesson->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $lessons = time() . '_' . $file_name . '.' .request()->lesson->getClientOriginalExtension();
            $lessonName = 'public/lessons/' . $lessons;

            if(File::exists($lessonName)) {
                File::delete($lessonName);
            }
            request()->lesson->move('public/lessons/', $lessons);
            $aVals['lessons_url'] = $lessonName;
            $extracted_file_url = 'public/lessons/' . time() . '_' . $file_name;

            \Zipper::make($lessonName)->extractTo($extracted_file_url);
            $full_html_url = $this->getSubDirectories($extracted_file_url) . '/index.html';

            if ($request->resource_type_id != 4) {
                $contents = file_get_contents($full_html_url);
                $custom_js_url = 'public/commonjs/custom.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);
            } else {
                $contents = file_get_contents($full_html_url);
                $custom_js_url = 'public/commonjs/custom1.js';
                $custom_content = file_get_contents($custom_js_url);
                $pos = strpos($contents, '<noscript');
                $full_contents = substr_replace($contents, $custom_content, $pos, 0);
                file_put_contents($full_html_url, $full_contents);
            }
            $aVals['lessons_url'] = $full_html_url;

            Dropbox::files()->upload('lessons', $lessonName);

            $old_url = explode('/', $request->old_lesson_file);
            if (count($old_url) >= 3) {
                $old_file_dir = $old_url[0] . '/' . $old_url[1] . '/' . $old_url[2];
                File::deleteDirectory($old_file_dir);
            }
        }

        if ($request->hasFile('quiz')) {


            $file_origin = request()->quiz->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->quiz->getClientOriginalExtension();
            $quizName = 'public/quizzes/' . $quiz;

            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->quiz->move('public/quizzes/', $quiz);
            $aVals['quiz_url'] = $quizName;
            $extracted_file_url = 'public/quizzes/' . time() . '_' . $file_name;

            \Zipper::make($quizName)->extractTo($extracted_file_url);
            $full_html_url = $this->getSubDirectories($extracted_file_url) . '/index.html';

            $aVals['quiz_url'] = $full_html_url;

            Dropbox::files()->upload('quizzes', $quizName);

            $old_url = explode('/', $request->old_lesson_file);
            if (count($old_url) >= 3) {
                $old_file_dir = $old_url[0] . '/' . $old_url[1] . '/' . $old_url[2];
                File::deleteDirectory($old_file_dir);
            }
        }

        if ($request->hasFile('cptx')) {


            $file_origin = request()->cptx->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->cptx->getClientOriginalExtension();
            $quizName = 'public/cptxs/' . $quiz;

            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->cptx->move('public/cptxs/', $quiz);
            $aVals['cptx_url'] = $quizName;
            Dropbox::files()->upload('cptxs', $quizName);
        }

        if ($request->hasFile('quiz_cptx')) {

            $file_origin = request()->cptx->getClientOriginalName();
            $file_name = pathinfo($file_origin, PATHINFO_FILENAME);
            $quiz = time() . '_' . $file_name . '.' .request()->cptx->getClientOriginalExtension();
            $quizName = 'public/quiz_cptxs/' . $quiz;

            if(File::exists($quizName)) {
                File::delete($quizName);
            }
            request()->quiz_cptx->move('public/quiz_cptxs/', $quiz);
            $aVals['quiz_cptx_url'] = $quizName;
            Dropbox::files()->upload('quiz_cptxs', $quizName);
        }

        $aRow = Lesson::find($id);
        $aRow->update($aVals);
        return redirect()->route("admin.lesson.index")->with('message', 'Lesson was successful edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aRow = Lesson::findOrFail($id);
        $aRow->delete();
        return redirect()->route("admin.lesson.index")->with('message', 'Lesson deleted Successfully.');
    }
}
