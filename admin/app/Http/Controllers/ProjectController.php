<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{


    public function ProjectsIndex()
    {
        return view('Projects');
    }


    public function ProjectsData(){
        $result =json_encode(ProjectModel::orderBy('id','desc')->get());
        return $result;
    }


    public function getProjectsDetails(Request $request)
    {
       $id = $request->input('id');

       $result=json_encode(ProjectModel::where('id','=',$id)->get());
       return $result;
    }


     public function ProjectsDelete(Request $request)
    {
       $id = $request->input('id');

       $result = ProjectModel::where('id','=',$id)->delete();

       if($result == true){
        return 1;

       }else{
        return 0;
       }
    }
     

    public function ProjectsUpdate(Request $request)
    {
       $id = $request->input('id');
       $name =$request->input('project_name');
       $des =$request->input('project_des');
       $link =$request->input('project_link');
       $img =$request->input('project_img');
       
       $result = ProjectModel::where('id','=',$id)->update([
        'project_name'=>$name,
        'project_des'=>$des,
        'project_link'=>$link,
        'project_img'=>$img
    ]);

       if($result == true){
        return 1;
       }else{
        return 0;
       }
    }


    public function ProjectAdd(Request $request)
    {
       $name =$request->input('project_name');
       $des =$request->input('project_des');
       $link =$request->input('project_link');
       $img =$request->input('project_img');

      $result = ProjectModel::insert(['project_name'=>$name,'project_des'=>$des,'project_link'=>$link,'project_img'=>$img]);

      if($result == true){
        return 1;
       }else{
        return 0;
       }
    }
}
