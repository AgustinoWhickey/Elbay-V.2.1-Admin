<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="{{ asset('assets/images/company/'.Session::get('data')['logo']) }}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">{{ Session::get('data')['company_name'] }}</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;{{ Session::get('data')['address'] }}
								</div>
							</div>

							<!-- <div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div> -->
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
						<li class="nav-item">
							<a href="/admin/dashboard" class="nav-link {{ ($slug == 'admin_home' ? 'active' : '') }}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-stack"></i> <span>Produk</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="#" class="nav-link">Kategori</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Menu</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Item</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-table2"></i> <span>Transaksi</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="#" class="nav-link">Sales</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Stock In</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-file-text"></i> <span>Laporan</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="#" class="nav-link">Sales</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Stocks</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-city
							"></i> <span>Cabang</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="#" class="nav-link">Kelola Cabang</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Pegawai Cabang</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="/admin/dashboard" class="nav-link {{ ($slug == 'admin_home' ? 'active' : '') }}">
								<i class="icon-truck"></i>
								<span>
									Supplier
								</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="/admin/dashboard" class="nav-link {{ ($slug == 'admin_home' ? 'active' : '') }}">
								<i class="icon-user"></i>
								<span>
									User
								</span>
							</a>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div