@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Pegawai Cabang</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">

            <div class="row">
                <div class="col-lg-12 text-right pr-3">
                <a href="" class="btn btn-primary" id="add" data-toggle="modal" data-target="#usercabangModal">
                    <i class="fa fa-user-plus"></i>  Tambah Pegawai Cabang
                </a>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-cabang display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Cabang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($userbranches as $index => $userbranch)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $userbranch->username }}</td>
                                    <td>{{ $userbranch->name }}</td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-userbranch" data-id="<?= $userbranch->userbranchid ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-userbranch" data-id="<?= $userbranch->userbranchid ?>">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
                </div>


            </div>
            <!-- /quick stats boxes -->

        </div>

    </div>
    <!-- /dashboard content -->

</div>

<div class="modal fade" id="usercabangModal" tabindex="-1" role="dialog" aria-labelledby="usercabangModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="usercabangModalLabel">Tambah Pegawai Cabang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="#" method="POST" id="userbranch_form">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Nama Cabang: </label>
                                        <select name="cabang" id="cabang" class="form-control">
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Pegawai</label>
                                        <select name="pegawai" id="pegawai" class="form-control">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->userid }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right pb-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary add-userbranch">Tambah</button>
                                <button type="submit" class="btn btn-primary userbranch-edit" style="display:none;">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- /content area -->

@include('layouts.admin.footer')

</div>
<!-- /main content -->

<script>
	$(document).ready(function(){
        status = 'Tambah';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.table-cabang').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $("#userbranch_form").submit(function(e) {
            e.preventDefault();
            const regData = new FormData(this);
            $.ajax({
                url: "{{ env('APP_URL') }}/userbranch",
                method: 'post',
                data: regData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if(response.status == true){
                        swal({
                            title: status+' Pegawai Sukses!',
                            text: 'Pegawai Baru Berhasil Di '+status,
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false 
                        })
                        .then((value) => {
                            location.reload();
                        });
                    }
                }
            });
        });

        $('#add').on('click',function(){
            status = 'Tambah';

            $('.add-userbranch').show();
            $('.userbranch-edit').hide();
        });

        $(document).on("click",".edit-userbranch",function() {
            const userbranchId = $(this).data('id');

            status = 'Ubah';

            $('.add-userbranch').hide();
            $('.userbranch-edit').show();
            $('#usercabangModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/userbranch/"+userbranchId+"/edit",
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    console.log(data);
                    $('#cabang').val(data.branch_id);
                    $('#id').val(data.userbranchid);
                    $('#pegawai').val(data.user_id);
                }
            });
        });

        $('.delete-userbranch').on('click',function(){
            const branchId = $(this).data('id');
            swal({
                title: 'Anda yakin ingin menghapus data ini?',
                text: 'Data yang sudah dihapus tidak akan bisa dikembalikan',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete data!'
            })
            .then((willDelete)=>{
                if(willDelete.value){
                    $.ajax({
                        type: "DELETE",
                        url: "{{ env('APP_URL') }}/userbranch/"+branchId,
                        success: function(data){
                            var res = JSON.parse(data);
                            if(res.status == true){
                                swal({
                                    type: 'success',
                                    title: 'Data Berhasil Dihapus!',
                                    text: 'Hapus Data Sukses',
                                    timer: 2000,
                                    showConfirmButton: false 
                                })
                                .then((value) => {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    type: 'error',
                                    title: 'Hapus Data Gagal!',
                                    text: 'Silahkan Coba Beberapa Saat Lagi',
                                    timer: 2000,
                                });
                            }
                        }
                    });
                }else{
                    swal({
                        type: 'warning',
                        title: 'Anda Memilih Tidak Menghapus!',
                        text: 'Tidak Jadi Menghapus',
                        timer: 2000,
                        showConfirmButton: false 
                    });
                }
            });
        });
    });
</script>
@endsection
