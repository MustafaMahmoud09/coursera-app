<?php

namespace App\Http\Controllers\Contacts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\AddContactRequest;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class StudentContactController extends Controller
{

    //function for return contacts view
    public function index()
    {
        try {
            return view('students.contact');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end index


    //function for return about view
    public function aboutView()
    {
        try {
            return view('students.about');
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end aboutView


    //function for store new contact
    public function store(AddContactRequest $request)
    {
        try {
            //create new contact here
            Contact::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'message' => $request->message
                ]
            );

            return back()->withErrors(
                [
                    'success' => 'contact created!'
                ]
            );
        } //end try
        catch (Exception $ex) {
            return abort(500);
        } //end catch
    } //end store

}//end StudentContactController
