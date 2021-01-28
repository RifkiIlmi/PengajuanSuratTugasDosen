<div class="content">
	<div class="container-fluid">
		<!-- Page Heading -->
		<?php if ($akun['password'] === '12345') : ?>
			<div class="alert alert-warning alert-with-icon" data-notify="container">
				<i class="material-icons" data-notify="icon">notifications</i>
				<button type="button" aria-hidden="true" class="close">
					<i class="material-icons" data-dismiss="alert">close</i>
				</button>
				<span data-notify="message">Silahkah ganti password terlebih dahulu ======>>> <a href="<?= base_url('user_changePass') ?>"><b><i style="color:white;">change password</i></b></a></span>
			</div>
		<?php endif; ?>
		<?php if ($akun['id_user_type'] === '1') : ?>
			<h5 class="h5 mb-4 text-gray-800">Selamat Datang! you log in as Administrator</h5>
		<?php endif; ?>
		<?php if ($akun['id_user_type'] === '3') : ?>
			<h5 class="h5 mb-4 text-gray-800">Selamat Datang! you log in as Pimpinan</h5>
		<?php endif; ?>

		<!-- <?php
		foreach ($statusCount as $data) {
			// $status[] = ;
			$status[$data->status_surat] =  $data->total;
		}
		print_r($status["Pending"]);
		?>
		<p><?php echo json_encode($status); ?></p> -->
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats shadow">
					<div class="card-header" data-background-color="grey">
						<i class="material-icons">schedule</i>
					</div>
					<div class="card-content">
						<p class="category">Surat Pending</p>
						<h3 class="card-title"><?= $pending ?></h3>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card shadow card-stats">
					<div class="card-header" data-background-color="orange">
						<i class="material-icons">sync</i>
					</div>
					<div class="card-content">
						<p class="category">Surat Disposisi</p>
						<h3 class="card-title"><?= $disposisi ?></h3>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card shadow card-stats">
					<div class="card-header" data-background-color="blue">
						<i class="material-icons">done</i>
					</div>
					<div class="card-content">
						<p class="category">Surat Disetujui</p>
						<h3 class="card-title"><?= $disetujui ?></h3>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card shadow card-stats">
					<div class="card-header" data-background-color="green">
						<i class="material-icons">done_all</i>
					</div>
					<div class="card-content">
						<p class="category">Surat Selesai</p>
						<h3 class="card-title"><?= $selesai ?></h3>
					</div>

				</div>
			</div>
		</div>
		<!-- bar chart -->
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow">
					<div class="card-content">
						<canvas id="barChart"></canvas>
					</div>
				</div>
			</div>
		</div>
		<!-- pie chart and penjelasan  -->
		<div class="row">
			<div class="col-md-6">
				<div class="card shadow">
					<h3 class="text-center"><b>Persentase Surat Keluar Per-Fakultas</b></h3>
					<div class="card-content">
						<canvas id="pieChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card shadow">
					<div class="table-responsive table-sales">
						<table class="table">
							<thead>
								<th class="text-center"><b>Fakultas</b></th>
								<th class="text-center"><b>Jumlah</b></th>
								<th class="text-center"><b>Aksi</b></th>
							</thead>
							<tbody class="text-center">
								<tr>
									<td>Tarbiyah dan Keguruan</td>
									<td><?= $ftk ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailtarbiyah" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Ushuluddin</td>
									<td><?= $ush ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailushuluddin" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Psikologi</td>
									<td><?= $psi ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailpsikologi" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Ekonomi dan Ilmu Sosial</td>
									<td><?= $fekonsos ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailekonomi" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Syariah dan Ilmu Hukum</td>
									<td><?= $sih ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailsyariah" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Dakwah dan Ilmu Komunikasi</td>
									<td><?= $fdk ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detaildakwah" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Sains dan Teknologi</td>
									<td><?= $fst ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailsaintek" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Pertanian dan Peternakan</td>
									<td><?= $perta ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailpapertapet" title="detail">
											Lihat
										</a>
									</td>
								</tr>
								<tr>
									<td>Pascasarjana</td>
									<td><?= $pasca ?></td>
									<td>
										<a role="button" rel="tooltip" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailpasca" title="detail">
											Lihat
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- flow diagram  -->
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="card shadow">
					<img class="img-responsive" src="<?= base_url('assets/img/flow.jpg') ?>" alt="flowdiagram">
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</div>
</div>

<!-- Berikut Modal Tiap Fakultas -->
<!-- detail syariah-->
<div class="modal fade" id="detailsyariah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Ahwal Al-Syakhshiyyah</td>
								<td><?= $aas ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Ekonomi Islam</td>
								<td><?= $ei ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Ilmu Hukum</td>
								<td><?= $ih ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Jinayah Siyasah</td>
								<td><?= $js ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Muammalah</td>
								<td><?= $mmh ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Diploma III Perbankan Syariah</td>
								<td><?= $psd3 ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- end detail syariah -->

<!-- detail saintek-->
<div class="modal fade" id="detailsaintek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Teknik Informatika</td>
								<td><?= $tif ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Sistem Informasi</td>
								<td><?= $sif ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Teknik Elektro</td>
								<td><?= $te ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Matematika</td>
								<td><?= $mt ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Teknik Industri</td>
								<td><?= $ti ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail saintek -->

<!-- detail Dakwah-->
<div class="modal fade" id="detaildakwah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Bimbingan dan Konseling Islam</td>
								<td><?= $bki ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Ilmu Komunikasi</td>
								<td><?= $ilkom ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Manajemen Dakwah</td>
								<td><?= $md ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pengembangan Masyarakat Islam</td>
								<td><?= $pmi ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail dakwah -->

<!-- detail ekonomi-->
<div class="modal fade" id="detailekonomi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Administrasi Negara S1</td>
								<td><?= $admn ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Akuntansi S1</td>
								<td><?= $ak ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Diploma III Akuntansi</td>
								<td><?= $akd3 ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Diploma III Administrasi Perpajakan</td>
								<td><?= $apd3 ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Manajemen</td>
								<td><?= $mj ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Diploma III Manajemen Perusahaan</td>
								<td><?= $mpd3 ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail dakwah -->

<!-- detail papertapet-->
<div class="modal fade" id="detailpapertapet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Agroteknologi</td>
								<td><?= $agk ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Peternakan</td>
								<td><?= $ptk ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Gizi</td>
								<td><?= $gz ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail papertapet -->

<!-- detail psikologi-->
<div class="modal fade" id="detailpsikologi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">

				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Psikologi S1</td>
								<td><?= $s1psk ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Psikologi S2</td>
								<td><?= $s2psk ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail psikologi -->

<!-- detail tarbiyah-->
<div class="modal fade" id="detailtarbiyah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">

				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Manajemen Pendidikan Islam</td>
								<td><?= $mpi ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Agama Islam</td>
								<td><?= $pai ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Bahasa Arab</td>
								<td><?= $pba ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Bahasa Indonesia</td>
								<td><?= $pbhi ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Bahasa Inggris</td>
								<td><?= $pbi ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Ekonomi</td>
								<td><?= $pe ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Geografi</td>
								<td><?= $pg ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Guru Madrasah Ibtidaiyah</td>
								<td><?= $pgmi ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Kimia</td>
								<td><?= $pk ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Pendidikan Matematika</td>
								<td><?= $pmt ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Tadris Ipa</td>
								<td><?= $tipa ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- end detail tarbiyah -->

<!-- detail ushuluddin-->
<div class="modal fade" id="detailushuluddin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">

				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Aqidah dan Filsafat</td>
								<td><?= $af ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Ilmu Hadits</td>
								<td><?= $ihs ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Perbandingan Agama</td>
								<td><?= $pag ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Tafsir Hadits</td>
								<td><?= $th ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>
<!-- END detail ushuludidn -->

<!-- detail pascasajana-->
<div class="modal fade" id="detailpasca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notice">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
				<h5 class="modal-title" id="myModalLabel">.</h5>
			</div>
			<div class="modal-body">

				<div class="card">
					<div class="card-header card-header-icon" data-background-color="blue">
						<i class="material-icons">person</i>
					</div>
					<div class="card-content">
						<h4 class="card-title">Prodi</h4>
						<table class="table" id="dataTable">
							<tr>
								<td>Pasca Sarjana</td>
								<td><?= $pas ?></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer text-center">
				<button type="button" class="btn btn-info btn-round" data-dismiss="modal">Ok</button>
			</div>
		</div>
	</div>
</div>

<!-- persentase surat keluar yang sudah selesai-->
<?php
$ftkP    =  number_format(($ftk / $selesai) * 100, 1);
$ushP    =  number_format(($ush / $selesai) * 100, 1);
$psiP    =  number_format(($psi / $selesai) * 100, 1);
$fekonsosP    =  number_format(($fekonsos / $selesai) * 100, 1);
$sihP    =  number_format(($sih / $selesai) * 100, 1);
$fdkP    =  number_format(($fdk / $selesai) * 100, 1);
$fstP    =  number_format(($fst / $selesai) * 100, 1);
$pertaP    =  number_format(($perta / $selesai) * 100, 1);
$pascaP    =  number_format(($pasca / $selesai) * 100, 1);
?>

<!-- pie Chart -->
<script>
	// pieChart
	var ctx3 = document.getElementById("pieChart").getContext('2d');
	var pieChart = new Chart(ctx3, {
		type: 'pie',
		data: {
			datasets: [{
				data: ['<?= $ftkP; ?>', '<?= $ushP; ?>', '<?= $psiP; ?>', '<?= $fekonsosP; ?>', '<?= $sihP; ?>', '<?= $fdkP; ?>', '<?= $fstP; ?>', '<?= $pertaP; ?>', '<?= $pascaP; ?>'],
				backgroundColor: [
					'rgba(0, 153, 0, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 255, 128, 1)',
					'rgba(179, 89, 0, 1)',
					'rgba(230, 0, 230, 1)',
					'rgba(0, 0, 102, 1)',
					'rgba(255, 102, 0, 1)',
					'rgba(153, 255, 153, 1)',
					'rgba(153, 153, 102, 1)'
				],
				borderColor: [
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
					'rgba(255, 255, 255,1)',
				],
				label: 'Dataset 1'
			}],
			labels: [
				"Tarbiyah dan Keguruan",
				"Ushuluddin",
				"Psikologi",
				"Ekonomi dan Ilmu Sosial",
				"Syariah dan Ilmu Hukum",
				"Dakwah dan Ilmu Komunikasi",
				"Sains dan Teknologi",
				"Pertanian dan Peternakan",
				"Pascasarjana"
			]
		},
		options: {
			responsive: true
		}

	});
</script>

<!-- bar chart  -->
<script>
	var ctx = document.getElementById("barChart");
	var chartOptions = {
		legend: {
			display: false,
		},
		title: {
			display: true,
			text: 'Grafik Surat Keluar Tahun <?= $year ?>'
		},
		scales: {
			yAxes: [{
				ticks: {
					// max: 50,
					min: 0,
					beginAtZero: true,
					// stepSize: 1
				}
			}]
		} 
	};

	var data = {
		labels: <?= json_encode($label) ?>,
		datasets: [{
			// label: "Jumlah",
			data: <?= json_encode($jumlah) ?>,
			// lineTension: 1,
			// fill: false,
			borderColor: 'purple',
			// backgroundColor: 'transparent',
			borderDash: [5, 4],
			// y: 50,
			pointBorderColor: 'purple',
			pointBackgroundColor: 'rgba(204, 0, 204,0.5)',
			backgroundColor: 'rgba(204, 0, 204,0.5)',
			pointRadius: 5,
			pointHoverRadius: 10,
			pointHitRadius: 30,
			pointBorderWidth: 2,
			pointStyle: 'rectRounded'
		}]
	};

	var myChart = new Chart(ctx, {
		type: 'line',
		data: data,
		options: chartOptions
	});
</script>