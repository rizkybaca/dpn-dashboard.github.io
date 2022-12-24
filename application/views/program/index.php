<main id="main" class="main">
	<div class="pagetitle">
		<h1 class="judul"><?= $title ?></h1>
		<p class="keterangan-judul">Anda dapat mengedit dan menghapus Program yang telah di post pada halaman Tambah Program</p>
	</div>

	<section class="section dashboard mt-4">
		<div class="card-artikel col-sm-11">
			<div class="card">
				<div class="card-header font-weight-bold text-gray-100" style="background-color: #eeeef0">List Program</div>

				<div class="row mt-2">
					<div class="col-md-12 text-center">
						<div class="table-responsive m-4">
							<table class="table table-bordered">
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Program</th>
									<th class="text-center">Lokasi Program</th>
									<th class="text-center">Gambar</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Hapus</th>
									<th class="text-center">Lihat</th>
								</tr>
								<?php $i = 1;
								foreach ($program as $p) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $p['title'] ?></td>
										<td><?= $p['location'] ?></td>
										<td>
											<img src="<?= base_url('assets/img/program/') . $p['image']; ?>" alt="banner" style="width:128px;height:128px;object-fit: cover;">

										</td>
										<td>
											<center>
												<a class="mb-2 mt-2 btn btn-sm" style="background-color: #242790; color: white" href="#"> Edit </a>
											</center>
										</td>
										<td>
											<center>
												<a onclick="return confirm('Yakin Hapus?')" class="mb-2 mt-2 btn btn-sm btn-danger" href="#"> Hapus </a>
											</center>
										</td>
										<td>
											<center>
												<a class="mb-2 mt-2 btn btn-sm btn-success" href="#"> Lihat </a>
											</center>
										</td>
									</tr>
								<?php endforeach; ?>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>