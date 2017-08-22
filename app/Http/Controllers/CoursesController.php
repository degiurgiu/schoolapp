<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Profiles;
use App\Porfilcourses;
use Illuminate\Support\Facades\DB;
class CoursesController extends Controller
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
        $courses = Course::orderby('id', 'desc')->paginate(20); //show only 5 items at a time in descending order

        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
            
    { $profile =Profiles::all();
    //dd($profile);
       return view('courses.create')->with('profile', $profile);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'courses'=>'required|max:100',
            'description' =>'required',
             'profils'=>'max:255'
            ]);
          // Create Post
       $courses = new Course;
       $courses->courses = $request->input('courses');
       $courses->description = $request->input('description');
       $courses->user_id = auth()->user()->id;
       $courses->save();
        if($request['profils'] != null){
            
//            $profile = new Porfilcourses;
//            $profile->profil_id =$request->input('profils');
//            $profile->course_id =$request->input($request['id']);
//            $profile->save(); 
               $dataSet = [];
        //foreach($request['profils'] as $profile){
            
                    
       
            $dataSet[] = [
                'profil_id'  => $request['profils'],
                'course_id'=>$courses['id'],
               
            ];
            
       
        DB::table('profile_has_courses')->insert($dataSet);
   
        }
       
        //Display a successful message upon save
        return redirect()->route('courses.index')
            ->with('flash_message', 'Courses,'. $courses->courses.'Courses created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function show($id)
    {
     $profiless = Porfilcourses::all();
     $courses = Course::findOrFail($id);
     $profiles= 1;
     //$coursid = Course::where($id, '=', $profile['course_id'])->firstOrFail();
    // dd($coursid);
    foreach($profiless as $profile){
        if($id == $profile['course_id']){
        $profiles = Profiles::where('id', '=', $profile['profil_id'])->firstOrFail(); 
        }
    }
        return view ('courses.show')->with('courses',$courses)->with('profiles',$profiles);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $courses = Course::findOrFail($id); //Find post of id = $id

        return view ('courses.edit')->with('courses',$courses);
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
        $this->validate($request, [
            'courses' => 'required',
            'description' => 'required'
        ]);
        $courses = Course::find($id);
       $courses->courses = $request->input('courses');
       $courses->description = $request->input('description');
       $courses->save();
       
       //return redirect('/schools')->with('success','Profils Updated');
       return redirect()->route('courses.show', 
            $courses->id)->with('flash_message', 
            'Courses, '. $courses->courses.' updated');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $courses = Course::find($id);
           //Chack for correct user
        if(auth()->user()->id !== $courses->user_id){ // aici verificam daca id postului se potriveste cu id userului care a creat postul
            return redirect('/courses')->with('error', 'Unauthorized Page');
        }
    
        $courses->delete();
        return redirect('/courses')->with('success','Courses Remove');
    }
}
