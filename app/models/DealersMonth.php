<?php

class DealersMonth extends Eloquent
{

    public function month()
    {
        //return $this->belongsTo('Disposition');
        return $this->belongsTo('Month');
    }


}
