<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return __METHOD__;
    }

    public function show($first,$last= null){
        return $first . " " . $last;
    }
}
