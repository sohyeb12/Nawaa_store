<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;


class UpdatePasswordUser extends Controller
{
    public function edit_password($id){

        $user = User::findOrFail($id);
        
        return view('admin.users.edit-password',[
            "title"  =>"Edit Password",
            "user"   =>$user,
        ]);

    }

    public function update(Request $request , $id){
        $request->validate([
            'password' => ['required' , 'confirmed' , Rules\Password::defaults()],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', "User Pasword: ({$user->name}) Updated!!");
    }
}
