<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function ContactIndex()
    {
       return view('Contact');
    }

    function ContactsData(){
        $result = json_encode(ContactModel::orderBy('id','desc')->get());
        return $result;
    }

    function ContactDelete(Request $request){
        $id = $request->input('id');

        $result = ContactModel::where('id','=',$id)->delete();

        if($result == true){
            return 1;

        }else{
            return 0;
        }
    }
}
