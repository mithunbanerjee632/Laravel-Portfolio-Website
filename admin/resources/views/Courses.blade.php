@extends('Layout.app')
@section('title','Course')

@section('content')

<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewCourseBtnId" class="btn btn-sm btn-danger my-3">Add New Course</button>

<table id="CourseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
     <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">


  </tbody>
</table>

</div>
</div>
</div>




<div id="loaderDivCourse" class="container">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <img class="loading-icon " src="{{asset('images/loader.svg')}}">

</div>
</div>
</div>


<div id="wrongDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5 text-center">
  <h3>Something Went Wrong!</h3>

</div>
</div>
</div>



<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text"  class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text"  class="form-control mb-3" placeholder="Course Description">
    		 	   <input id="CourseFeeId" type="text" class="form-control mb-3" placeholder="Course Fee">
     			   <input id="CourseEnrollId" type="text"  class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text"  class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkId" type="text"  class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text"  class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit and Update Modal -->

<div class="modal fade" id="UpdateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body  text-center">

         <h6 id="CourseEditId d-none" class="mt-4"> </h6>

       <div id="courseUpdateForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	   <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			   <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>


       	<img id="courseEditLoader" class="loading-icon " src="{{asset('images/loader.svg')}}">
      	<h3 id="courseEditWrong" class="d-none">Something Went Wrong!</h3>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center p-3">
      	<h5 class="mt-4">Are you sure to Delete?</h5>
      	<h6 id="CourseDeleteId d-none" class="mt-4"> </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button  id="CourseDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

      </div>
    </div>
  </div>
</div>



@endsection





@section('script')
<script type="text/javascript">
getCourseData();


//Course Page Table

function getCourseData() {

    axios.get('/getcoursesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');


                $('#CourseDataTable').DataTable().destroy();
                $('#course_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].course_name+ "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +

                        "<td><a class='courseEditBtn' data-id =" + jsonData[i].id + "  ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='courseDeleteBtn' data-id =" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#course_table');
                });


                  //Course  Table Delete icon click

                $('.courseDeleteBtn').click(function(){
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });

                 //Course  Table Edit icon click


                $('.courseEditBtn').click(function(){
                    var id = $(this).data('id');
                    $('#CourseEditId').html(id);
                    CourseUpdateDetails(id);
                    $('#UpdateCourseModal').modal('show');
                });

                //Data table

                $('#CourseDataTable').dataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');




            } else {

                $('#wrongDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

            }



        }).catch(function(error) {
             $('#wrongDivCourse').removeClass('d-none');
             $('#loaderDivCourse').addClass('d-none');
        });
}


$('#addNewCourseBtnId').click(function(){
    $('#addCourseModal').modal('show');
})


$('#CourseAddConfirmBtn').click(function(){
    var CourseName =$('#CourseNameId').val();
    var CourseDes =$('#CourseDesId').val();
    var CourseFee =$('#CourseFeeId').val();
    var CourseEnroll =$('#CourseEnrollId').val();
    var CourseClass =$('#CourseClassId').val();
    var CourseLink =$('#CourseLinkId').val();
    var CourseImg =$('#CourseImgId').val();

    CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);


});


//Course add method

function CourseAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){
    if(CourseName.length == 0){
        toastr.error('Course Name is Empty !');

    }else if(CourseDes.length == 0){
        toastr.error('Course Description is Empty !');

    }else if(CourseFee.length == 0){
        toastr.error('Course Fee is Empty !');

    }else if(CourseEnroll.length == 0){
        toastr.error('Course Enroll is Empty !');

    }else if(CourseClass.length == 0){
        toastr.error('Course Class is Empty !');

    }else if(CourseLink.length == 0){
        toastr.error('Course Link is Empty !');

    }else if(CourseImg.length == 0){
        toastr.error('Course Image is Empty !');

    }else{
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/coursesAdd',{
            course_name:CourseName,
            course_des:CourseDes,
            course_fee:CourseFee,
            course_totalenroll:CourseEnroll,
            course_totalclass:CourseClass,
            course_link:CourseLink,
            course_img:CourseImg

        })
        .then(function(response){
            if(response.status == 200){
                $('#CourseAddConfirmBtn').html("Add");

                if(response.data == 1){
                    $('#addCourseModal').modal('hide');
                    toastr.success('Data Inserted Successfully !');
                    getCourseData();

                }else{
                    $('#addCourseModal').modal('hide');
                    toastr.error('Data Inserted Failed !');
                    getCourseData();
                }
            }else{
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
            }

        }).catch(function(error){
             $('#addCourseModal').modal('hide');
             toastr.error('Something Went Wrong !');
        });

    }
}



//Delete Modal Yes Button click

$('#CourseDeleteConfirmBtn').click(function(){
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);

});





//Delete Course data

function CourseDelete(deleteID) {
   $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");  //animation(response pawar aage)

    axios.post('/coursesDelete', {
            id: deleteID
        })
        .then(function(response) {

            if(response.status==200){
              $('#CourseDeleteConfirmBtn').html("Yes"); //response pele yes show korbe

                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Successfully Deleted');
                    getCourseData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Fail!');
                    getCourseData();
                }

            }else{
                 $('#deleteCourseModal').modal('hide');
                 toastr.error('Something Went Wrong!');
            }

        }).catch(function(error) {
              $('#deleteCourseModal').modal('hide');
              toastr.error('Something Went Wrong!');
        });
}


//Each Course Details

function CourseUpdateDetails(editID){
    axios.post('/coursesDetails',{ id:editID })
    .then(function(response){

       if(response.status == 200){

          $('#courseUpdateForm').removeClass('d-none');
          $('#courseEditLoader').addClass('d-none');

        var jsonData =response.data;

          $('#CourseNameUpdateId').val(jsonData[0].course_name );
          $('#CourseDesUpdateId').val(jsonData[0].course_des);
          $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
          $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
          $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
          $('#CourseLinkUpdateId').val(jsonData[0].course_link);
          $('#CourseImgUpdateId').val(jsonData[0].course_img);
       }else{
        $('#courseEditLoader').addClass('d-none');
        $('#courseEditWrong').removeClass('d-none');

       }
    }).catch(function(error){
        $('#courseEditLoader').addClass('d-none');
         $('#courseEditWrong').removeClass('d-none');
    });
}


$('#CourseUpdateConfirmBtn').click(function(){
    var CourseId = $('#CourseEditId').html();
    var CourseName =$('#CourseNameUpdateId').val();
    var CourseDes =$('#CourseDesUpdateId').val();
    var CourseFee =$('#CourseFeeUpdateId').val();
    var CourseEnroll =$('#CourseEnrollUpdateId').val();
    var CourseClass =$('#CourseClassUpdateId').val();
    var CourseLink =$('#CourseLinkUpdateId').val();
    var CourseImg =$('#CourseImgUpdateId').val();

   CourseUpdate(CourseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);

});


//Course Update

function CourseUpdate(CourseId,CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg){
    if(CourseName.length == 0){
        toastr.error('Course Name is Empty !');

    }else if(CourseDes.length == 0){
        toastr.error('Course Description is Empty !');

    }else if(CourseFee.length == 0){
        toastr.error('Course Fee is Empty !');

    }else if(CourseEnroll.length == 0){
        toastr.error('Course Enroll is Empty !');

    }else if(CourseClass.length == 0){
        toastr.error('Course Class is Empty !');

    }else if(CourseLink.length == 0){
        toastr.error('Course Link is Empty !');

    }else if(CourseImg.length == 0){
        toastr.error('Course Image is Empty !');

    }else{

        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>"); //spinner animation(response pawar aage)

        axios.post('/coursesUpdate',{
            id:CourseId,
            course_name:CourseName,
            course_des:CourseDes,
            course_fee:CourseFee,
            course_totalenroll:CourseEnroll,
            course_totalclass:CourseClass,
            course_link:CourseLink,
            course_img:CourseImg
        })
     .then(function(response){
         if(response.status == 200){
            $('#CourseUpdateConfirmBtn').html("Update"); //response pele Save show korbe

            if(response.data ==1){
                $('#UpdateCourseModal').modal('hide');
                toastr.success('Update Successfully!');
                getCourseData();

             }else{

                $('#UpdateCourseModal').modal('hide');
                toastr.error('Update Fail!');
                getCourseData();
            }

         }else{
            $('#UpdateCourseModal').modal('hide');
            toastr.error('Something Went Wrong!');
         }



     }).catch(function(error){
        $('#UpdateCourseModal').modal('hide');
        toastr.error('Something Went Wrong!');
     });


    }

}





</script>


@endsection
