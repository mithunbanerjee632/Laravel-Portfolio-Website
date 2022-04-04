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





       }
    })
    .catch(function(error){

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