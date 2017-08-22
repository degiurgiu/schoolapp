<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
      // Table Name
    protected $table= 'courses';
    //Primary key
    public  $primaryKey = 'id';
    // TimeStamp
    public $timestamps = true;
    
    protected $fillable = [
        'courses', 'description'
    ];
        public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}
