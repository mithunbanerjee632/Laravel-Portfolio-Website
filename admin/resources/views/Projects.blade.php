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
</script>




@endsection