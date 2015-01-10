<?php

class PermissionRole extends Eloquent
{
    protected $table = "permission_role";

    public function permission()
    {
        return $this->belongsTo('Permission');
    }


}
