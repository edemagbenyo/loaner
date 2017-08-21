<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->email == 'superuser@lhost.com'):
            $roles = Role::all();
        else:
            $roles = Role::where('name', '!=', 'super')->get();
        endif;


        $permissions = Permission::all();
        return view('settings/roles-perms', compact(['roles', 'permissions']));
    }
}
