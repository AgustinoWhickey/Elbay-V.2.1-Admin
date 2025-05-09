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
							<a href="/dashboard" class="nav-link {{ ($slug == 'admin_home' ? 'active' : '') }}">
								<i class="icon-home4"></i>
								<span>
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item nav-item-submenu {{ in_array($slug, ['kelola_stock', 'kelola_sales']) ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="icon-table2"></i> <span>Transaksi</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="/sales" class="nav-link {{ ($slug == 'kelola_sales' ? 'active' : '') }}">Sales</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-file-text"></i> <span>Laporan</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="/report/sales" class="nav-link">Sales</a>
								</li>
								<li class="nav-item">
									<a href="/stock" class="nav-link {{ ($slug == 'kelola_stock' ? 'active' : '') }}">Stocks</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu {{ in_array($slug, ['kelola_cabang', 'pengelola_cabang']) ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="icon-city"></i> <span>Cabang</span></a>

							<ul class="nav nav-group-sub" style="display: {{ in_array($slug, ['kelola_cabang', 'pengelola_cabang']) ? 'block' : 'none' }};" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="/branch" class="nav-link {{ ($slug == 'kelola_cabang' ? 'active' : '') }}">Kelola Cabang</a>
								</li>
								<li class="nav-item">
									<a href="/userbranch" class="nav-link {{ ($slug == 'pengelola_cabang' ? 'active' : '') }}">Pegawai Cabang</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu {{ in_array($slug, ['kelola_supplier', 'kelola_category', 'kelola_item', 'kelola_menu']) ? 'nav-item-open' : '' }}">
							<a href="#" class="nav-link"><i class="icon-cog"></i> <span>Setting</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="/supplier" class="nav-link {{ ($slug == 'kelola_supplier' ? 'active' : '') }}">Supplier</a>
								</li>
								<li class="nav-item nav-item-submenu {{ in_array($slug, ['kelola_category', 'kelola_item', 'kelola_menu']) ? 'nav-item-open' : '' }}">
									<a href="#" class="nav-link"> <span>Produk</span></a>
									<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
										<li class="nav-item">
											<a href="/category" class="nav-link {{ ($slug == 'kelola_category' ? 'active' : '') }}">Kategori</a>
										</li>
										<li class="nav-item">
											<a href="/item" class="nav-link {{ ($slug == 'kelola_item' ? 'active' : '') }}">Item</a>
										</li>
										<li class="nav-item">
											<a href="/menu" class="nav-link {{ ($slug == 'kelola_menu' ? 'active' : '') }}">Menu</a>
										</li>
									</ul>
								</li>
							</ul>
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