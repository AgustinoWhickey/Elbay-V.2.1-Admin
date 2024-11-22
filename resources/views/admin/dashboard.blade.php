@extends('layouts.admin.dashboard')

@section('container')
<!-- Main content -->
<div class="content-wrapper">

    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>
    </div>

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body py-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3">
                                    <i class="icon-plus3"></i>
                                </a>
                                <div>
                                    <div class="font-weight-semibold">Total Penjualan: </div>
                                    <span class="text-muted">Rp 26.989.758.083</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="new-visitors"></div>
                        </div>

                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="btn bg-transparent border-warning-400 text-warning-400 rounded-round border-2 btn-icon mr-3">
                                    <i class="icon-watch2"></i>
                                </a>
                                <div>
                                    <div class="font-weight-semibold">Total Pengeluaran: </div>
                                    <span class="text-muted">Rp 23.989.758.083</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="new-sessions"></div>
                        </div>

                        <div class="col-sm-4">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon mr-3">
                                    <i class="icon-people"></i>
                                </a>
                                <div>
                                    <div class="font-weight-semibold">Total Keuntungan: </div>
                                    <span class="text-muted">Rp 24.989.758.083</span>
                                </div>
                            </div>
                            <div class="w-75 mx-auto mb-3" id="total-online"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="row">
            <div class="col-xl-3 col-md-3 mb-4">
                <div class="py-2 bg-warning rounded">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h2 font-weight-bold text-uppercase mb-1">100</div>
                        <div class="h5 mb-0 font-weight-bold">Customer</div>
                        </div>
                        <div class="col-auto">
                        <i class="fa fa-user fa-4x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-3 mb-4">
                <div class="py-2 bg-primary rounded">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h2 font-weight-bold text-uppercase mb-1">90</div>
                        <div class="h5 mb-0 font-weight-bold">Supplier</div>
                        </div>
                        <div class="col-auto">
                        <i class="fa fa-truck fa-4x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="py-2 bg-success rounded">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h2 font-weight-bold text-uppercase mb-1">89</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold">Purchase Invoice </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fa fa-clipboard fa-4x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-3 mb-4">
                <div class="py-2 bg-dark rounded">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h2 font-weight-bold text-uppercase mb-1">89</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold">Sales Invoice </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fa fa-files-o fa-4x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            </div>

        </div>

        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-8 col-md-8">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h5 class="card-title">Purchase & Sales</h5>
                            <div class="header-elements">
                                <div class="list-icons">
                                    <a class="list-icons-item" data-action="collapse"></a>
                                    <a class="list-icons-item" data-action="reload"></a>
                                    <a class="list-icons-item" data-action="remove"></a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="columns_basic"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <!-- Daily sales -->
						<div class="card">
							<div class="card-header">
                                <h5>Produk Baru</h5>
                            </div>

							<div class="table-responsive">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th class="w-100">Nama Produk</th>
											<th>Kategori</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="#" class="text-default font-weight-semibold letter-icon-title">Chicken Creamy</a>
														<div class="text-muted font-size-sm"><i class="icon-checkmark3 font-size-sm mr-1"></i> Steak</div>
													</div>
												</div>
											</td>
											<td>
												<span class="text-muted font-size-sm">Food</span>
											</td>
											<td>
												<h6 class="font-weight-semibold mb-0">Rp 90.000</h6>
											</td>
										</tr>

										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-danger-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="#" class="text-default font-weight-semibold letter-icon-title">Banana Toast</a>
														<div class="text-muted font-size-sm"><i class="icon-spinner11 font-size-sm mr-1"></i> Sweets</div>
													</div>
												</div>
											</td>
											<td>
												<span class="text-muted font-size-sm">Snack</span>
											</td>
											<td>
												<h6 class="font-weight-semibold mb-0">Rp 30.000</h6>
											</td>
										</tr>

										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-indigo-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="#" class="text-default font-weight-semibold letter-icon-title">Caramel Machiato</a>
														<div class="text-muted font-size-sm"><i class="icon-lifebuoy font-size-sm mr-1"></i> Coffee</div>
													</div>
												</div>
											</td>
											<td>
												<span class="text-muted font-size-sm">Drink</span>
											</td>
											<td>
												<h6 class="font-weight-semibold mb-0">Rp 24.000</h6>
											</td>
										</tr>

										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-success-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="#" class="text-default font-weight-semibold letter-icon-title">Sop Buntut</a>
														<div class="text-muted font-size-sm"><i class="icon-lifebuoy font-size-sm mr-1"></i> Indonesian Food</div>
													</div>
												</div>
											</td>
											<td>
												<span class="text-muted font-size-sm">Food</span>
											</td>
											<td>
												<h6 class="font-weight-semibold mb-0">Rp 90.000</h6>
											</td>
										</tr>

										<tr>
											<td>
												<div class="d-flex align-items-center">
													<div class="mr-3">
														<a href="#" class="btn bg-danger-400 rounded-round btn-icon btn-sm">
															<span class="letter-icon"></span>
														</a>
													</div>
													<div>
														<a href="#" class="text-default font-weight-semibold letter-icon-title">Orange Juice</a>
														<div class="text-muted font-size-sm"><i class="icon-spinner11 font-size-sm mr-2"></i> Juice</div>
													</div>
												</div>
											</td>
											<td>
												<span class="text-muted font-size-sm">Drink</span>
											</td>
											<td>
												<h6 class="font-weight-semibold mb-0">Rp 20.000</h6>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                </div>
            </div>
        </div>
    </div>


    <!-- Dashboard content -->
    <div class="row">
        <div class="col-xl-12">


            <div class="row">
                <div class="content">
                <div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Kadaluarsa Produk</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<table class="table datatable-basic">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Kategori</th>
								<th>Tanggal Kadaluarsa</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>F01-Orange-Juice</td>
								<td>Orange Juice</td>
								<td>Juice</td>
								<td>22 Oktober 2024</td>
							</tr>
							<tr>
								<td>2</td>
								<td>B02-Banana-Toast</td>
								<td>Banana Toast</td>
								<td>Sweets</td>
								<td>3 November 2024</td>
							</tr>
                            <tr>
								<td>3</td>
								<td>A01-Tongseng-Sapi</td>
								<td>Tongseng Sapi</td>
								<td>Indonesian Foods</td>
								<td>3 November 2024</td>
							</tr>
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
<!-- /content area -->


<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; 2024. <a href="#">Elbay Corp</a> by <a href="https://elbay.id/" target="_blank">Elbay.id</a>
        </span>

    </div>
</div>
<!-- /footer -->

</div>
<!-- /main content -->
@endsection
