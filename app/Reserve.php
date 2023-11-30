<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Webpatser\Uuid\Uuid;
// use Katteba\UUID\UUIDShortener;

class Reserve extends Model {
	
	protected $table = 'reserves';

	const UPDATED_AT = null;
	const CREATED_AT = null;

	protected $fillable = [
		'user_id',
		'facility_code',
		'start_time',
		'end_time',

	];

	// protected static function boot () {
	// 	parent::boot();

	// 	static::creating(function ($model) {
	// 		$model->{$model->getKeyName()} = Uuid::generate()->string;
	// 	});
	// }

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function facility() {
		return $this->belongsTo('App\Facility', 'facility_code', 'facility_code');
	}

    static function SearchReserveDates($facility_name, $dateinfo) {

    	$result = self::whereHas('Facility', function($query) use($facility_name, $dateinfo) {
		$query
			->where('facility_name',$facility_name)
			->whereDate('start_time',$dateinfo)
			->whereDate('end_time',$dateinfo);
						})->select('id', 'start_time', 'end_time')->get()->all();
		return $result;
	}

	static function SearchReservation($user_id) {

		$result = self::where('user_id', $user_id)->get();

		return $result;

	}
}
