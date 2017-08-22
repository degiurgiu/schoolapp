<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
     // Table Name
    protected $table= 'profiles';
    //Primary key
    public  $primaryKey = 'id';
    // TimeStamp
    public $timestamps = true;
    
    protected $fillable = [
        'profils', 'description', 'cover_image'
    ];
   public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}
