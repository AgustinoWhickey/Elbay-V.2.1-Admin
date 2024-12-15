@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Cabang</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12 text-right pr-3">
                <a href="" class="btn btn-primary" id="add" data-toggle="modal" data-target="#cabangModal">
                    <i class="fa fa-user-plus"></i>  Tambah Cabang
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
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($branches as $index => $branch)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->phone }}</td>
                                    <td>{{ $branch->address }}</td>
                                    <td>{{ $branch->description }}</td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-branch" data-id="<?= $branch->id ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-branch" data-id="<?= $branch->id ?>">Delete</button>
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

<div class="modal fade" id="cabangModal" tabindex="-1" role="dialog" aria-labelledby="cabangModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cabangModalLabel">Tambah Cabang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="#" method="POST" id="branch_form">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Nama Cabang: </label>
                                        <input type="text" class="form-control" id="name" name="name" />
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nomor Telepon</label>
                                        <input type="text" id="phone" name="phone" class="form-control"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Alamat: </label>
                                        <textarea class="form-control form-control-lg" id="address" name="address" cols="20" rows="3"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control form-control-lg" id="description" name="description" cols="20" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right pb-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary add-branch">Tambah</button>
                                <button type="submit" class="btn btn-primary branch-edit" style="display:none;">Ubah</button>
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

        $("#branch_form").submit(function(e) {
            e.preventDefault();
            const regData = new FormData(this);
            if(regData.get('name') != '' && regData.get('phone') != '' && regData.get('address') != ''){
                $.ajax({
                    url: "{{ env('APP_URL') }}/branch",
                    method: 'post',
                    data: regData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if(response.status == true){
                            swal({
                                title: status+' Cabang Sukses!',
                                text: 'Cabang Baru Berhasil Di '+status,
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
            } else {
                swal({
                    title: 'Pastikan semua sudah terisi!',
                    text: 'Cek lagi form Anda',
                    type: 'info'
                });
            }
        });

        $('#add').on('click',function(){
            status = 'Tambah';

            $('.add-branch').show();
            $('.branch-edit').hide();
        });

        $(document).on("click",".edit-branch",function() {
            const branchId = $(this).data('id');

            status = 'Ubah';

            $('.add-branch').hide();
            $('.branch-edit').show();
            $('#cabangModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/branch/"+branchId+"/edit",
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    $('#name').val(data.name);
                    $('#id').val(data.id);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#description').val(data.description);
                }
            });
        });

        $('.delete-branch').on('click',function(){
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
                        url: "{{ env('APP_URL') }}/branch/"+branchId,
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
