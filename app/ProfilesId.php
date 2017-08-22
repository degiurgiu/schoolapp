<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of ProfilesId
 *
 * @author Edward
 */
class ProfilesId extends Model
{
     // Table Name
    protected $table= 'user_has_profile';
    //Primary key
    //public  $primaryKey = 'id';

  
    
    protected $fillable = [
        'user_id', 'profile_id',
    ];
   public function user(){ // aa single poste belongs to a user
        return $this->belongsTo('App\User');
    }
}