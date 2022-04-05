<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
   function CoursePage(){
       return view('Course');
   }
}
