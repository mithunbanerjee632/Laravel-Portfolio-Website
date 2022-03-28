<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServiceController extends Controller
{
    public function ServiceIndex()
    {
        return view('Services');
    }

    public function ServiceData()
    {
       $result = json_encode(ServicesModel::all());
       return $result;
    }
}
