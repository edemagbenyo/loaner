<?php

namespace App\Http\Controllers\Settings;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings/roles/index');
    }

    /**
         * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //List of permissions
        $permissions = Permission::all();
        return view('settings/roles/create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
            'permissions'=>'required'
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        $role->save();

        //Add the permission to role
        if(count($role)){
            $role->perms()->sync($request->permissions);
        }
        return redirect()->route('roles.perms');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $permissions = $role->mixPermissions();
        return view('settings/roles/edit',compact(['role','permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
            'description'=>'required',
            'permissions'=>'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description  = $request->description;
        $role->save();
        //Add the permission to role
        if(count($role)){
            $role->perms()->sync($request->permissions);
        }
        return redirect()->route('roles.perms')->with('message',$role->display_name.' permissions has been edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
