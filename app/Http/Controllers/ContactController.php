<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    //this is our index method we called in web.php
    public function index(){
        return view('contact');
    }
}
