<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditFormRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){

        $users = User::all();
        return view('backend.users.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles()->pluck('name')->toArray();
        return view('backend.users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function update(UserEditFormRequest $request,$id){

        $user = User::whereId($id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != ''){
            $user->password = Hash::make($password);
        }
        $user->save();
        $user->syncRoles($request->get('role'));
        return redirect( action([UsersController::class,'edit'], $user->id))->with('status','You have been updated');
    }
}
