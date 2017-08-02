<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    //

    /**
     * Create and set a selected attribute in permission to "true"
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     */
    public function mixPermissions()
    {
        $all_perms = Permission::all();
        foreach ($all_perms as $perm) {
            foreach ($this->perms as $p) {
                if ($perm->id == $p->id)
                    $perm->selected = true;
            }
        }
        return $all_perms;
    }
}
