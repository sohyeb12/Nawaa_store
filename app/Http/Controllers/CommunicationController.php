<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;

class CommunicationController extends Controller
{
    public function index(){
        $communications = Communication::all()->toQuery()->paginate(4);
        $title = "Communications List";
        return view('admin.communications.index',[
            'communications' => $communications,
            'title' => $title,
        ]);
    }

    public function create(){
        
        return view('shop.create',[
            'communication' => new Communication(),
        ]);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'subject' => 'required|string|max:255|min:3',
            'message' => 'required|string|min:10|max:4096',
        ]);

        $communication = new Communication();
        $communication->name  = $request->input("name");
        $communication->subject  = $request->input("subject");
        $communication->email  = $request->input("email");
        $communication->phone  = $request->input("phone");
        $communication->message  = $request->input("message");
        $communication->save();

        return view('shop.success');
    }
}
