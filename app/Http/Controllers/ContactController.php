<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'name'    => 'required|min:3',
            'email'   => 'required|email',
            'message' => 'required|min:10',
        ]);
        
        // Create contact
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->message = $request->input('message');
        $contact->IP = $request->ip();

        $contact->save();

        return redirect('/')->with('success', 'Contact Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
