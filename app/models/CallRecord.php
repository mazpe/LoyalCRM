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
		
        public function addedby()
		{
		    return $this->belongsTo('User','added_by_id');
		}

        public function editedby()
        {
            return $this->belongsTo('User','edited_by_id');
        }

        public function repairorder()
        {
            //return $this->belongsTo('Disposition');
            return $this->belongsTo('RepairOrder','vehicle_vin');
        }

    }
