<?php

class Manufacture extends Eloquent {

    public function dealer()
    {
        return $this->hasOne('Dealer');
    }

        public function addedby()
        {
            return $this->belongsTo('User','added_by_id');
        }


}
