@extends('Layout.app')
@section('title','Contact')
@section('content')


<div id="mainDivContact" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<table id="ContactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Mobile</th>
	  <th class="th-sm">Email</th>
	  <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="contact_table">
	
	
	
  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDivContact" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img class="loading-icon " src="{{asset('images/loader.svg')}}">
 
</div>
</div>
</div>

<div id="wrongDivContact" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <h3>Something Went Wrong!</h3>
 
</div>
</div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete?</h5>
      	<h6 id="contactDeleteId" class="mt-2"> </h6>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button  id="contactDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      
      </div>
    </div>
  </div>
</div>


@endsection




@section('script')

<script type="text/javascript">
	
getContactData();

//Contact page

function getContactData(){
    axios.get('/getcontactsData')
    .then(function(response){
        if(response.status == 200){
           
            $('#mainDivContact').removeClass('d-none');
             $('#loaderDivContact').addClass('d-none');

             $('#ContactDataTable').DataTable().destroy();
             $('#contact_table').empty();


            var jsonData = response.data;

            $.each(jsonData,function(i){
                $('<tr>').html(
                      "<td>"+jsonData[i].contact_name+"</td>"+
                      "<td>"+jsonData[i].contact_mobile+"</td>"+
                      "<td>"+jsonData[i].contact_email+"</td>"+
                      "<td>"+jsonData[i].contact_msg+"</td>"+
                      "<td><a class='contactDeleteBtn' data-id="+jsonData[i].id+"><i class='fas fa-trash-alt'></a></a></td>"
               
                    ).appendTo('#contact_table');
            });


            //Contact table delete icon click

            $('.contactDeleteBtn').click(function(){
                var id = $(this).data('id');
                $('#contactDeleteId').html(id);
                $('#deleteContactModal').modal('show');
            });


            //Data table

            $('#ContactDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');



        }
    }).catch(function(){

    });
}


//Delete Contact Data

$('#contactDeleteConfirmBtn').click(function(){
    var id = $('#contactDeleteId').html();
    DeleteContact(id);
});

function DeleteContact(deleteId){
     $('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

   axios.post('/contactsDelete',{id:deleteId})
   .then(function(response){
     if(response.status == 200){
        $('#contactDeleteConfirmBtn').html('Yes');

        if(response.data == 1){
            $('#deleteContactModal').modal('hide');
            toastr.success('Data Deleted Successfully!');
            getContactData();
        }else{
             $('#deleteContactModal').modal('hide');
            toastr.error('Data Not Deleted !');
            getContactData();
        }
     }else{
        $('#deleteContactModal').modal('hide');
        toastr.error('Something Went Wrong !');
     }
   }).catch(function(error){
       $('#deleteContactModal').modal('hide');
        toastr.error('Something Went Wrong !');
   });
}

</script>>


@endsection