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
								<a href="#"><img src="{{ asset('global_assets/images/placeholders/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">Admin Pajak</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;Waisai
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
							<a href="#" class="nav-link"><i class="icon-stack"></i> <span>PBB</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Persiapan</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="/admin/pbb-persiapan-tabel-blok" class="nav-link {{ ($slug == 'pbb_persiapan_blok' ? 'active' : '') }}">Tabel Blok</a></li>
										<li class="nav-item"><a href="/admin/pbb-perubahan-nir" class="nav-link">Perubahan NIR</a></li>
										<li class="nav-item"><a href="/admin/pbb-peta-znt" class="nav-link">Peta ZNT</a></li>
										<li class="nav-item"><a href="/admin/pbb-znt-massal" class="nav-link">ZNT Massal</a></li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Pendataan</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="/admin/pbb-pendataan-spop" class="nav-link {{ ($slug == 'pbb_pendataan_spop' ? 'active' : '') }}">Laporan SPOP</a></li>
										<li class="nav-item"><a href="/admin/pbb-perubahan-data-objek" class="nav-link">Perubahan Data Objek</a></li>
										<li class="nav-item"><a href="/admin/pbb-perubahan-nop" class="nav-link">Perubahan NOP</a></li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Penilaian</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="/admin/pbb-penilaian-individu" class="nav-link">Penilaian Individu</a></li>
										<li class="nav-item"><a href="/admin/pbb-penilaian-massal" class="nav-link">Penilaian Massal</a></li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Penetapan</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="/admin/pbb-penetapan-sppt" class="nav-link">Daftar SPPT</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Minimal PBB</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Tarif PBB</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Penetapan Terseleksi</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Penetapan Massal</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Daftar NJOP</a></li>
										<li class="nav-item"><a href="../seed/sidebar_content_right.html" class="nav-link">Daftar NIR</a></li>
									</ul>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Pembayaran</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="../seed/sidebar_right_hidden.html" class="nav-link">Laporan Pembayaran</a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-table2"></i> <span>BPHTB</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="#" class="nav-link">Validasi</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Pembayaran</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">Master</a>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-gear"></i> <span>Retribusi </span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
								<li class="nav-item">
									<a href="/admin/retribusi-wisata" class="nav-link">Wisata</a>
								</li>
								<li class="nav-item nav-item-submenu">
									<a href="#" class="nav-link">Rumah Sakit</a>
									<ul class="nav nav-group-sub">
										<li class="nav-item"><a href="/admin/retribusi-rumah-sakit" class="nav-link">Daftar Rumah Sakit</a></li>
										<li class="nav-item"><a href="/admin/user-rumah-sakit" class="nav-link">Daftar User Rumah Sakit</a></li>
									</ul>
								</li>
							</ul>
						</li>

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div