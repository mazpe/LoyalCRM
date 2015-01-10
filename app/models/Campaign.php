<?php

class Campaign extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
        ];

    // Don't forget to fill this array
    protected $fillable = [];

    public function dealer()
    {
        return $this->belongsTo('Dealer');
    }

    public function assignment()
    {
        return $this->hasOne('Assignment');
    }

    public function deal()
    {
        return $this->hasOne('Deal');
    }

}
