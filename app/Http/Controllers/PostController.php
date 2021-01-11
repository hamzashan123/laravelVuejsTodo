<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function test(){
        return view('welcome');
    }
    public function getdata(){
        $data = \App\Post::orderBy('id')->paginate(50);
        return response()->json($data);
    }
}
