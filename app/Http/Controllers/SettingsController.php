<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('settings/general');
    }

    public function getRolesAndPermissions()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('settings/roles-perms',compact(['roles','permissions']));
    }
}
