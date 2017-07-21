<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use DB; // <-- to use SQL

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contactName' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        
        // Create contact
        $contact = new Contact;
        $contact->name = $request->input('contactName');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->IP = $request->ip();
        $contact->save();

        //return redirect('/contacts')->with('success', 'Contact Created');
        
    }
}
