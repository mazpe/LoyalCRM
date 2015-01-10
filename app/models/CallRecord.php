<?php

    class CallRecord extends Eloquent
    {

        public function contacttype()
        {
            return $this->belongsTo('ContactType','last_contact_type_id');
        }

        public function stage()
        {
            return $this->belongsTo('Stage');
        }

        public function repairorder()
        {
            //return $this->belongsTo('Disposition');
            return $this->belongsTo('RepairOrder','vehicle_vin');
        }



    }
