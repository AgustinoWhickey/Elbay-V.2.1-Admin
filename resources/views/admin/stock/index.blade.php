@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Stock</h4>
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
                    <i class="fa fa-user-plus"></i>  Tambah Stock
                </a>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-stock display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Item</th>
                                <th>Supplier</th>
                                <th>Tanggal In/Out</th>
                                <th>Stok In/Out</th>
                                <th>Sisa Stok </th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($stocks as $index => $stock)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $stock->item_name }}</td>
                                    <td>{{ $stock->supplier_name }}</td>
                                    <td>{{ Date("d-m-Y", $stock->date) }}</td>
                                    <td>{!! ($stock->type == "in" ? "<span class='badge bg-success'>$stock->qty</span>" : "<span class='badge bg-danger'>$stock->qty</span>") !!}</td>
                                    <td>{{ $stock->item_stock }}</td>
                                    <td>{{ $stock->detail }}</td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-stock" data-id="<?= $stock->id ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-stock" data-id="<?= $stock->id ?>">Delete</button>
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
				<h5 class="modal-title" id="itemModalLabel">Tambah Stock</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form action="#" method="POST" id="stock_form">
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Item: </label>
                                        <select name="name" id="name" class="form-control">
                                            @foreach ($unititems as $unititem)
                                                <option value="{{ $unititem->id }}">{{ $unititem->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Qty: </label>
                                        <input type="text" class="form-control" id="qty" name="qty" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Supplier: </label>
                                        <select name="supplier" id="supplier" class="form-control">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Masuk: </label>
                                        <input type="date" class="form-control" id="indate" name="indate" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Detail: </label>
                                        <textarea class="form-control form-control-lg" id="detail" name="detail" cols="20" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right pb-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary add-stock">Tambah</button>
                                <button type="submit" class="btn btn-primary stock-edit" style="display:none;">Ubah</button>
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

        $('.table-stock').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $("#stock_form").submit(function(e) {
            e.preventDefault();
            const regData = new FormData(this);
            if(regData.get('name') != '' && regData.get('indate') != ''){
                $.ajax({
                    url: "{{ env('APP_URL') }}/stock",
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
                                text: 'Stock Baru Berhasil Di '+status,
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

            $('.add-stock').show();
            $('.stock-edit').hide();
        });

        $(document).on("click",".edit-stock",function() {
            const stockId = $(this).data('id');

            status = 'Ubah';

            $('.add-stock').hide();
            $('.stock-edit').show();
            $('#itemModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/stock/"+stockId+"/edit",
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    $('#name').val(data.item_id);
                    $('#id').val(data.id);
                    $('#qty').val(data.qty);
                    $('#supplier').val(data.supplier);
                    $('#indate').val(data.date);
                    $('#detail').val(data.detail);
                }
            });
        });

        $('.delete-stock').on('click',function(){
            const stockId = $(this).data('id');
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
                        url: "{{ env('APP_URL') }}/stock/"+stockId,
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
