<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index(){
        return view("contact");
    }

    public function store(Request $request){
        dd($request->all());
    }
}
