<?php

    class Dealer extends Eloquent
    {

        public function manufacture() 
        {
            return $this->belongsTo('Manufacture');
        }

        public function dealergroup()
        {
            return $this->belongsTo('DealerGroup','dealer_group_id');
        }

        public function agent()
        {
            return $this->belongsTo('User','agent_id');
        }

        public function campaign()
        {
            return $this->hasOne('Campaign');
        }

        public function assignment()
        {
            return $this->hasOne('Assignment');
        }

        public function stage()
        {
            return $this->belongsTo('Stage');
        }

        public function addedby()
        {
            return $this->belongsTo('User','added_by_id');
        }

    }
