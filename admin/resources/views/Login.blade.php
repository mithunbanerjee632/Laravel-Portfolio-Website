@extends('Layout.app2')
@section('title','Login')
@section('content')

<div class="container">
  <div class="row d-flex justify-content-center mb-5 mt-5">
      <div class="col-md-10 card">
          <div class="row">
            <div style="" class="col-md-6 p-3">
                <form action=" "  class="loginForm m-5">
                  <div class="mb-3 form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" required>
                  </div>
                  <div class="mb-3 form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                      <button name="submit" type="submit" class="btn btn-block btn-danger">Submit</button>
                  </div>

               </form>
            </div>

             <div style="height:450px;" class="col-md-6 bg-light" >
               <img class="w-75 m-5" src="images/bannerImg1.png">
            </div>
          </div>
      </div>
  </div>

</div>

@endsection



@section('script')
<script type="text/javascript">
  $('.loginForm').on('submit',function(event){
      event.preventDefault();

      let formData = $(this).serializeArray(); //serialize array call korle inputer data serial e chole asbe
      let userName = formData[0]['value'];
      let password = formData[1]['value'];

      let url = "/onlogin";

      axios.post(url,{
        user:userName,
        pass:password

      })
      .then(function(response){
        if(response.status == 200 && response.data == 1){
           window.location.href="/";
        }else{
          toastr.error('Login Failed! Please try Again!');
        }
      })
      .catch(function(error){
         toastr.error('Something Went Wrong');
      });
  });
</script>


@endsection
