@extends('Layout.app')

@section('title','Reviews')
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
    //Review Page

    function getReviewData(){
        axios.get('/getreviewsdata')
            .then(function(response){
                if(response.status = 200){
                    $('#mainDivRivew').removeClass('d-none');
                    $('#loaderDivReview').addClass('d-none');


                    $('#ReviewDataTable').DataTable().destroy();
                    $('#review_table').empty();

                    var jsonData =response.data;

                    $.each(jsonData,function(i){
                        $('<tr>').html(
                            "<td>"+jsonData[i].name+"</td>"+
                            "<td>"+jsonData[i].des+"</td>"+
                            "<td><a class='reviewEditBtn' data-id =" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                            "<td><a class='reviewDeleteBtn' data-id =" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"



                        ).appendTo('#review_table');
                    });

                    //Review table Edit Icon click

                    $('.reviewEditBtn').click(function(){
                        var id = $(this).data('id');
                        $('#reviewEditId').html(id);

                        getReviewDetails(id);
                        $('#editReviewModal').modal('show');
                    });

                    //Review table Delete Icon click

                    $('.reviewDeleteBtn').click(function(){
                        var id = $(this).data('id');
                        $('#ReviewDeleteId').html(id);

                        $('#deleteReviewModal').modal('show');
                    });

                    //Data table

                    $('#ReviewDataTable').DataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');


                }else{
                    $('#wrongDivReview').removeClass('d-none');
                    $('#loaderDivReview').addClass('d-none');
                }
            }).catch(function(error){
            $('#wrongDivReview').removeClass('d-none');
            $('#loaderDivReview').addClass('d-none');
        });
    }


    $('#addNewReviewBtnId').click(function(){
        $('#addModalReview').modal('show');
    });

    $('#reviewAddConfirmBtn').click(function(){
        var name = $('#reviewNameAddId').val();
        var des = $('#reviewDesAddId').val();
        var img = $('#reviewImgAddId').val();

        ReviewAdd(name,des,img);
    });

    //Add Review Data

    function ReviewAdd(reviewName,reviewDes,reviewImg){

        if(reviewName.length == 0){
            toastr.error('Name is Empty !');
        }else if(reviewDes.length == 0){
            toastr.error('Description is Empty !');
        }else if(reviewImg.length == 0){
            toastr.error('Image is Empty !');
        }else{

            $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)
            axios.post('/addreviewsdata',{
                name:reviewName,
                des:reviewDes,
                img:reviewImg
            })
                .then(function(response){
                    if(response.status == 200){
                        $('#reviewAddConfirmBtn').html('Add');

                        if(response.data == 1){
                            $('#addModalReview').modal('hide');
                            toastr.success('Data Inserted Successfully!');
                            getReviewData();

                        }else{
                            $('#addModalReview').modal('hide');
                            toastr.error('Data Not Inserted !');
                            getReviewData();
                        }
                    }else{
                        $('#addModalReview').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                }).catch(function(error){
                $('#addModalReview').modal('hide');
                toastr.error('Something Went Wrong !');
            });
        }



    }

    //Each Review Details

    function getReviewDetails(editId){
        axios.post('/getreviewsdetails',{id:editId})
            .then(function(response){
                if(response.status == 200){
                    $('#ReviewUpdateForm').removeClass('d-none');
                    $('#ReviewEditLoader').addClass('d-none');

                    var jsonData = response.data;

                    $('#reviewNameId').val(jsonData[0].name);
                    $('#reviewDesId').val(jsonData[0].des);
                    $('#reviewImgId').val(jsonData[0].img);



                }else{
                    $('#ReviewEditLoader').addClass('d-none');
                    $('#ReviewEditWrong').removeClass('d-none');
                }
            }).catch(function(error){
            $('#ReviewEditLoader').addClass('d-none');
            $('#ReviewEditWrong').removeClass('d-none');
        });
    }

    //Update Review

    $('#ReviewUpdateConfirmBtn').click(function(){
        var id = $('#reviewEditId').html();
        var name =$('#reviewNameId').val();
        var des =$('#reviewDesId').val();
        var img =$('#reviewImgId').val();
        ReviewUpdate(id,name,des,img);
    });

    function ReviewUpdate(reviewId,reviewName,reviewDes,reviewImg){
        if(reviewName.length == 0){
            toastr.error('Name is Empty!');
        }else if(reviewDes.length == 0){
            toastr.error('Description is Empty!');
        }else if(reviewImg.length == 0){
            toastr.error('Image is Empty!');
        }else{
            $('#ReviewUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

            axios.post('/reviewsupdate',{
                id:reviewId,
                name:reviewName,
                des:reviewDes,
                img:reviewImg
            })
                .then(function(response){
                    if(response.status == 200){
                        $('#ReviewUpdateConfirmBtn').html('Update');
                        if(response.data == 1){
                            $('#editReviewModal').modal('hide');
                            toastr.success('Data Updated Successfully!');
                            getReviewData();
                        }else{
                            $('#editReviewModal').modal('hide');
                            toastr.error('Data Not Updated !');
                            getReviewData();
                        }
                    }else{
                        $('#editReviewModal').modal('hide');
                        toastr.error('Something Went Wrong !');
                    }
                }).catch(function(error){
                $('#editReviewModal').modal('hide');
                toastr.error('Something Went Wrong !');
            });
        }


    }



    //Delete Modal Yes Button Click

    $('#ReviewDeleteConfirmBtn').click(function(){
        var id = $('#ReviewDeleteId').html();
        ReviewDelete(id);


    });

    //Review Delete

    function ReviewDelete(deleteId){
        $('#ReviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/reviewsdelete',{id:deleteId})
            .then(function(response){
                if(response.status == 200){
                    $('#ReviewDeleteConfirmBtn').html('Yes');

                    if(response.data == 1){
                        $('#deleteReviewModal').modal('hide');
                        toastr.success('Data Deleted Successfully!');
                        getReviewData();

                    }else{
                        $('#deleteReviewModal').modal('hide');
                        toastr.success('Data Not Deleted !');
                        getReviewData();
                    }
                }else{
                    ('#deleteReviewModal').modal('hide');
                    toastr.success('Something Went Wrong !');
                }

            }).catch(function(error){
            ('#deleteReviewModal').modal('hide');
            toastr.success('Something Went Wrong !');
        });
    }


</script>>
@endsection
