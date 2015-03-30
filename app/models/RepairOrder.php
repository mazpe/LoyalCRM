<?php

class RepairOrder extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

    public function deal()
    {
        return $this->hasOne('Deal');
    }

    public function callrecords()
    {
        return $this->hasMany('CallRecord','vehicle_vin');
    }


}
