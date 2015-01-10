<?php

class Appointment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

        public function deal()
        {
            return $this->belongsTo('Deal');
        }


}
