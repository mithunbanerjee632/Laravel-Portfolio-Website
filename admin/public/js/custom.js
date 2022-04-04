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