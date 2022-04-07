<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModel;

class PhotoController extends Controller
{
    function PhotoIndex(){
        return view('Photo');
    }

    function PhotoUpload(Request $request){
        $photoPath = $request->file('photo')->store('public');

        $photoName = (explode('/',$photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://".$host."/storage/".$photoName;
        $result = PhotoModel::insert(['location'=>$location]);

        return $result;
    }

    function PhotoJson(){
        return PhotoModel::all();
    }
}
