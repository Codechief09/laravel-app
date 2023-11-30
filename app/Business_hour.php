<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_hour extends Model {

	protected $table = 'business_hours';
	const UPDATED_AT = null;
	const CREATED_AT = null;

	public function facility() {
		return $this->belongsTo('App\Facility', 'facility_code');
	}
}
