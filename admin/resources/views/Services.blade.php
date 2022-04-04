@extends('Layout.app')


@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

  <button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New Service</button>

<table id="ServiceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
	
	
	
  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDiv" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img class="loading-icon " src="{{asset('images/loader.svg')}}">
 
</div>
</div>
</div>

<div id="wrongDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <h3>Something Went Wrong!</h3>
 
</div>
</div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete?</h5>
      	<h6 id="serviceDeleteId d-none" class="mt-2"> </h6>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
       <!-- <button data-id =" " id="serviceDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Edit and Update Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 
        
      	<h6 id="serviceEditId d-none" class="mt-4"> </h6>

          <div id="serviceUpdateForm" class="d-none w-100">  
		      	<input type="text" id="serviceNameId" class="form-control mb-4" placeholder="Service Name" />
		      	<input type="text" id="serviceDesId" class="form-control mb-4" placeholder="Service Description"/>
		      	<input type="text" id="serviceImgId" class="form-control mb-4" placeholder="Service Image Link"/>
        </div>

      	<img id="serviceEditLoader" class="loading-icon " src="{{asset('images/loader.svg')}}">
      	<h3 id="serviceEditWrong" class="d-none">Something Went Wrong!</h3>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn btn-danger">Save</button>
      
      </div>
    </div>
  </div>
</div>


<!-- Add new  Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 

          <div id="serviceAddForm" class="w-100">  
            <h6 class="mb-4">Add New Service</h6>
            <input type="text" id="serviceNameAddId" class="form-control mb-4" placeholder="Service Name" />
            <input type="text" id="serviceDesAddId" class="form-control mb-4" placeholder="Service Description"/>
            <input type="text" id="serviceImgAddId" class="form-control mb-4" placeholder="Service Image Link"/>
        </div>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn btn-danger">Add</button>
      
      </div>
    </div>
  </div>
</div>









@endsection





@section('script')
<script type="text/javascript">
	getServiceData();

  

//Service Page Table

function getServiceData() {

    axios.get('/servicesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#ServiceDataTable').DataTable().destroy();
                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a class='serviceEditBtn' data-id =" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id =" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"

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
                

                //Data table

                $('#ServiceDataTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

              

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


//Delete Service data

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


//Add New Service Button click

$('#addNewBtnId').click(function(){
    $('#addModal').modal('show');
});


//Service table Add Service Modal Add  Button Click

$('#serviceAddConfirmBtn').click(function() {

    var name = $('#serviceNameAddId').val();
    var des  = $('#serviceDesAddId').val();
    var img  = $('#serviceImgAddId').val();

    serviceAdd(name,des,img);

})



//service add method

function serviceAdd(serviceName,serviceDes,serviceImg){
    if(serviceName.length == 0){
        toastr.error('Service Name is Empty !');
    }else if(serviceDes.length == 0){
        toastr.error('Service Description is Empty !');
    }else if(serviceImg.length == 0){
        toastr.error('Service Image is Empty !');
    }else{
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/ServiceAdd',{
            name:serviceName,
            des:serviceDes,
            img:serviceImg
        })
        .then(function(response){
            if(response.status == 200){
                $('#serviceAddConfirmBtn').html("Add");

                if(response.data == 1){
                    $('#addModal').modal('hide');
                    toastr.success('Data Inserted Successfully !');
                    getServiceData();

                }else{
                    $('#addModal').modal('hide');
                    toastr.error('Data Inserted Failed !'); 
                    getServiceData();
                }
            }else{
                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong !'); 
            }

        }).catch(function(error){
            $('#addModal').modal('hide');
            toastr.error('Something Went Wrong !'); 
        });

    }
}

    


</script>


@endsection