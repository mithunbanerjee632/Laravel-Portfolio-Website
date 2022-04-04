@extends('Layout.app')


@section('content')

<div id="mainDivRivew" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

  <button id="addNewReviewBtnId" class="btn btn-sm btn-danger my-3">Add New Review</button>

<table id="ReviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      
	  <th class="th-sm text-center">Name</th>
	  <th class="th-sm text-center" style="width:50%;">Description</th>
	  <th class="th-sm text-center">Edit</th>
	  <th class="th-sm text-center">Delete</th>
    </tr>
  </thead>
  <tbody id="review_table">
	
	
	
  </tbody>
</table>
</div>
</div>
</div>


<div id="loaderDivReview" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img class="loading-icon " src="{{asset('images/loader.svg')}}">
 
</div>
</div>
</div>

<div id="wrongDivReview" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <h3>Something Went Wrong!</h3>
 
</div>
</div>
</div>



<!-- Add new  Modal -->
<div class="modal fade" id="addModalReview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 

          <div id="ReviewAddForm" class="w-100">  
            <h6 class="mb-4">Add New Review</h6>
            <input type="text" id="reviewNameAddId" class="form-control mb-4" placeholder="Review Name" />
            <input type="text" id="reviewDesAddId" class="form-control mb-4" placeholder="Review Description"/>
            <input type="text" id="reviewImgAddId" class="form-control mb-4" placeholder="Review Image Link"/>
        </div>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="reviewAddConfirmBtn" type="button" class="btn btn-danger">Add</button>
      
      </div>
    </div>
  </div>
</div>


<!-- Edit and Update Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title">Update Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body text-center p-5">
       <div class="form-outline mb-4"> 
        
      	<h6 id="reviewEditId" class="mt-4 d-none"> </h6>

          <div id="ReviewUpdateForm" class=" w-100 d-none">  
		      	<input type="text" id="reviewNameId" class="form-control mb-4" placeholder="Review Name" />
		      	<input type="text" id="reviewDesId" class="form-control mb-4" placeholder="Review Description"/>
		      	<input type="text" id="reviewImgId" class="form-control mb-4" placeholder="Review Image Link"/>
        </div>

      	<img id="ReviewEditLoader" class="loading-icon " src="{{asset('images/loader.svg')}}">
      	<h3 id="ReviewEditWrong" class="d-none">Something Went Wrong!</h3>
      </div>
    
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button  id="ReviewUpdateConfirmBtn" type="button" class="btn btn-danger">Update</button>
      
      </div>
    </div>
  </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete?</h5>
      	<h6 id="ReviewDeleteId" class="mt-2 d-none"> </h6>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button  id="ReviewDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>
      
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

<script type="text/javascript">
	getReviewData();
</script>>
@endsection