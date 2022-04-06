<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\ReviewModel;
use App\Models\ContactModel;

class HomeController extends Controller
{
    public function HomeIndex()
    {

        $TotalContact = ContactModel::count();
        $TotalCourse = CourseModel::count();
        $TotalProject = ProjectModel::count();
        $TotalServices = ServicesModel::count();
        $TotalReview = ReviewModel::count();
        $TotalVisitor = VisitorModel::count();
       
        return view('Home',[
           'TotalContact' =>$TotalContact,
           'TotalCourse'  =>$TotalCourse,
           'TotalProject' =>$TotalProject,
           'TotalServices'=>$TotalServices,
           'TotalReview'  =>$TotalReview,
           'TotalVisitor' =>$TotalVisitor
              
        ]);
    }
}
