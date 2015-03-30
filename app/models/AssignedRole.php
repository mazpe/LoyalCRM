<?php

class AssignedRole extends Eloquent
{

    public function role()
    {
        return $this->belongsTo('Role');
    }


}
