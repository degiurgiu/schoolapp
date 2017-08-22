<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Query\Builder;
use App\Course;
use App\Profiles;
use App\ProfilesId;
use App\Porfilcourses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'profils'=>'max:255',
            
        ]);
    }

    public function showRegistrationForm()
    {
 
            $coursesss = DB::table('profile_has_courses')
            ->join('courses', 'profile_has_courses.course_id', '=', 'courses.id')
            ->join('profiles', 'profile_has_courses.profil_id', '=', 'profiles.id')
            ->select('profile_has_courses.*', 'courses.courses', 'profiles.profils')
            ->get();
          
            return view('auth.register')->with('coursesss',$coursesss);
       
        
    }
    
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
//       $profiles=$data['profils'];
////     
//        foreach($profiles as $profile){
//            $p = Profiles::where('id', '=', $profile)->firstOrFail(); 
//           echo $p['profils'];
//           //$user->user()->id;
//        }
       
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            //'profils'=>$data['profils'],
            
        ]);
    }
    
}
