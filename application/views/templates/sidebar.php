<!-- sidebar  -->
<aside id="sidebar" class="sidebar">
	<ul class="sidebar-nav" id="sidebar-nav">
		<li class="nav-heading mt-3">Menu</li>
		<!-- home -->
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin');  ?>"> <i class="fa-solid fa-table-columns"></i><span>Dashboard</span> </a>
		</li>
		<!-- artikel -->
		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
				<i class="fa-solid fa-square-poll-horizontal"></i><span>Artikel</span><i class="bi bi-chevron-right ms-auto"></i>
			</a>
			<ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
				<p class="nav-heading mt-2">Menu</p>
				<li>
					<a href="<?= base_url('artikel/create') ?>"> <span>Tambah Artikel</span> </a>
				</li>
				<li>
					<a href="<?= base_url('artikel') ?>"> <span>List Artikel</span> </a>
				</li>
				<!-- <li>
					<a href="<?= base_url('artikel/category') ?>"> <span>Kategori</span> </a>
				</li> -->
			</ul>
		</li>
		<!-- program -->
		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
				<i class="fa-solid fa-business-time"></i><span>Program</span><i class="bi bi-chevron-right ms-auto"></i>
			</a>
			<ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
				<p class="nav-heading mt-2">Menu</p>
				<li>
					<a href="<?= base_url('program/create') ?>"> <span>Tambah Program</span> </a>
				</li>
				<li>
					<a href="<?= base_url('program') ?>"> <span>List Program</span> </a>
				</li>
			</ul>
		</li>
		<li class="nav-heading mt-3">Setting</li>
		<!-- setting -->

		<!-- Setting -->
		<li class="nav-item">
			<a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
				<i class="fa-solid fa-square-poll-horizontal"></i><span>Setting</span><i class="bi bi-chevron-right ms-auto"></i>
			</a>
			<ul id="settings-nav" class="nav-setting collapse" data-bs-parent="#sidebar-nav">
				<p class="nav-heading mt-2">Menu</p>
				<li>
					<a href="<?= base_url('artikel/category') ?>"> <span>Kelola Kategori Artikel</span> </a>
				</li>
				<li>
					<a href="<?= base_url('program/program_type') ?>"> <span>Kelola Tipe Program</span> </a>
				</li>
				<li>
					<a href="<?= base_url('program/path') ?>"> <span>Kelola Jalur Program</span> </a>
				</li>
				<li>
					<a href="<?= base_url('program/benefit') ?>"> <span>Kelola Manfaat Program</span> </a>
				</li>
			</ul>
		</li>

		<!-- logout -->
		<li class="nav-heading mt-3">Akun</li>
		<!-- home -->
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('auth/logout'); ?>"> <i class="fa-solid fa-right-from-bracket text-danger"></i><span class="text-danger">Logout</span> </a>
		</li>
	</ul>
</aside>
<!-- end sidebar -->
