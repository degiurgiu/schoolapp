<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
     // Table Name
    protected $table= 'lessons';
    //Primary key
    public  $primaryKey = 'id';
    // TimeStamp
    public $timestamps = true;
    
    protected $fillable = [
        'title', 'description','uploads_files', 'image_file','user_id'
    ];
   public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}
