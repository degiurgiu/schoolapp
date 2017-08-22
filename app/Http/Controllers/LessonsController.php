<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class LessonsController extends Controller
{
      public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $lessons = Lesson::orderby('id', 'desc')->paginate(5);
         return view('lessons.index')->with('lessons',$lessons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $courses = Course::all();
        return view('lessons.create')->with('courses',$courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'description' =>'required',
            'image_file'=>'image|nullable|max:1999',
            'uploads_files'=>'required|nullable|max:1999',
            ]);
        //Handel File Uploard
        if($request->hasFile('image_file')){// aici verificam daca face uplode la vreo imagine
           //Get file name with the extention
            $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extentsion
            $extention = $request->file('image_file')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore = $filename.'_'.time().'.'.$extention; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path = $request->file('image_file')->storeAs('public/image_file', $fileNameToSore); // pentru a face uplode imagini
            
            
            
        }else{
            $fileNameToSore = 'noimage.jpg';
        }
        
        if ($request->hasFile('uploads_files')) {

             $filenameWithExt2 = $request->file('uploads_files')->getClientOriginalName();
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just extentsion
            $extention2 = $request->file('uploads_files')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore2 = $filename2.'_'.time().'.'.$extention2; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path2 = $request->file('uploads_files')->storeAs('public/uploads_files', $fileNameToSore2); // pentru a face uplode imagini
            
        
    } else {
        $fileNameToSore2 = 'nofile.pdf';
    }


        

        // Create Post
       $lessons = new Lesson;
       $lessons->title = $request->input('title');
       $lessons->description = $request->input('description');
       $lessons->user_id = auth()->user()->id;
       $lessons->image_file = $fileNameToSore;
       $lessons->uploads_files = $fileNameToSore2;
       $lessons->save();
        
       
         if($request['courses'] != null){
            $dataSet = [];
           // foreach($request['courses'] as $courses){
                $dataSet[] = [
                    'lesson_id'=>$lessons->id,
                    'user_id'  => $lessons->user_id = auth()->user()->id,
                    'courses_id'=>$request['courses']
                    
                ];
           // }
             DB::table('lessons_has_courses')->insert($dataSet);
        }
       
       
       
       
    //Display a successful message upon save
        return redirect()->route('lessons.index')
            ->with('flash_message', 'Lessons,
             '. $lessons->profils.'Lessons created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        $courses = DB::table('lessons_has_courses')
            ->join('courses', 'lessons_has_courses.courses_id', '=', 'courses.id')
            ->join('lessons', 'lessons_has_courses.lesson_id', '=', 'lessons.id')
            ->select('lessons_has_courses.*', 'courses.courses')
            ->get();
        
         $lessons = Lesson::findOrFail($id);
         return view ('lessons.show')->with('lessons',$lessons)->with('courses', $courses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $courses = Course::all();
       $lessons = Lesson::findOrFail($id); //Find post of id = $id

        return view ('lessons.edit')->with('lessons',$lessons)->with('courses',$courses);
   
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
         //Validating title and body field
        $this->validate($request, [
            'title'=>'required|max:100',
            'description' =>'required',
        
            ]);
        //Handel File Uploard
        if($request->hasFile('image_file')){// aici verificam daca face uplode la vreo imagine
           //Get file name with the extention
            $filenameWithExt = $request->file('image_file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extentsion
            $extention = $request->file('image_file')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore = $filename.'_'.time().'.'.$extention; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path = $request->file('image_file')->storeAs('public/image_file', $fileNameToSore); // pentru a face uplode imagini
            
            
            
        }else{
            $fileNameToSore = 'noimage.jpg';
        }
        
        if ($request->hasFile('uploads_files')) {

             $filenameWithExt2 = $request->file('uploads_files')->getClientOriginalName();
            //Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            //Get just extentsion
            $extention2 = $request->file('uploads_files')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore2 = $filename2.'_'.time().'.'.$extention2; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path2 = $request->file('uploads_files')->storeAs('public/uploads_files', $fileNameToSore2); // pentru a face uplode imagini
            
        
    } else {
        $fileNameToSore2 = 'nofile.pdf';
    }


        

        
       $lessons = Lesson::find($id);
       $lessons->title = $request->input('title');
       $lessons->description = $request->input('description');
       $lessons->user_id = auth()->user()->id;
       if($request->hasFile('image_file')){
            $lessons->image_file = $fileNameToSore;
        }
       if($request->hasFile('uploads_files')){
            $lessons->uploads_files = $fileNameToSore2;
        }
       $lessons->save();
        
       
//         if($request['courses'] != null){
//            $dataSet = [];
//           // foreach($request['courses'] as $courses){
//                $dataSet[] = [
//                    'lesson_id'=>$lessons->id,
//                    'user_id'  => $lessons->user_id = auth()->user()->id,
//                    'courses_id'=>$request['courses']
//                    
//                ];
//           // }
//             DB::table('lessons_has_courses')
//                     ->update($dataSet);
//        }
       
       
       
       
    //Display a successful message upon save
        return redirect()->route('lessons.show', 
            $lessons->id)->with('flash_message', 
            'Lesson, '. $lessons->title.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $lessons = Lesson::find($id);
           //Chack for correct user
        if(auth()->user()->id !== $lessons->user_id ){ // aici verificam daca id postului se potriveste cu id userului care a creat postul
            return redirect('/lessons')->with('error', 'Unauthorized Page');
        }
        
        if($lessons->image_file != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/image_file/'.$lessons->image_file);
        }
        if($lessons->uploads_files != 'nofile.pdf'){
            //Delete image
            Storage::delete('public/uploads_files/'.$lessons->uploads_files);
        }
        
        $lessons->delete();
        return redirect('/lessons')->with('success','Lessons Remove');
    }
}
