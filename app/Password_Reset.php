<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Password_Reset extends Model {
	protected $fillable = ['email','token','create_at'];

	function user() {
		return $this->belongsTo(User::class);
	}
    
}
