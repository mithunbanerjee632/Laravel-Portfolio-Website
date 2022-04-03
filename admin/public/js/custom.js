//Course Page Table

function getCourseData() {

    axios.get('/getcoursesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

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


                $('.courseDeleteBtn').click(function(){
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });


                $('.courseEditBtn').click(function(){
                    var id = $(this).data('id');
                    $('#CourseEditId').html(id);
                    CourseUpdateDetails(id);
                    $('#UpdateCourseModal').modal('show');
                });

                
              

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


