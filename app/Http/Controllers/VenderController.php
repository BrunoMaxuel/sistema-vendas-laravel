<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenderController extends Controller
{
    public function index(){
        return view('home');
    }
}
