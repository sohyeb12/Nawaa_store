<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    public function index(){
        $users = User::all()->toQuery()->paginate(5);
        return view('admin.users.index', [
            'title' => 'Users List',
            'users' => $users,
        ]);
    }

    public function show($first,$last= null){
        return $first . " " . $last;
    }
    
    public function create(){
        return view('admin.users.create', [
            'user' => new User(),
            'status_options' => User::status_option(), 
            'user_types' => User::user_types(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type' => ['required','in:user,admin,super-admin'],
            'status' => ['required','in:active,inactive,blocked'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', "User ({$user->name}) Created");
    }

    public function edit($id){

        $user = User::findOrFail($id);
        return view('admin.users.edit', [
            'user' => $user,
            'status_options' => User::status_option(),
            'user_types' => User::user_types(),
        ]);
    }

    // 'old_password' => ['required' , 'min:6' , 'max:100'],
    // 'new_password' => ['required' , 'confirmed' , Rules\Password::defaults()],

    public function update(Request $request , $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required','in:user,admin,super-admin'],
            'status' => ['required','in:active,inactive,blocked'],
        ]);

        $user = User::findOrFail($id);
        
        $user->update([
            'email' => $request->input("email"),
            'name' =>  $request->input("name"),
            'type' =>   $request->input("type"),
            'status' =>   $request->input("status"),
        ]);
    
        return redirect()->route('users.index')->with('success', "User ({$user->name}) Updated");
    }

    public function destroy(User $user){
        $user->delete();

        return redirect()->route('users.index')->with('success', "User ({$user->name}) Deleted");
    }

    public function trashed(){
        $users = User::onlyTrashed()->paginate(5);

        return view('admin.users.trashed' ,[
            'users' => $users ,
        ]);
    }

    public function restore($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')
        ->with('success', "User ({$user->name}) Restored");
    }

    public function forceDelete($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('users.index')
        ->with('success', "User ({$user->name}) Deleted forever!");
    }
}
