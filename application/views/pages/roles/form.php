<link rel="stylesheet" href="<?=base_url('public/css/profile-pict.css')?>">

<?php
	$mode  		= uriSegment(2);
	$isReport 	= FALSE;

	$AUTOMATIC = array();
	if (!empty($data)) {
		foreach ($data[0] as $key => $value) {
			$AUTOMATIC[$key] = $value;
		}
	}

	$isEdit = FALSE;
	if (uriSegment(3)) {
		$isEdit = TRUE;
	}
?>

<div class="continer">
	<h5>Role Management</h5>

	<form action="<?=site_url(uriSegment(1).'/'.$mode.'/'.uriSegment(3))?>" method="post" enctype="multipart/form-data">
		<div id="userForm" >
			<input type="hidden" name="edit" value="<?=($isEdit ? $AUTOMATIC['roleID'] : '0');?>">

			<div class="form" style="width: 100%;">
				<fieldset id="formFieldset" class="formulir">
					<legend>Role Access Selection</legend>
					<table class="table table-borderless">
						<?php
							inputForm('Role Name', 'roleName', ($isEdit ? $AUTOMATIC['roleName'] : $AUTOMATIC), '');
						?>
						
						<?php

							$menuList = array(
								'Data Kepegawaian' => array('Enable Menu' => 'employee', 'Add' => 'employee/add', 'Edit' => 'employee/edit', 'Delete' => 'employee/delete', 'Detail' => 'employee/detail', 'Rekap' => 'employee/rekap', 'Update Posisi' => 'update_position'),
								'Kenaikan Pangkat Reguler' => array(
									'Permohonan' => array('Enable Menu' => 'promotion/request', 'Add' => 'promotion/request/add', 'Edit' => 'promotion/request/edit', 'Delete' => 'promotion/request/delete', 'Detail' => 'promotion/detail', 'Review' => 'promotion/request/review'),
									'Laporan' => array('Enable Menu' => 'promotion/report', 'Update' => 'promotion/report/edit', 'Delete' => 'promotion/report/delete', 'Detail' => 'promotion/detail'),
								),
								'Retirement' => array(
									'Permohonan' => array('Enable Menu' => 'retirement/request', 'Add' => 'retirement/request/add', 'Edit' => 'retirement/request/edit', 'Delete' => 'retirement/request/delete', 'Detail' => 'retirement/detail', 'Review' => 'retirement/request/review'),
									'Laporan' => array('Enable Menu' => 'retirement/report', 'Update' => 'retirement/report/edit', 'Delete' => 'retirement/report/delete', 'Detail' => 'retirement/detail'),
								),
								'Notifikasi' => array('Enable Menu' => 'notification', 'Show All Notification (for Administrator)' => 'show_all_notification'),
								'Master Golongan' => array('Enable Menu' => 'golongan'),
								'Role Management' => array('Enable Menu' => 'roles', 'Add' => 'roles/add', 'Edit' => 'roles/edit', 'Delete' => 'roles/delete'),
							);
						
						?>

						<?php 
							foreach ($menuList as $key1 => $value1) {
								echo '<tr><td><b>'.$key1.'</b></td>';
								foreach ($value1 as $key => $value) {
									if (!is_array($value)) {
											$isSelected = (!empty($accesses) && in_array($value, $accesses) ? 'checked' : '');
											echo '<td style="width:'.(in_array($value, array('show_all_notification', 'update_position')) ? '300px' : '150px').' !important;float:left;"><label><input type="checkbox" style="margin-right:5px;" name="access[]" value="'.$value.'" '.$isSelected.'>'.$key.'</label></td>';
									} else {
										echo '<tr><td>'.$key.'</td>';
										foreach ($value as $keyp => $valuep) {
											$isSelected = (!empty($accesses) && in_array($valuep, $accesses) ? 'checked' : '');
											echo '<td style="width:'.(in_array($valuep, array('show_all_notification', 'update_position')) ? '300px' : '150px').' !important;float:left;"><label><input type="checkbox" style="margin-right:5px;" name="access[]" value="'.$valuep.'" '.$isSelected.'>'.$keyp.'</label></td>';
										}
										echo '</tr>';
									}
								}
								echo '</tr>';
							}
						?>
					</table>
				</fieldset>

				<fieldset id="formFieldset" class="noFieldset">
					<table class="table table-borderless">		
						<tr>
							<td class="tdLegend"></td>
							<td>
								<input id="submitButton" type="submit" class="btn btn-primary" value="Simpan">
								<a href="<?=site_url(uriSegment(1))?>" class="btn btn-danger">Batal</a>
							</td>
						</tr>
					</table>
				</fieldset>
			</div>
		</div>
	</form>
</div>