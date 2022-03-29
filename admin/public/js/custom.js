//Visitor Page Table

$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


//Service Page Table

function getServiceData() {

    axios.get('/servicesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + "</td>" +
                        "<td><a href='' ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id =" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"

                    ).appendTo('#service_table');
                });

                //Service  Table icon click

                $('.serviceDeleteBtn').click(function() {
                    var id = $(this).data('id');

                    //$('#serviceDeleteConfirmBtn').attr('data-id',id);
                    $('#serviceDeleteId').html(id)
                    $('#deleteModal').modal('show');
                })

                //Service table Modal Button Yes Click

                $('#serviceDeleteConfirmBtn').click(function() {
                    //var id = $(this).data('id')
                    var id = $('#serviceDeleteId').html();
                    ServiceDelete(id);

                });


            } else {

                $('#wrongDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

            }



        }).catch(function(error) {
            $('#wrongDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
        });
}


//Delete Service table

function ServiceDelete(deleteID) {
    axios.post('/servicesDelete', {
            id: deleteID
        })
        .then(function(response) {


            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Successfully Deleted');
                getServiceData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Fail!');
                getServiceData();
            }

        }).catch(function(error) {


        });
}