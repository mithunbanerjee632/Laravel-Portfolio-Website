<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectsController extends Controller
{
    function ProjectsPage(){
        $ProjectData=json_decode(ProjectModel::orderBy('id','desc')->get());
        return view('Projects',['ProjectData'=>$ProjectData]);
    }
}
