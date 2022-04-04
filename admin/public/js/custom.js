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