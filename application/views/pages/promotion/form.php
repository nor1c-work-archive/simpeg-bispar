<link rel="stylesheet" href="<?=base_url('public/css/profile-pict.css')?>">

<?php
	$mode  		= uriSegment(2); // modenya apa, request atau report
	$isReport 	= FALSE; // inisialisasi, secara default form ini ditujukan buat request

	switch ($mode) { // cek apakah request atau report
		case 'report':
				$isReport = TRUE; // berubah jadi TRUE karena $mode = report
				$formTitle = 'Form Report Verifikasi Data Request Kenaikan Pangkat Reguler';
			break;
		
		default: // else
				$formTitle = 'Formulir Pengajuan Kenaikan Pangkat Reguler';
			break;
	}

	$AUTOMATIC = array(); // array kosong

	if (!empty($automaticFill)) {
		foreach ($automaticFill[0] as $key => $value) {
			$AUTOMATIC[$key] = $value; // dipush ke array $AUTOMATIC, $AUTOMATIC['nip'] = 1902
		}
		// hasil akhir foreach : 
		// 	$AUTOMATIC = array('activityID' => '9' //actID ada kalau pas edit doang, 'nip' => '1902', 'nama' => 'Siapa', ...);
	}

	$isEdit = FALSE; // inisialiasi, secara default page ditujukan buat tambah
	if (uriSegment(4)) { // di cek apakah edit atau tambah, uri segment 4 ada atau kosong ('')
		$isEdit = TRUE; // kalo ada, masukkan idnya, activityID promotionnnya, $pk
	}

	// hasil jika edit
	// $isReport = TRUE;
	// $isEdit = TRUE;
	// array valuenya
?>

<div class="continer">
	<h5><?=$formTitle?></h5>

	<form action="<?=site_url(uriSegment(1).'/'.$mode.'/'.uriSegment(3))?>" method="post" enctype="multipart/form-data">
		<div id="userForm" >
			<input type="hidden" name="edit" value="<?=($isEdit ? $AUTOMATIC['activityID'] : '0');?>">

			<div class="form" style="width: 100%;">
				<!-- form pengaju -->
				
				<label for="" <?=$mode == 'request' ? 'style="display:none"' : ''; ?>> <!-- klo request ilangin, kalo report biarin/munculin -->
					<input type="checkbox" name="" id="shButton"> Tampilkan Formulir
				</label>

				<fieldset id="formFieldset" class="formulir">
					<legend>Formulir</legend>
					<fieldset id="formFieldset" style="margin-top:-0px;">
						<legend>Informasi Pegawai</legend>
						<table class="table table-borderless">
							<?php
								inputForm('NIP', 'nip', ($isEdit ? $AUTOMATIC['userRequestNIP'] : $AUTOMATIC), ' readonly ');
								inputForm('Nama Lengkap', 'nama', ($isEdit ? $AUTOMATIC['nama'] : $AUTOMATIC), ' readonly ');
								inputForm('Tanggal SK saat ini', 'tmt_sk_terakhir', ($isEdit ? date(dateFormat(), strtotime($AUTOMATIC['currentSK'])) : date(dateFormat(), strtotime($AUTOMATIC['tmt_sk_terakhir']))), ' readonly ', '', ' datepicker-here ');
								inputForm('Golongan saat ini', 'golongan', ($isEdit ? $AUTOMATIC['currentGolongan'] : $AUTOMATIC), ' readonly ');
							?>
						</table>
					</fieldset>

					<fieldset id="formFieldset">
						<legend>Informasi Dokumen & Jabatan Baru</legend>
						<table class="table table-borderless">
							<?php
								inputOption('<span style="color:red">*</span> Golongan Baru', 'promotionGolongan', $AUTOMATIC, ' required ', $golongan, 'golongan', 'golongan');
								inputForm('<span style="color:red">*</span> Tanggal SK Baru', 'promotionSK', (isset($AUTOMATIC['promotionSK']) ? $AUTOMATIC : date(dateFormat(), strtotime($AUTOMATIC['tmt_sk_terakhir'] . '+4 years'))), ' data-date-format="dd/mm/yyyy" ', '', ' datepicker-here ');
								// condition ? true : false;
							?>
							<tr>
								<td><span style="color:red">*</span> Dokumen Persyaratan</td>
								<td>
									<table class="table table-striped">
										<?php
											if (isset($documents)) {
												$no = 1;
												foreach ($documents as $key => $value) {
													if ($value['documentType'] != 'SK') { // cek dlu apakah dokumennya SK apa bukan, kalo bukan (buat 'required document') :
														echo '<tr>
															<td>'.$no.'</td>
															<td>
																<input type="text" name="documentName['.$no.']" class="form-control" style="width:400px" placeholder="Document Name" value="'.$value['documentName'].'">
															</td>
															<td style="width:100%;">
																<input type="file" class="documentPath" name="documentPath['.$no.']">
																<a style="float:right;font-size:10px;font-weight:bold;font-style:italic" href="'.base_url($documentPath.$value['documentPath']).'" target="blank">[ view uploaded documents ]</a>
															</td>
														</tr>';
													}
													$no++;
												}

												if (count($documents) != $numberOfDocuments) { // ini buat SK
													for ($i=count($documents)+1; $i <= $numberOfDocuments; $i++) {
														echo '<tr>
																<td>'.$i.'</td>
																<td>
																	<input type="text" name="documentName['.$i.']" class="form-control" style="width:400px" placeholder="Document Name">
																</td>
																<td style="width:100%;">
																	<input class="documentPath" type="file" name="documentPath['.$i.']">
																</td>
															</tr>';
													}
												}
											} else {
												for ($i=1; $i <= $numberOfDocuments; $i++) {
													echo '<tr>
															<td>'.$i.'</td>
															<td>
																<input type="text" name="documentName['.$i.']" class="form-control" style="width:400px" placeholder="Document Name">
															</td>
															<td style="width:100%;">
																<input class="documentPath" type="file" name="documentPath['.$i.']">
															</td>
														</tr>';
												}
											}
										?>
									</table>
								</td>
							</tr>
						</table>
					</fieldset>
				</fieldset>

				<!-- pick request -->
				<?php if ($isReport) { // hanya muncul pas report doang ?>
					<fieldset id="formFieldset">
						<legend>Admin</legend>
						<table class="table table-borderless">
							<tr>
								<td>Activity Code</td>
								<td>
									<input type="text" value="TPR-<?=sprintf('%03d', $AUTOMATIC['activityID'])?>" class="form-control" readonly>
								</td>
							</tr>
							<?php
								inputForm('NIP Admin Pemeriksa', 'adminReviewNIP', ($AUTOMATIC['adminReviewNIP'] ? $AUTOMATIC['adminReviewNIP'] : sessData('nip')), ' readonly ');
								inputForm('Nama Admin Pemeriksa', 'adminReviewName', ($AUTOMATIC['adminReviewName'] ? $AUTOMATIC['adminReviewName'] : sessData('nama')), ' readonly ');
								inputForm('Tanggal Mulai Pemeriksaan', 'startReviewTime', ($AUTOMATIC['startReviewTime'] ? date(dateFormat(), strtotime($AUTOMATIC['startReviewTime'])) : date(dateFormat(), time())), ' readonly ');
							?>
							<tr>
								<td>Status Pemeriksaan</td>
								<td>
									<select name="requestStatus" id="" class="form-control">
										<option value="" selected disabled>--Status Pemeriksaan--</option>
										<option value="Open">Open</option>
										<option value="Sedang Direview">Tahap Pemeriksaan Dokumen</option>
										<option value="Reject">Tolak/Revisi</option>
										<option value="Sedang Dikirim">Tahap Pengiriman ke DITJEN</option>
										<option value="Done">Done/Selesai</option>
									</select>
									<select name="approved" id="" class="form-control result" style="display:none;margin-top:10px">
										<option value="" selected disabled>--Keputusan Pemeriksaan--</option>
										<option value="Y">Approve</option>
										<option value="N">Reject</option>
									</select>
									<label class="newSK" style="margin-top:10px;">
										<?php
											if (isset($documents[env('PROMOTION_DOC')])) {
												echo '<a style="font-size:10px;font-weight:bold;font-style:italic" href="'.base_url($documentPath.$documents[env('PROMOTION_DOC')]['documentPath']).'" target="blank">[ view uploaded SK ]</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
											}
										?>
										SK Baru <input type="file" name="newSK[<?=env('PROMOTION_DOC')+1?>]">
									</label>
								</td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>
									<textarea name="mark" id="mark" cols="30" rows="10" class="form-control" placeholder="Dapat diisi dengan keterangan pemeriksaan maupun alasan penolakan/revisi dokumen"></textarea>
								</td>
							</tr>
						</table>
					</fieldset>
				<?php } ?>

				<fieldset id="formFieldset" class="noFieldset">
					<table class="table table-borderless">		
						<tr>
							<td class="tdLegend"></td>
							<td>
								<input id="submitButton" type="submit" class="btn btn-primary" value="Simpan">
								<a href="<?=site_url(uriSegment(1).'/'.uriSegment(2))?>" class="btn btn-danger">Batal</a>
							</td>
						</tr>
					</table>
				</fieldset>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {

		<?php if ($mode == 'report') { ?>
			$('.formulir').hide();
			$('.formulir :input').attr('readonly', true);
			$('.documentPath').css('display', 'none');
			$('.newSK').css('display', 'none');
			$('#shButton').change(function() {
				if ($(this).is(':checked')) {
					$('.formulir').show();
				} else {
					$('.formulir').hide();
				}
			});
			<?php if ($AUTOMATIC['adminReviewNIP'] != NULL) { ?>
				$('select[name=requestStatus] option[value="<?=$AUTOMATIC['requestStatus']?>"]').attr('selected', true);
				if ($('select[name=requestStatus]').val() == 'Done') {
					$('.result').css('display', 'block');
					$('.result option[value="<?=$AUTOMATIC['approved']?>"]').attr('selected', true);

					$('.finishDate').css('display', 'block');
					$('.finishData').val('<?=date(dateFormat(), strtotime($AUTOMATIC['finishReviewTime']))?>');
				} else {
					$('.result').css('display', 'none');
					$('.finishDate').css('display', 'none');
				}
					
				$('select[name=requestStatus]').change(function() {
					if ($(this).val() == 'Done') {
						$('.result').css('display', 'block');
						$('.finishDate').css('display', 'block');
					} else {
						$('.result').css('display', 'none');
						$('.finishDate').css('display', 'none');
						$('select[name=approved] option[value=""]').attr('selected', true);
						$('select[name=approved]').val('');
					}
				});

				<?php if ($AUTOMATIC['approved'] == 'Y') { ?>
					$('.newSK').css('display', 'block');
				<?php } else { ?>
					$('.newSK').css('display', 'none');
				<?php } ?>
				
				$('select[name=approved]').change(function() {
					if ($(this).val() == 'Y') {
						$('.newSK').css('display', 'block');
					} else {
						$('.newSK').css('display', 'none');
					}
				});
			<?php } else { ?>
				$('select[name=requestStatus]').change(function() {
					if ($(this).val() == 'Done') {
						$('.result').css('display', 'block');
						$('.finishDate').css('display', 'block');
					} else {
						$('.result').css('display', 'none');
						$('.finishDate').css('display', 'none');
					}
				});
				$('select[name=approved]').change(function() {
					if ($(this).val() == 'Y') {
						$('.newSK').css('display', 'block');
					} else {
						$('.newSK').css('display', 'none');
					}
				});
			<?php } ?>
			$('select[name=requestStatus] option[value="<?=$AUTOMATIC['requestStatus']?>"]').attr('selected', true);

			// $('#mark').val("<?=$AUTOMATIC['mark']?>");
		<?php } ?>

	});
</script>