<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model {
	
	protected $table = 'facilities';
	const UPDATED_AT = null;
	const CREATED_AT = null;

	public function reserves() {

		return $this->hasMany('App\Reserve', 'facility_code', 'facility_code');

	}
	
	public function business_hours() {
		
		return $this->hasMany('App\Business_hour', 'facility_code', 'facility_code');
	}

	static function SearchFacility_code($facility_name) {
		$results = self::where('facility_name', $facility_name)->select('facility_code')->get();
		foreach ($results as $result) {
			$result = $result->facility_code;
		}
		return $result;
	}

	static function SearchFaciliy_name($facility_code) {
		$results = self::where('facility_code', $facility_code)->select('facility_name')->get();
		foreach ($results as $result) {
			$result = $result->facility_name;
		}
		return $result;
	}
}
