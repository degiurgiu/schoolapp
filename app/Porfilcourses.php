<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porfilcourses extends Model
{
     // Table Name
    protected $table= 'profile_has_courses';
    //Primary key
   // public  $primaryKey = 'id';
    // TimeStamp
   // public $timestamps = true;
    
    protected $fillable = [
        'profil_id', 'course_id'
    ];
        public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}
