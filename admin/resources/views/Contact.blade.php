@extends('Layout.app')

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

</script>>


@endsection