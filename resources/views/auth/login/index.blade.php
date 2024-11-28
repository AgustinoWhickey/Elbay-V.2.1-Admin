@extends('layouts.auth')

@section('container')
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100 bg-white">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="{{ asset('assets/images/login.jpg') }} " class="img-fluid">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 border border-2 border-light rounded-pill">
        <h1 class="text-center mb-4 mt-4">Login</h1>
		<div class="form-outline mb-4">
			<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter Email Address..." value="{{ old('email') }}"/>
		</div>
		<div class="form-outline mb-4">
			<input type="password" id="password" name="password" placeholder="Password" class="form-control form-control-lg" />
		</div>
		<button class="btn btn-primary btn-lg btn-block" id="signin">Sign in</button>
		<br>
		<div class="d-flex justify-content-around align-items-center mb-4">
			<a href="#!">Forgot password?</a>
			<a href="#!">Create an Account!</a>
		</div>
      </div>
    </div>
  </div>
</section>
<script>
	$(document).ready(function(){
        $('#signin').click(function(){
            var email = $('#email').val();
			var pass = $('#password').val();
			if(email != '' && pass != '' ){
                $.ajax({
					type: "POST",
					url: "{{ env('APP_URL') }}/login",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "email": email,
                        "password": pass
                    },
					success: function(data){
						var res = JSON.parse(data);
						if(res.status == true){
                            swal({
                                title: 'Login Sukses!',
                                text: 'Selamat Datang',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false 
                            })
							.then((value) => {
								document.location.href = "{{ env('APP_URL') }}/set_login/"+email;
							});
						}else{
                            swal({
                                title: 'Login Gagal!',
                                text: 'Pastikan Semua Benar',
                                type: 'error',
                                timer: 2000,
                            });
						}
					}
				});
            }else{
                swal({
                    title: 'Pastikan semua sudah terisi!',
                    text: 'Cek lagi form Anda',
                    type: 'info'
                });
			}
        });
    });
</script>
@endsection