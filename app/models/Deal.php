<?php

    class Deal extends Eloquent
    {

        public function dealer()
        {
            return $this->belongsTo('Dealer');
        }

        public function campaign()
        {
            return $this->belongsTo('Campaign');
        }

        public function contact_type()
        {
            return $this->belongsTo('ContactType');
        }

        public function agent()
        {
            return $this->belongsTo('User');
        }

        public function month()
        {
            return $this->belongsTo('Month');
        }


    }
