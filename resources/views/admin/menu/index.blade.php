@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Kelola Menu</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-12 text-right pr-3">
                <a href="" class="btn btn-primary" id="add" data-toggle="modal" data-target="#menuModal">
                    <i class="fa fa-user-plus"></i>  Tambah Menu
                </a>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-menu display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Kadaluarsa </th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($menus as $index => $menu)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->code }}</td>
                                    <td>{{ $menu->category_name }}</td>
                                    <td>{{ indo_currency($menu->price) }}</td>
                                    <td>{{ $menu->stock }}</td>
                                    <td>{{ Date("d-m-Y", $menu->expired_date) }}</td>
                                    <td><img src="{{ asset('assets/images/menu/'.$menu->image) }}" class="img-responsive" style="width:150px;"></td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info edit-menu" data-id="<?= $menu->id ?>">Edit</button>
                                        <button type="button" class="btn btn-xs btn-danger delete-menu" data-id="<?= $menu->id ?>" data-image="<?= $menu->image ?>">Delete</button>
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

<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="menuModalLabel">Tambah Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body pb-0">
                        <form class="wizard-form steps-menu" action="#" method="POST" id="menu_form" data-fouc>
                            <h6>Menu Input</h6>
                            <fieldset>
                                <div class="form-group">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Nama Menu: </label>
                                            <input type="text" class="form-control" id="name" name="name" />
                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" id="old_image" name="old_image">
                                            <input type="hidden" id="url" name="url" value="{{ env('APP_URL') }}/menu">
                                            <input type="hidden" id="urlMenuItem" name="urlMenuItem" value="{{ env('APP_URL') }}/menuitem">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Kode: </label>
                                            <input type="text" class="form-control" id="kode" name="kode" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Kategori: </label>
                                            <select name="kategori" id="kategori" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Harga: </label>
                                            <input type="text" class="form-control" id="harga" name="harga" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Kadaluarsa: </label>
                                            <input type="date" class="form-control" id="exdate" name="exdate" />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Gambar: </label>
                                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                                            <img class="img-preview img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h6>Input Stok</h6>
                            <fieldset>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="useitem" name="useitem" class="form-check-input">
                                                Pakai Bahan Baku
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="stokmenu">
                                        <label>Stok: </label>
                                        <input type="text" class="form-control" id="stok" name="stok" />
                                    </div>
                                    <div class="col-md-12 mt-3" id="tablemenu" style="display:none;">
                                        <div class="row mb-3">
                                            <div class="col-md-5">
                                                <label>Item: </label>
                                                <input type="hidden" id="idbahan" name="idbahan" value="1">
                                                <input type="hidden" id="selectedbahan" name="selectedbahan">
                                                <input type="hidden" id="stockbahan" name="stockbahan">
                                                <select name="menuitem" id="menuitem" class="form-control">
                                                    <option value="" selected>-- Pilih Bahan --</option>
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}" stock="{{ $item->item_stock }}" desc="{{ $item->name }} - ({{ $item->item_stock }} {{ $item->unit }})">{{ $item->name }} - ({{ $item->item_stock }} {{ $item->unit }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Qty: </label>
                                                <input type="text" class="form-control" id="qtyitem" name="qtyitem" />
                                            </div>
                                            <div class="col-md-2 mt-4">
                                                <button type="button" class="btn btn-primary" id="tambahbahan">Tambah</button>
                                            </div>
                                        </div>
                                        <table class="table table-bordered display" id="tablebahan">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Bahan Baku</th>
                                                    <th>Stock</th>
                                                    <th>Qty</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </fieldset>
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

        $('.table-menu').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $("#useitem").change(function() {
            if(this.checked) {
                $('#tablemenu').show();
                $('#stokmenu').hide();
            } else {
                $('#tablemenu').hide();
                $('#stokmenu').show();
            }
        });

        $("#menuitem").change(function(){ 
            var element = $(this).find('option:selected'); 
            var myTag = element.attr("desc");
            var myStock = element.attr("stock");

            $('#selectedbahan').val(myTag); 
            $('#stockbahan').val(myStock); 
        }); 

        $('#tambahbahan').on('click', function(e){
            var idbahan = $('#idbahan').val();
            var menuitem = $('#menuitem').val();
            var selectedbahan = $('#selectedbahan').val();
            var qty = $('#qtyitem').val();
            var stock = $('#stockbahan').val();

            if(menuitem != '' && qty != ''){
                if(parseInt(stock) > parseInt(qty) ){
                    id = parseInt(idbahan);
                    $('#idbahan').val(id+1);
                    $('#menuitem').val('');
                    $('#qtyitem').val('');

                    var newdata = "<tr><td>"+idbahan+"</td><td>"+selectedbahan+"</td><td>"+stock+"</td><td>"+qty+"</td><td><input type='hidden' name='bahan"+idbahan+"' value='"+menuitem+"'><input type='hidden' name='qty"+idbahan+"' value='"+qty+"'><a href='#' id='deletebahan' class='btn btn-xs btn-danger'>Delete</a></td></tr>";

                    $("#tablebahan tbody").append(newdata);
                } else {
                    swal({
                        title: 'Stok bahan kurang dari quantity!',
                        text: 'Silahkan input stok bahan terlebih dahulu! ',
                        type: 'warning',
                        timer: 2000,
                        showConfirmButton: false 
                    });
                }
            } else {
                swal({
                    title: 'Cek lagi form Anda!',
                    text: 'Pilih bahan dan masukkan quantity terlebih dahulu! ',
                    type: 'warning',
                    timer: 2000,
                    showConfirmButton: false 
                })
                .then((value) => {
                    location.reload();
                });
            }
        });

        $(document).on('click', '#deletebahan', function () {
            $(this).closest('tr').remove();
        });

        $("#menu_form").submit(function(e) {
            e.preventDefault();

            const items = {};
            $("#tablebahan > tbody > tr").each(function () {
                items[$(this).find('td').eq(3).find('input').val()] = $(this).find('td').eq(2).text();
            });

            const regData = new FormData(this);
            if(regData.get('name') != '' && regData.get('kode') != ''){
                console.log(items);
                // $.ajax({
                //     url: "{{ env('APP_URL') }}/stock",
                //     method: 'post',
                //     data: regData,
                //     cache: false,
                //     contentType: false,
                //     processData: false,
                //     dataType: 'json',
                //     success: function(response) {
                //         console.log(response);
                //         if(response.status == true){
                //             swal({
                //                 title: status+' Item Sukses!',
                //                 text: 'Stock Baru Berhasil Di '+status,
                //                 type: 'success',
                //                 timer: 2000,
                //                 showConfirmButton: false 
                //             })
                //             .then((value) => {
                //                 location.reload();
                //             });
                //         }
                //     }
                // });
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

            $('#menu_form')[0].reset(); 
            $("#tablebahan tbody").html('');
            
            $('#id').val('');
            $('#old_image').val('');

            $('.add-stock').show();
            $('.stock-edit').hide();
        });

        $(document).on("click",".edit-menu",function() {
            const menuId = $(this).data('id');
            status = 'Ubah';

            $('#menuModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/menu/"+menuId+"/edit",
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    data = JSON.parse(res);
                    if(data.use_item == 1) {
                        $('#useitem').prop('checked', true);
                        $('#tablemenu').show();
                        $('#stokmenu').hide();
                        $.ajax({
                            url: "{{ env('APP_URL') }}/menuitem/"+data.id+"/edit",
                            type: 'GET',
                            success: function(result) {
                                resultData = JSON.parse(result);
                                $("#tablebahan tbody").html('');
                                for(i=0; i< resultData.length; i++){
                                    var newdata =  "<tr><td>"+(i+1)+"</td><td>"+resultData[i].name+"</td><td>"+resultData[i].stock+"</td><td>"+resultData[i].qty+"</td><td><input type='hidden' name='bahan"+resultData[i].item_id+"' value='"+resultData[i].item_id+"'><input type='hidden' name='qty"+resultData[i].item_id+"' value='"+resultData[i].qty+"'><a href='#' id='deletebahan' class='btn btn-xs btn-danger'>Delete</a></td></tr>";
                                    // var newdata = "<tr><td>"+idbahan+"</td><td>"+selectedbahan+"</td><td>"+stock+"</td><td>"+qty+"</td><td><input type='hidden' name='bahan"+idbahan+"' value='"+menuitem+"'><input type='hidden' name='qty"+idbahan+"' value='"+qty+"'><a href='#' id='deletebahan' class='btn btn-xs btn-danger'>Delete</a></td></tr>";
                                    $("#tablebahan tbody").append(newdata);
                                }
                            },
                            error: function(response){
                                console.log(response);
                                swal({
                                    type: 'error',
                                    title: 'Edit Data Gagal!',
                                    text: 'Silahkan Coba Beberapa Saat Lagi',
                                    timer: 2000,
                                });
                            }
                        });
                    } else {
                        $('#useitem').prop('checked', false);
                        $('#tablemenu').hide();
                        $('#stokmenu').show();
                    }
                    $('#name').val(data.name);
                    $('#id').val(data.id);
                    $('#kode').val(data.code);
                    $('#kategori').val(data.category_id);
                    $('#harga').val(data.price);
                    $('#stok').val(data.stock);
                    $('#old_image').val(data.image);
                    $('#exdate').val(data.expired_date);
                    $('.img-preview').attr('src','{{ env('APP_URL') }}/assets/images/menu/'+data.image)
                }
            });
        });

        $('.delete-menu').on('click',function(){
            const menuId = $(this).data('id');
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
                        url: "{{ env('APP_URL') }}/menu/"+menuId,
                        success: function(data){
                            console.log(data);
                            var res = JSON.parse(data);
                            if(res.status == true){
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ env('APP_URL') }}/menuitem/"+menuId,
                                    success: function(res) {
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
                                    },
                                    error: function(response){
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
                                    }
                                });
                            }else{
                                swal({
                                    type: 'error',
                                    title: 'Hapus Data Gagal!',
                                    text: 'Silahkan Coba Beberapa Saat Lagi',
                                    timer: 2000,
                                });
                            }
                        },
                        error: function(response){
                            console.log(response);
                            swal({
                                type: 'error',
                                title: 'Hapus Data Gagal!',
                                text: 'Silahkan Coba Beberapa Saat Lagi',
                                timer: 2000,
                            });
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
