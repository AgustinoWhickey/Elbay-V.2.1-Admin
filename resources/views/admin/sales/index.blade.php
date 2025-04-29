@extends('layouts.admin.main')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Sales Transaction</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-8">
            <div class="form-group">
                <label>Pilih Kategori</label>
                <select class="form-control select-search" data-fouc>
                    <?php foreach($categories as $category){ ?>
                        <option value="{{$category->id }}">{{ $category->name}}</option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-2">
                <div class="container" style="overflow-y: scroll;height:500px;">
                    <div id="prod-content" class="row col-lg-12 px-0">
                    <?php foreach($items as $item){ ?>
                        <div class="mb-2 col-lg-2 px-1 py-1">
                            <a href="#" id="item" stock="<?= $item->stock; ?>" iditem="<?= $item->id; ?>" product="<?= $item->name; ?>" price="<?= $item->price; ?>">
                            <div class="card">
                                <?php if($item->image != '') { ?>
                                    <img class="card-img-top rounded-circle p-2" src="{{ asset('assets/images/menu/'.$item->image) }}" style="height: 120px;" />
                                <?php } else { ?>
                                    <img class="card-img-top rounded-circle p-2" src="{{ asset('assets/images/menu/default.jpg') }}" style="height: 120px;" />
                                <?php } ?>
                                <hr class="m-0">
                                <div class="card-body p-2">
                                    <div class="text-center row">
                                        <div class="col-md-12">
                                            <b><h5 class="fw-bolder"><?= $item->name; ?></h5></b>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center justify-content-center text-left px-0">
                                            <b><?= indo_currency($item->price); ?></b>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <div class="btn bg-transparent rounded-round border-2 btn-icon" style="cursor: pointer; padding: 1px 5px;">
                                                <i class="icon-plus3" style="font-size:8px"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card mt-2">
              <div class="card-header border-0">
                <h3 class="card-title">Orders</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                    <th class="text-left">Item</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Hapus</th>
                  </tr>
                  </thead>
                </table>
                <table id="cart_table" class="table table-striped table-valign-middle detail-order">
                  <tbody>
                  </tbody>
                  <tfoot class="table-active">
                    <tr>
                      <td colspan="2">Total</td>
                      <td id="grand_total"></td>
                      <td></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="card-footer clearfix">
                <button type="button" class="btn btn-info float-right" id="proses" data-toggle="modal" data-target="#detailOrderModal"> Proses</button>
              </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="detailOrderModal" tabindex="-1" role="dialog" aria-labelledby="detailOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailOrderModalLabel">Detail Pesanan</h5>
                </div>
                <div class="modal-body">
                    <b><h2 class="detail_total">Total: Rp 0</h2></b>
                    <input type="hidden" id="inputtotal">
                    <div class="row">
                        <div class="form-group col-lg-6 row">
                            <label class="col-form-label col-lg-3 mx-2">Cash: </label>
                            <input type="text" class="form-control col-lg-8" id="cash" name="cash" value="0">
                        </div>
                        <div class="form-group col-lg-6 row">
                            <label class="col-form-label col-lg-3 mx-2">Discount: </label>
                            <input type="text" class="form-control col-lg-8" id="diskon" name="diskon" value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 row">
                            <label class="col-form-label col-lg-2 mx-2">Kembalian: </label>
                            <input type="text" class="form-control col-lg-9" id="change" name="change" disable>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 row">
                            <label class="col-form-label col-lg-2 mx-2">Catatan: </label>
                            <textarea class="form-control col-lg-9" id="note" name="note"></textarea>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="process_payment">Tambah</button>
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

        $(document).on('click', '.row #item', function() {
            $('.order').show();
            
            var product = $(this).attr('product');
            var price = $(this).attr('price');
            var stock = $(this).attr('stock');
            var iditem = $(this).attr('iditem');
            if(stock > 0){
                $("#cart_table").each(function() {
                    if($(this).find('td input').length){
                        $(this).find("td input").each(function() {
                            if($(this).attr('iditem') == iditem) {
                                $(this).val(parseInt($(this).val())+1);
                                $('#cart_table #cart_qty').trigger("change");
                                return false;
                            } else {
                                $('.detail-order tbody').after('<tr><td>'+product+'</td><td><input id="cart_qty" iditem="'+iditem+'" product="'+product+'" stock="'+stock+'" price="'+price+'" type="number" value="1" style="width:65px"></td><td id="total" data-total='+price+'>'+rupiah(price)+'</td><td><button id="del_cart" type="button" class="btn btn-danger float-right"><i class="icon-trash"></i></button></td></tr>');
                                return false;
                            }
                            return false;
                        });
                    } else {
                        $('.detail-order tbody').after('<tr><td>'+product+'</td><td><input id="cart_qty" iditem="'+iditem+'" product="'+product+'" stock="'+stock+'" price="'+price+'" type="number" value="1" style="width:65px"></td><td id="total" data-total='+price+'>'+rupiah(price)+'</td><td><button id="del_cart" type="button" class="btn btn-danger float-right"><i class="icon-trash"></i></button></td></tr>');
                    }
                });

                calculate();
            } else {
                swal({
                    type: 'warning',
                    title: 'Stock untuk '+product+' ini sudah habis',
                    text: 'Silahkan input stock terlebih dahulu',
                    timer: 2000,
                    showConfirmButton: false 
                });
            }
        });

        const rupiah = (number)=>{
            return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            maximumFractionDigits: 0
            }).format(number);
        }

        function calculate(){
            var subtotal = 0;
            var qtycart = 0;
            $('#cart_table tr').each(function() {
                if($(this).find('#total').data('total') != undefined){
                    subtotal += parseInt($(this).find('#total').data('total'));
                }
            });
            isNaN(subtotal) ? $('#grand_total').text(0) : $('#grand_total').text(rupiah(subtotal));
            $('#inputtotal').val(subtotal);
        }

        $("#proses").click(function(event){
            var total = $('#grand_total').text();

            $('#cash').val('');
            $('#diskon').val('');
            $('#change').val('');

            $('.detail_total').text('Total: '+total);
        }); 

        $(document).on('keyup', '#cash', function() {
            var total = $('#inputtotal').val();
            var diskon = $('#diskon').val();
            var cash = $(this).val();
            var kembalian = (cash - (total - diskon));
            $('#change').val(kembalian);
        });

        $(document).on('keyup', '#diskon', function() {
            var total = $('#inputtotal').val();
            var diskon = $(this).val();
            var cash = $('#cash').val();
            var kembalian = (cash - (total - diskon));
            $('#change').val(kembalian);
        });

        $('.select-search').on('change', function() {
            var idcat = this.value;
            $.ajax({
                url: "{{ env('APP_URL') }}/item/category",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idcat: idcat,
                },
                success: function(data){
                    console.log(data);
                    $('#prod-content').html(data);
                }, error: function(data) {
                    console.log(data);
                }
            });
        });

        $(document).on('click', '#del_cart', function() {
            $(this).closest('tr').remove();
            calculate();
        });

        $(document).on('change', '#cart_table #cart_qty', function() {
            var qty = parseInt($(this).val());
            var price = parseInt($(this).attr('price'));
            var stock = parseInt($(this).attr('stock'));
            var product = $(this).attr('product');
            var newtotal = parseInt(qty) * parseInt(price);
            if(qty > stock){
                swal({
                    type: 'warning',
                    title: 'Stock '+product+' kurang dari jumlah pesanan',
                    text: 'Silahkan input sesuai stock',
                    timer: 2000,
                    showConfirmButton: false 
                });
                $(this).val(1);
            }
            $(this).parent().parent().find('#total').text(rupiah(newtotal));
            $(this).parent().parent().find('#total').data('total', newtotal);
            calculate();
        });

        $(document).on('click', '#process_payment', function(){
            var discount = $('#diskon').val();
            var grandtotal = $('#inputtotal').val();
            var cash = $('#cash').val();
            var change = $('#change').val();
            var note = $('#note').val();

            var cartStatus = false;
            var cartIndex = $('#cart_table tr').length;
            var indeks = 0;

            $('#cart_table tr').each(function(index) {
                if($(this).find('#cart_qty').attr('product') != undefined){
                    var iditem = $(this).find('#cart_qty').attr('iditem');
                    var price = $(this).find('#cart_qty').attr('price');
                    var qty = $(this).find('#cart_qty').val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ env('APP_URL') }}/cart',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            item_id: iditem,
                            price: price,
                            qty: qty
                        },
                        success: function(data){
                            var res = JSON.parse(data);
                            if(res.status == true){
                                if(cash < 1){
                                    swal({
                                        type: 'warning',
                                        title: 'Jumlah uang cash belum diinput!',
                                        text: 'Silahkan input uang cash',
                                        timer: 2000,
                                    });
                                } else {
                                    indeks = index;
                                    if((indeks + 1) == (cartIndex - 1)) {
                                        swal({
                                            type: 'warning',
                                            title: 'Anda yakin ingin memproses transaksi ini?',
                                            text: 'Jika sudah diproses, transaksi tidak akan bisa dikembalikan',
                                            buttons: true,
                                            dangerMode: true,
                                        }).then((willProcess)=>{
                                            if(willProcess){
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '{{ env('APP_URL') }}/sales',
                                                    data: {
                                                        "_token": "{{ csrf_token() }}",
                                                        discount: discount,
                                                        grandtotal: grandtotal,
                                                        cash: cash,
                                                        change: change,
                                                        note: note
                                                    },
                                                    success: function(result){
                                                        var res = JSON.parse(result);
                                                        if(res.status == true){
                                                            $.ajax({
                                                                url: '{{ env('APP_URL') }}/sales/processpayment',
                                                                type: 'POST',
                                                                data: {
                                                                    "_token": "{{ csrf_token() }}",
                                                                    saleid: res.data,
                                                                },
                                                                success: function(data){
                                                                    swal({
                                                                        type: 'success',
                                                                        title: 'Transaksi Berhasil!',
                                                                        text: 'Transaksi Telah Diproses',
                                                                        timer: 2000,
                                                                        showConfirmButton: false 
                                                                    })
                                                                    .then((value) => {
                                                                        window.open('{{ env('APP_URL') }}/sales/print/' + res.data, '_blank');
                                                                    });
                                                                }, error: function(data) {
                                                                    console.log(data);
                                                                }
                                                            });
                                                        } else {
                                                            swal({
                                                                type: 'error',
                                                                title: 'Transaksi gagal!',
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
                                                });
                                            }
                                        });
                                    }
                                }
                            }else {
                                swal({
                                    type: 'error',
                                    title: 'Tambah cart gagal!',
                                    text: 'Silahkan Coba Beberapa Saat Lagi',
                                    timer: 2000,
                                });
                            }
                        }, error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
