<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //this is our index method we called in web.php
    public function index(){
        return view('contact');
    }
}
