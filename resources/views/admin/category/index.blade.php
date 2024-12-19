@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Kategori</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12 text-right pr-3">
                <a href="" class="btn btn-primary" id="add" data-toggle="modal" data-target="#kategoriModal">
                    <i class="fa fa-user-plus"></i>  Tambah Kategori
                </a>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-category display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-category" data-id="<?= $category->id ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-category" data-id="<?= $category->id ?>">Delete</button>
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

<div class="modal fade" id="kategoriModal" tabindex="-1" role="dialog" aria-labelledby="kategoriModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="#" method="POST" id="category_form">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Nama Kategori: </label>
                                        <input type="text" class="form-control" id="name" name="name" />
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Deskripsi</label>
                                        <textarea class="form-control form-control-lg" id="description" name="description" cols="20" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right pb-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary add-category">Tambah</button>
                                <button type="submit" class="btn btn-primary category-edit" style="display:none;">Ubah</button>
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

        $('.table-category').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $("#category_form").submit(function(e) {
            e.preventDefault();
            const regData = new FormData(this);
            if(regData.get('name') != ''){
                $.ajax({
                    url: "{{ env('APP_URL') }}/category",
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
                                title: status+' Kategori Sukses!',
                                text: 'Kategori Baru Berhasil Di '+status,
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

            $('.add-category').show();
            $('.category-edit').hide();
        });

        $(document).on("click",".edit-category",function() {
            const categoryId = $(this).data('id');

            status = 'Ubah';

            $('.add-category').hide();
            $('.category-edit').show();
            $('#kategoriModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/category/"+categoryId+"/edit",
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    console.log(data.data.category);
                    $('#name').val(data.data.category.name);
                    $('#id').val(data.data.category.id);
                    $('#description').val(data.data.category.description);
                }
            });
        });

        $('.delete-category').on('click',function(){
            const categoryId = $(this).data('id');
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
                        url: "{{ env('APP_URL') }}/category/"+categoryId,
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
