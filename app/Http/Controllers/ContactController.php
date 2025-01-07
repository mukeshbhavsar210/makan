<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy("created_at","desc")->paginate(10);
        
        return view("contact", [
            "contacts" => $contacts
        ]);
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name"=> 'required',
            "phone"=> 'required|min:8|max:10',
            "email"=> 'required|email',
            "message"=> 'required|min:5|max:200',            
        ]);

        if ($validator->passes()) {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();
        
        $request->session()->flash('success', 'Contact added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Contact added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
        //return back()->with('success','Form submitted succesfully');
        //return redirect()->route('home')->with('success','Form submitted succesfully');
    }
}
