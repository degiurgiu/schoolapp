<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{   use HasRoles;
    use Notifiable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
     public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }
//     public function profiles(){ // users can have mai multe posturi
//        return $this->hasMany('App\Profiles','user_has_profile');
//    }
  public function profile(){ // users can have mai multe posturi
        return $this->hasMany('App\Profiles');
    }
    public function lessons(){ // users can have mai multe posturi
        return $this->hasMany('App\Lesson');
    }
    public function grades(){ // users can have mai multe posturi
        return $this->hasMany('App\Grade');
    }
    public function courses(){ // users can have mai multe posturi
        return $this->hasMany('App\Course');
    }
    public function profilesid(){ // aa single poste belongs to a user
        return $this->hasMany('App\ProfilesId');
    }
   
}
