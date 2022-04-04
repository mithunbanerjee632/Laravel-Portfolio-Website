@extends('Layout.app')


@section('content')

<div id="mainDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

  <button id="addNewProjectsBtnId" class="btn btn-sm btn-danger my-3">Add New Project</button>

<table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="project_table">
	
	
	
  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDivProject" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img class="loading-icon " src="{{asset('images/loader.svg')}}">
 
</div>
</div>
</div>

<div id="wrongDivProject" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <h3>Something Went Wrong!</h3>
 
</div>
</div>
</div>


<!-- Add new  Modal -->
<div class="modal fade" id="addModalProject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 

          <div id="PrjectAddForm" class="w-100">  
            <h6 class="mb-4">Add New Project</h6>
            <input type="text" id="projectNameAddId" class="form-control mb-4" placeholder="Project Name" />
            <input type="text" id="projectDesAddId" class="form-control mb-4" placeholder="Project Description"/>
            <input type="text" id="projectLinkAddId" class="form-control mb-4" placeholder="Project Link"/>
            <input type="text" id="projectImgAddId" class="form-control mb-4" placeholder="Project Image Link"/>
        </div>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectAddConfirmBtn" type="button" class="btn btn-danger">Add</button>
      
      </div>
    </div>
  </div>
</div>



<!-- Edit and Update Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 
        
      	<h6 id="projectEditId" class="mt-4  d-none"> </h6>

          <div id="projectUpdateForm" class=" w-100 d-none">  
		      	<input type="text" id="projectNameId" class="form-control mb-4" placeholder="Service Name" />
		      	<input type="text" id="projectDesId" class="form-control mb-4" placeholder="Service Description"/>
		      	<input type="text" id="projectLinkId" class="form-control mb-4" placeholder="Project Link"/>
		      	<input type="text" id="projectImgId" class="form-control mb-4" placeholder="Service Image Link"/>
        </div>

      	<img id="projectEditLoader" class="loading-icon " src="{{asset('images/loader.svg')}}">
      	<h3 id="projectEditWrong" class="d-none">Something Went Wrong!</h3>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button  id="projectUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>
      
      </div>
    </div>
  </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete?</h5>
      	<h6 id="projectDeleteId" class="mt-2  d-none"> </h6>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button  id="projectDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      
      </div>
    </div>
  </div>
</div>





@endsection





@section('script')

<script type="text/javascript">
	getProjectData();


  //Project Page table

function getProjectData(){
    axios.get('/getprojectsData')
    .then(function(response){
       if(response.status == 200){

              $('#mainDivProject').removeClass('d-none');
                $('#loaderDivProject').addClass('d-none');

               

                $('#ProjectDataTable').DataTable().destroy(); 
                $('#project_table').empty();

               var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        /*"<td><img class='table-img' src=" + jsonData[i].project_img + "></td>" +*/
                        "<td>" + jsonData[i].project_name + "</td>" +
                        "<td>" + jsonData[i].project_des + "</td>" +
                        "<td><a class='projectEditBtn' data-id =" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='projectDeleteBtn' data-id =" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#project_table');
                });


                //project table edit icon click

                $('.projectEditBtn').click(function(){
                    var id = $(this).data('id');
                    $('#projectEditId').html(id);

                    getProjectDetails(id);
                    $('#editProjectModal').modal('show');
                });


                //project table delete icon click

                $('.projectDeleteBtn').click(function(){
                    var id = $(this).data('id');
                    $('#projectDeleteId').html(id);

                    $('#deleteProjectModal').modal('show');
                });

                //Data table

                $('#ProjectDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');





       }else{
        $('#wrongDivProject').removeClass('d-none');
        $('#loaderDivProject').addClass('d-none');
       }
    })
    .catch(function(error){
       $('#wrongDivProject').removeClass('d-none');
        $('#loaderDivProject').addClass('d-none');
    });
}



$('#addNewProjectsBtnId').click(function(){
    $('#addModalProject').modal('show');
});


$('#projectAddConfirmBtn').click(function(){
    var name = $('#projectNameAddId').val();
    var des  = $('#projectDesAddId').val();
    var link  = $('#projectLinkAddId').val();
    var img  = $('#projectImgAddId').val();

    ProjectAdd(name,des,link,img);


});


//Add Project 

function ProjectAdd(ProjectName,ProjectDes,ProjectLink,ProjectImg){
    if(ProjectName.length == 0){
        toastr.error('Project Name is Empty !');
    }else if(ProjectDes.length == 0){
        toastr.error('Project Description is Empty !');
    }else if(ProjectLink.length == 0){
        toastr.error('Project Link is Empty !');
    }else if(ProjectImg.length == 0){
         toastr.error('Project Image is Empty !');
    }else{
        $('#projectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/projectsAdd',{
             project_name:ProjectName,
             project_des:ProjectDes,
             project_link:ProjectLink,
             project_img:ProjectImg 

        }).then(function(response){
            if(response.status == 200){
                $('#projectAddConfirmBtn').html('Add');

                if(response.data ==1){
                    $('#addModalProject').modal('hide');
                    toastr.success('Data Inserted Successfully !');
                    getProjectData();

                }else{
                    $('#addModalProject').modal('hide');
                    toastr.error('Data Inserted Failed !');
                    getProjectData(); 
                }
            }else{
                  $('#addModalProject').modal('hide');
                  toastr.error('Something Went Wrong !');
            }
        }).catch(function(error){
              $('#addModalProject').modal('hide');
              toastr.error('Something Went Wrong !');
        });
       
    }
}


//Each Project Details

function getProjectDetails(editId){
    axios.post('/projectsDetails',{id:editId})
    .then(function(response){
        if(response.status == 200){
            $('#projectUpdateForm').removeClass('d-none');
            $('#projectEditLoader').addClass('d-none');

            var jsonData = response.data;

            $('#projectNameId').val(jsonData[0].project_name);
            $('#projectDesId').val(jsonData[0].project_des);
            $('#projectLinkId').val(jsonData[0].project_link);
            $('#projectImgId').val(jsonData[0].project_img);

        }else{
           $('#projectEditLoader').addClass('d-none');
           $('#projectEditWrong').removeClass('d-none');
        }
    })
    .catch(function(error){
        $('#projectEditLoader').addClass('d-none');
        $('#projectEditWrong').removeClass('d-none');
    });
}

//Update Modal Update button click

$('#projectUpdateConfirmBtn').click(function(){
    var id  = $('#projectEditId').html();
    var name= $('#projectNameId').val();
    var des= $('#projectDesId').val();
    var link= $('#projectLinkId').val();
    var img= $('#projectImgId').val();
    ProjectUpdate(id,name,des,link,img);
});


//Project Update

function ProjectUpdate(ProjectId,ProjectName,ProjectDes,ProjectLink,ProjectImg){
    if(ProjectName.length == 0){
        toastr.error('Project Name is Empty!');
    }else if(ProjectDes.length == 0){
        toastr.error('Project Description is Empty!');
    }else if(ProjectLink.length == 0){
        toastr.error('Project Link is Empty!');
    }else if(ProjectImg.length == 0){
        toastr.error('Project Image is Empty!');
    }else{

        $('#projectUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)
        
       axios.post('/projectsUpdate',{
          id:ProjectId,
          project_name:ProjectName,
          project_des:ProjectDes,
          project_link:ProjectLink,
          project_img:ProjectImg

       }).then(function(response){
        if(response.status == 200){
            $('#projectUpdateConfirmBtn').html('Update');
            
            if(response.data == 1){
                $('#editProjectModal').modal('hide');
                toastr.success('Data Updated Successfully!');
                getProjectData();
               

            }else{
                $('#editProjectModal').modal('hide');
                toastr.error('Data  Not Updated !');
                getProjectData();
            }
        }else{
            $('#editProjectModal').modal('hide');
            toastr.error('Something Went Wrong');
        }
       }).catch(function(error) {
            $('#editProjectModal').modal('hide');
            toastr.error('Something Went Wrong');
       });
    }
}


//Delete Modal Yes Button Click
$('#projectDeleteConfirmBtn').click(function(){
   var id = $('#projectDeleteId').html();
   ProjectDelete(id);

});


//Delete Project data

function ProjectDelete(deleteID) {
     $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

     axios.post('/projectsDelete',{id:deleteID})
     .then(function(response){
        if(response.status == 200){
            $('#projectDeleteConfirmBtn').html('Yes');

            if(response.data == 1){
                $('#deleteProjectModal').modal('hide');
                toastr.success('Data Deleted Successfully !');
                getProjectData();
            }else{
                $('#deleteProjectModal').modal('hide');
                toastr.error('Data is Not Deleted !');
                getProjectData();
            }
        }else{
             $('#deleteProjectModal').modal('hide');
             toastr.error('Something Went Wrong !');
        }
     })
     .catch(function(error){
         $('#deleteProjectModal').modal('hide');
         toastr.error('Something Went Wrong !');
     });
}
</script>




@endsection