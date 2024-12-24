@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Item</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12 text-right pr-3">
                <a href="" class="btn btn-primary" id="add" data-toggle="modal" data-target="#itemModal">
                    <i class="fa fa-user-plus"></i>  Tambah Item
                </a>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-item display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Satuan</th>
                                <th>Harga Per Satuan</th>
                                <th>Durasi Kadaluarsa</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ indo_currency($item->unit_price) }}</td>
                                    <td>{{ Date("d-m-Y", $item->expired_date) }}</td>
                                    <td><img src="{{ asset('assets/images/item/'.$item->image) }}" class="img-fluid"></td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-item" data-id="<?= $item->id ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-item" data-id="<?= $item->id ?>">Delete</button>
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

<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="itemModalLabel">Tambah Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="#" method="POST" id="item_form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Nama Item: </label>
                                        <input type="text" class="form-control" id="name" name="name" />
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Satuan: </label>
                                        <input type="text" class="form-control" id="satuan" name="satuan" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Harga Satuan: </label>
                                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Kadaluarsa: </label>
                                        <input type="date" class="form-control" id="expired" name="expired" min="{{ date('Y-m-d'); }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Gambar: </label>
                                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                                        <img class="img-preview img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right pb-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary add-item">Tambah</button>
                                <button type="submit" class="btn btn-primary item-edit" style="display:none;">Ubah</button>
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

        $('.table-item').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $("#item_form").submit(function(e) {
            e.preventDefault();
            const regData = new FormData(this);
            if(regData.get('name') != ''){
                $.ajax({
                    url: "{{ env('APP_URL') }}/item",
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
                                title: status+' Item Sukses!',
                                text: 'Item Baru Berhasil Di '+status,
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

            $('.add-item').show();
            $('.item-edit').hide();
        });

        $(document).on("click",".edit-item",function() {
            const itemId = $(this).data('id');

            status = 'Ubah';

            $('.add-item').hide();
            $('.item-edit').show();
            $('#itemModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/item/"+itemId+"/edit",
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    console.log(data);
                    $('#name').val(data.name);
                    $('#id').val(data.id);
                    $('#satuan').val(data.satuan);
                    $('#harga_satuan').val(data.harga_satuan);
                    $('#expired').val(data.expired);
                    $('.img-preview').attr('src',"{{ asset('assets/images/item/') }}/"+data.image);
                }
            });
        });

        $('.delete-item').on('click',function(){
            const itemId = $(this).data('id');
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
                        url: "{{ env('APP_URL') }}/item/"+itemId,
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
