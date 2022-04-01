//Visitor Page Table

$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


//Service Page Table

function getServiceData() {

    axios.get('/servicesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='serviceEditBtn' data-id =" + jsonData[i].id + "  ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id =" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table');
                });

                //Service  Table Delete icon click

                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    //$('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $('#serviceDeleteId').html(id)
                    $('#deleteModal').modal('show');
                })

               

                //Service table edit  icon click
                $('.serviceEditBtn').click(function() {
                    var id = $(this).data('id');
                     $('#serviceEditId').html(id);
                     ServiceUpdateDetails(id);
                    $('#editModal').modal('show');
                })

              

            } else {

                $('#wrongDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

            }



        }).catch(function(error) {
            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
        });
}

 //Service table Delete Modal  Yes Button Click

$('#serviceDeleteConfirmBtn').click(function() {
    //var id = $(this).data('id')
    var id = $('#serviceDeleteId').html();
    ServiceDelete(id);

})


//Delete Service table

function ServiceDelete(deleteID) {
   $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)
    
    axios.post('/servicesDelete', {
            id: deleteID
        })
        .then(function(response) {

            if(response.status==200){
              $('#serviceDeleteConfirmBtn').html("Yes"); //response pele yes show korbe

                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('Successfully Deleted');
                    getServiceData();
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Fail!');
                    getServiceData();
                }

            }else{
                 $('#deleteModal').modal('hide');
                 toastr.error('Something Went Wrong!');
            }

        }).catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong!');

        });
}

//Each Service Details

function ServiceUpdateDetails(editID){
    axios.post('/servicesDetails',{ id:editID })
    .then(function(response){

       if(response.status == 200){

          $('#serviceUpdateForm').removeClass('d-none');
          $('#serviceEditLoader').addClass('d-none');
        
        var jsonData =response.data;

          $('#serviceNameId').val(jsonData[0].service_name);
          $('#serviceDesId').val(jsonData[0].service_des);
          $('#serviceImgId').val(jsonData[0].service_img);
       }else{
        $('#serviceEditLoader').addClass('d-none');
         $('#serviceEditWrong').removeClass('d-none');

       }
    }).catch(function(error){
        $('#serviceEditLoader').addClass('d-none');
         $('#serviceEditWrong').removeClass('d-none');
    });
}


   //Service table Edit Modal Save  Button Click

$('#serviceEditConfirmBtn').click(function() {
    
    var id   = $('#serviceEditId').html();
    var name = $('#serviceNameId').val();
    var des  = $('#serviceDesId').val();
    var img  = $('#serviceImgId').val();

    ServiceUpdate(id,name,des,img);

})


//Service Update

function ServiceUpdate(serviceID,serviceName,serviceDes,serviceImg){

    if(serviceName.length==0){
         toastr.error('Service Name is Empty!');
    }else if(serviceDes.length==0){
         toastr.error('Service Description is Empty!');
    }else if(serviceImg.length==0){
        toastr.error('Service Image is Empty!');
    }else{

        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/ServiceUpdate',{
            id:serviceID,
            name:serviceName,
            des:serviceDes,
            img:serviceImg
        })
     .then(function(response){
         if(response.status == 200){
            $('#serviceEditConfirmBtn').html("Save"); //response pele Save show korbe

            if(response.data ==1){
                $('#editModal').modal('hide');
                toastr.success('Update Successfully!');
                getServiceData();

             }else{

                $('#editModal').modal('hide');
                toastr.error('Update Fail!');
                getServiceData();
            }

         }else{
            $('#editModal').modal('hide');
            toastr.error('Something Went Wrong!');
         }

        
         
     }).catch(function(error){
        $('#editModal').modal('hide');
        toastr.error('Something Went Wrong!');
     });


    }
   
}

    

