<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show(){
        return view("test");
    }

    public function add(Request $request){
        return $request->all();
    }
}
