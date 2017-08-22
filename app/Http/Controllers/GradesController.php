<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;
use Illuminate\Support\Facades\DB;
class GradesController extends Controller
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
    {   $grades = Grade::orderby('id', 'desc')->paginate(5);
         return view('grades.index')->with('grades',$grades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $students = DB::table('user_has_roles')
            ->join('users', 'user_has_roles.user_id', '=', 'users.id')
            ->join('roles', 'user_has_roles.role_id', '=', 'roles.id')
            ->select('user_has_roles.*', 'users.name' )
            ->get();
        
        $courses = DB::table('user_has_profile')
            ->join('users', 'user_has_profile.user_id', '=', 'users.id')
            ->join('user_has_roles', 'user_has_profile.user_id', '=', 'user_has_roles.user_id')
            ->join('profiles','user_has_profile.profile_id', '=' ,'profiles.id' )
            ->join('courses', 'user_has_profile.courses_id', '=', 'courses.id')
            ->join('lessons_has_courses','user_has_profile.courses_id','=','lessons_has_courses.courses_id')
            ->join('lessons','lessons_has_courses.lesson_id','=', 'lessons.id')
            ->select('user_has_profile.*', 'users.name','courses.courses','user_has_roles.role_id','user_has_profile.profile_id','profiles.profils')
            ->get();
        //$values = array_merge($students, $courses);
        
        return view('grades.create')->with('students', $students)->with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
