@extends('Layout.app')


@section('content')

<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

  <button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New Service</button>

<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


<!-- Delte Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete</h5>
      	<h6 id="serviceDeleteId" class="mt-4"> </h6>	
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
      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 
        
      	<h6 id="serviceEditId" class="mt-4"> </h6>

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
</script>


@endsection