<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Carbon\Carbon;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

        if (Auth::user()->email == 'superuser@lhost.com'):
            $users = User::all();
        else:
            $users = User::where('email','!=','superuser@lhost.com')->get();
        endif;
        return view('users/list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (Auth::user()->email == 'superuser@lhost.com'):
            $roles = Role::all();
        else:
            $roles = Role::where('name', '!=', 'super')->get();
        endif;
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if (count($user)) {
            $user->attachRole($request->role);
        }
        return redirect()->route('users.index');
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
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        //
        if (Auth::user()->email == 'superuser@lhost.com'):
            $roles = Role::all();
        else:
            $roles = Role::where('name', '!=', 'super')->get();
        endif;
        return view('users/edit', compact(['user', 'roles']));
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
        //
        //
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->roles()->sync([$request->role]);
         return redirect()->route('users.index');
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

    /**
    * Change Password
    *
    **/
    public function changePassword(){
        $user = Auth::user();
        return view('users/change-password', compact(['user']));
    }


    /**
    * Update password
    *
    **/
    public function updatePassword(Request $request){

        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
         // Checking current password
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is not correct']);
        }
 
        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);
        
        Auth::logout();
        return redirect()->route('login')->withErrors(['message' => 'Password changed! Kindly log in with the new password']);

    }

    /**
    * Reset password
    *
    **/
    public function resetPassword( Request $request){
        $user = User::find($request->user_id);
        $user->update([
            'password' => bcrypt('123456')
        ]);
        return redirect()->back()->with(['message' => $user->name.' password has been reset.']);       
    }
}
