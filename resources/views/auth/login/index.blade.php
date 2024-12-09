@extends('layouts.auth')

@section('container')
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100 bg-white">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="{{ asset('assets/images/login.jpg') }} " class="img-fluid">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 border border-2 border-light rounded-pill login-page">
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
			<button class="show-register btn btn-link">Create an Account!</button>
		</div>
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 border border-2 border-light rounded-pill register-page" style="display:none;">
        <h1 class="text-center mb-4 mt-4">Register</h1>
        <form action="#" method="POST" id="register_form" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4">
                <input type="email" id="email_reg" name="email_reg" class="form-control form-control-lg" placeholder="Enter Email Address..." value="{{ old('email_reg') }}"/>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="username_reg" name="username_reg" class="form-control form-control-lg" placeholder="Enter Username..." value="{{ old('username_reg') }}"/>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="phone_reg" name="phone_reg" class="form-control form-control-lg" placeholder="Enter Phone Number..." value="{{ old('phone_reg') }}"/>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="company_name_reg" name="company_name_reg" class="form-control form-control-lg" placeholder="Enter Company Name..." value="{{ old('company_name_reg') }}"/>
            </div>
            <div class="form-outline mb-3">
                <input type="file" class="form-control form-control-lg" id="image" name="image" onchange="previewImage()">
                <img class="img-preview img-fluid">
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="password_reg" name="password_reg" placeholder="Password" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <input type="password" id="password_confirm_reg" name="password_confirm_reg" placeholder="Confirm Password" class="form-control form-control-lg" />
            </div>
            <!-- <button class="btn btn-primary btn-lg btn-block" id="register">Register</button> -->
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="register-new">Register</button>
            <br>
            <div class="d-flex justify-content-around align-items-center mb-4">
                <a href="#!">Forgot password?</a>
                <button class="show-login btn btn-link">Login</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>
<div id="custom-overlay">
</div>
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
						    if(res.data != 0){
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
                                    title: 'Akun Anda Belum Aktif!',
                                    text: 'Silahkan cek email Anda untuk aktivasi',
                                    type: 'info'
                                });
                            }
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

        $('.show-register').click(function(){
            $('.login-page').hide();
            $('.register-page').show();
        });

        $('.show-login').click(function(){
            $('.register-page').hide();
            $('.login-page').show();
        });
    });

    $(document).on({
        ajaxStart: function(){
            $("#custom-overlay").addClass("loading-spinner"); 
        },
        ajaxStop: function(){ 
            $("#custom-overlay").removeClass("loading-spinner"); 
        }    
    });

    $("#register_form").submit(function(e) {
        e.preventDefault();
        const regData = new FormData(this);
        if(regData.get('email_reg') != '' && regData.get('phone_reg') != '' && regData.get('password_reg') != '' && regData.get('password_confirm_reg') != '' && regData.get('company_name_reg') != '' && regData.get('username_reg') != '' ){
            if(regData.get('password_reg') == regData.get('password_confirm_reg')) {
                $.ajax({
                    url: "{{ env('APP_URL') }}/register",
                    method: 'post',
                    data: regData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if(response.status == true){
                            swal({
                                title: 'Register Sukses!',
                                text: 'Silahkan Aktivasi Terlebih Dahulu Datang',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false 
                            })
                            .then((value) => {
                                document.location.href = "{{ env('APP_URL') }}/login/";
                            });
                        } else {
                            swal({
                                title: 'Email Sudah Terdaftar!',
                                text: 'Silahkan Gunakan Email Lain',
                                type: 'info'
                            });
                        }
                    }
                });
            } else {
                swal({
                    title: 'Pastikan password sudah sama!',
                    text: 'Cek lagi password Anda',
                    type: 'info'
                });
            }
        } else {
            swal({
                title: 'Pastikan semua sudah terisi!',
                text: 'Cek lagi form Anda',
                type: 'info'
            });
        }
      });

    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection