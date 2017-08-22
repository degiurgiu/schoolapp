<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
use App\Course;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
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
    {   $users = User::orderby('id', 'desc'); 
        $courses = Course::orderby('id', 'desc')->paginate(5); 
       $profiles = Profiles::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('profiles.index')->with('courses',$courses)->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('profiles.create');
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
            'profils'=>'required|max:100',
            'description' =>'required',
            'cover_image'=>'image|nullable|max:1999',
            ]);
        //Handel File Uploard
        if($request->hasFile('cover_image')){// aici verificam daca face uplode la vreo imagine
           //Get file name with the extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extentsion
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore = $filename.'_'.time().'.'.$extention; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToSore); // pentru a face uplode imagini
            
            
            
        }else{
            $fileNameToSore = 'noimage.jpg';
        }
        
        // Create Post
       $profiles = new Profiles;
       $profiles->profils = $request->input('profils');
       $profiles->description = $request->input('description');
       $profiles->user_id = auth()->user()->id;
       $profiles->cover_image = $fileNameToSore;
       $profiles->save();
        
    //Display a successful message upon save
        return redirect()->route('profiles.index')
            ->with('flash_message', 'Profiles,
             '. $profiles->profils.'Profil created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  // $users =User::all();
        $profiles = Profiles::findOrFail($id); //Find post of id = $id
     
//        foreach($users as $usere){
//            if($profiles['userr_id'] == $usere['id']){
//            $user = User::where('id', '=', $usere['userr_id'])->firstOrFail(); 
//            }
//        }
//        dd($user);
        return view ('profiles.show')->with('profiles',$profiles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profiles = Profiles::findOrFail($id); //Find post of id = $id

        return view ('profiles.edit')->with('profiles',$profiles);
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
            'profils' => 'required',
            'description' => 'required'
        ]);
         //Handel File Uploard
        if($request->hasFile('cover_image')){// aici verificam daca face uplode la vreo imagine
           //Get file name with the extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extentsion
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Get filename to store
            $fileNameToSore = $filename.'_'.time().'.'.$extention; // aici luam numele original si punem timpul cand a fost facut upload pentru nu a fii dublicat de nume fisier
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToSore); // pentru a face uplode imagini
        }
       // Update Post
       $profiles = Profiles::find($id);
       $profiles->profils = $request->input('profils');
       $profiles->description = $request->input('description');
      if($request->hasFile('cover_image')){
            $profiles->cover_image = $fileNameToSore;
        }
       $profiles->save();
       
       //return redirect('/schools')->with('success','Profils Updated');
       return redirect()->route('profiles.show', 
            $profiles->id)->with('flash_message', 
            'Profils, '. $profiles->profils.' updated');
    
       
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $profiles = Profiles::find($id);
           //Chack for correct user
        if(auth()->user()->id !== $profiles->user_id){ // aici verificam daca id postului se potriveste cu id userului care a creat postul
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }
        
        if($profiles->cover_image != 'noimage.jpg'){
            //Delete image
            Storage::delete('public/cover_images/'.$profiles->cover_image);
        }
        
        $profiles->delete();
        return redirect('/profiles')->with('success','Profils Remove');
    }
}
