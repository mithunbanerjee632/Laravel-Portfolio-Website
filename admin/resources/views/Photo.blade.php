
@extends('Layout.app')
@section('title','Photo Gallery')
@section('content')

     <div id="mainPhotoDiv" class="container">
         <div class="row">
             <div class="col-md-12 p-5">

                 <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn btn-sm btn-danger my-3">Add New</button>
             </div>
         </div>
     </div>

   <div class="container-fluid">
         <div class="row  PhotoRow">



         </div>
     </div>




    <div class="modal fade" id="PhotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Photo</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" id="imgInput" class="form-control">
                    <img src="{{asset('images/default_image.png')}}" alt="" id="imgPreview" class="imagePreview mt-3">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button id="photoSave" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('script')


    <script type="text/javascript">
        $('#imgInput').change(function(){
            var reader = new FileReader();  //FileReader() hocce js er class ja  diye file read kora jay
            reader.readAsDataURL(this.files[0]);//input e j data asbe take File reader diye read korbo as data url diye
            reader.onload =function (event){
                var imgSource = event.target.result; //image source k dhora hoice
                $('#imgPreview').attr('src',imgSource);
            }
        });

        $('#photoSave').on('click',function (){
            $('#photoSave').html("<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'></span></div>");

            var photoFile = $('#imgInput').prop('files')[0];
            var formData = new FormData();
            formData.append('photo',photoFile);

            axios.post("/photoupload",formData).then(function(response){
                if(response.status == 200 && response.data == 1){
                    $('#photoSave').html('Save');
                    $('#PhotoModal').modal('hide');
                    toastr.success('Photo Upload Successfully!');
                }else{
                    $('#photoSave').html('Save');
                    $('#PhotoModal').modal('hide');
                    toastr.error('Photo Upload Failed!');
                }
            }).catch(function (error) {
                $('#photoSave').html('Save');
                $('#PhotoModal').modal('hide');
                toastr.error('Photo Upload Failed!');
            });
        });

        PhotoLoad();

        function PhotoLoad(){
            axios.get('/photojson').then(function(response){
                $.each(response.data, function(i, item) {
                    $("<div class='col-md-3 p-1'>").html(
                       "<img class='imageOnRow' src="+item['location']+" >"

                    ).appendTo('.PhotoRow');
                });
            }).catch(function(error){

            });
        }





    </script>
@endsection





