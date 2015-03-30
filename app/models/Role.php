<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function assignedrole()
    {
        return $this->hasMany('AssignedRole');
    }

}
