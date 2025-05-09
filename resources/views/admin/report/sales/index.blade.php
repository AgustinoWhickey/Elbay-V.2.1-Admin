@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Laporan Penjualan</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-2">
                    <span>Pilih tanggal</span>
                    <div class="input-group" >
                        <input type="text" class="form-control datepicker datepicker_from pickdate">
                    </div>
                </div>
                <div class="col-md-2">
                    <span>Sampai tanggal</span>
                    <div class="input-group" >
                        <input type="text" class="form-control datepicker datepicker_to pickdate">
                    </div>
                </div>
                <div class="col-md-2">
                    <button id="datesearch" style="margin-top:22px;" class="btn btn-xs btn-success">
                        Cari
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="content">
                <div class="card">
					<table class="table table-report display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Pembayaran</th>
                                <th>Note</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
						<tbody>
                            @foreach ($sales as $index => $sale)
                                <tr>
                                    <td>{{ ($index+1) }}</td>
                                    <td id="saleinvoice">{{ $sale->invoice }}</td>
                                    <td id="saledate">{{ Date("m/d/Y", $sale->date) }}</td>
                                    <td id="saleprice">{{ indo_currency($sale->total_price) }}</td>
                                    <td id="salediscount">{{ indo_currency($sale->discount) }}</td>
                                    <td id="salecash">{{ indo_currency($sale->cash) }}</td>
                                    <td id="salenote">{{ $sale->note }}</td>
                                    <td style="width: 15%;">
                                        <button type="button" class="btn btn-xs btn-info detail-report" data-id="<?= $sale->id ?>" data-username="<?= $sale->user_name ?>" data-email="<?= $sale->email ?>">Detail</button>
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

<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="menuModalLabel">Sales</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
            <div class="modal-body">
                <form action="#">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h5 class="card-title">Detail Sales</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3"><b>Invoice</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsaleinvoice"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Sales Date</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsaledate"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Total</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsaletotal"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Discount</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsalediscount"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Payment</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsalepayment"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h5 class="card-title">PIC</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3"><b>Name</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="picname"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Email</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="picemail"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Note</b></div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-8" id="detailsalenotes"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <table id="tableDetailSales" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right"></th>
                                        <th class="text-right"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
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

        var reportDatatabel = $('.table-report').DataTable( {
            lengthChange: false,
            columnDefs: [{ width: '5%', targets: 0 }]
        });

        $(document).on("change",".datepicker_from",function() {
            minDateFilter = new Date(this.value).getTime();
            reportDatatabel.draw();
        });
        $(document).on("change",".datepicker_to",function() {
            maxDateFilter = new Date(this.value).getTime();
            reportDatatabel.draw();
        });

        minDateFilter = "";
        maxDateFilter = "";

        $.fn.dataTable.ext.search.push(
            function(oSettings, aData, iDataIndex) {
            if (typeof aData._date == 'undefined') {
                aData._date = new Date(aData[2]).getTime();
            }

            if (minDateFilter && !isNaN(minDateFilter)) {
                if (aData._date < minDateFilter) {
                    return false;
                }
            }

            if (maxDateFilter && !isNaN(maxDateFilter)) {
                if (aData._date > maxDateFilter) {
                    return false;
                }
            }

            return true;
        });

        $(document).on("click",".detail-report",function() {
            const saleId = $(this).data('id');
            const saleInvoice = $(this).parent().parent().find('#saleinvoice').text();
            const saleDate = $(this).parent().parent().find('#saledate').text();
            const saleTotal = $(this).parent().parent().find('#saleprice').text();
            const saleDiscount = $(this).parent().parent().find('#salediscount').text();
            const salePayment = $(this).parent().parent().find('#salecash').text();
            const saleNote = $(this).parent().parent().find('#salenote').text();

            const picUsername = $(this).data('username');
            const picEmail = $(this).data('email');

            $('#reportModal').modal('show');
            $.ajax({
                url: "{{ env('APP_URL') }}/report/sales/"+saleId+"/edit",
                type: 'GET',
                success: function(res) {
                    resultData = JSON.parse(res);
                    console.log(resultData);
                    $('#picname').text(picUsername);
                    $('#piemail').text(picEmail);

                    $('#detailsaleinvoice').text(saleInvoice);
                    $('#detailsaledate').text(saleDate);
                    $('#detailsaletotal').text(saleTotal);
                    $('#detailsalediscount').text(saleDiscount);
                    $('#detailsalepayment').text(salePayment);
                    $('#detailsalenotes').text(saleNote);

                    for(i=0; i< resultData.length; i++){
                        var newdata =  "<tr><td>"+(i+1)+"</td><td>"+resultData[i].name+"</td><td>"+resultData[i].price+"</td><td>"+resultData[i].qty+"</td><td>"+resultData[i].total+"</td></tr>";
                        $("#tableDetailSales tbody").append(newdata);
                    }
                }
            });
        });
    });
</script>
@endsection
