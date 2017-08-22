<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
     // Table Name
    protected $table= 'grades';
    //Primary key
    public  $primaryKey = 'id';
    // TimeStamp
    public $timestamps = true;
    
    protected $fillable = [
        'grade', 'user_id','student_id', 'profile_id','course_id','lessons_id'
    ];
   public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}
