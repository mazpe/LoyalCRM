<?php

class Month extends Eloquent {

        public function addedby()
        {
            return $this->belongsTo('User','added_by_id');
        }


}
