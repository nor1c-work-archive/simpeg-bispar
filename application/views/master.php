<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SIMPEG | PPPPTK Bispar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Material Design Bootstrap</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link href="<?=base_url('node_modules/mdbootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="<?=base_url('public/css/custom.css')?>">
	
	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/jquery-3.3.1.min.js')?>"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<style>
		.swal2-title {
			font-size: 16px !important;
			font-weight: 400;
		}

		.swal2-actions button {
			font-size: 12px !important;
		}

		.fancybox-title{height:0px !important;}
		.fancybox-title-autoheight{height:auto !important;}
	</style>
</head>
<?php if ($withTemplate) { ?>

<body>

	<div class="master-container">

<?php } ?>

		<?php 
			if ($withTemplate) {
				$this->load->view('templates/header');
				$this->load->view('templates/navbar');
			echo '<div id="content">';
			}
		?>

			<?php $this->load->view($page); ?>
		
		<?php 
			if ($withTemplate) {
				echo '</div>';
				$this->load->view('templates/footer');
			} 
		?>

	</div>

	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('node_modules/mdbootstrap/js/bootstrap.min.js')?>"></script>
	
	<!-- Custom Javascript Code -->
	<script>
		$(document).ready(function() {
			$("[data-fancybox-rekap]").fancybox({
				iframe : {
					css : {
						width : 800,
					}
				}
			});
		});

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});

		$.fn.datepicker.language['ro'] = {
			days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
			daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
			daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
			months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
			monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			today: 'Today',
			clear: 'Clear',
			dateFormat: 'mm/dd/yyyy',
			timeFormat: 'hh:ii aa',
			firstDay: 0,
		};

		<?php if(uriSegment(3) == '') { ?>
			var rows_selected = [];
			table = $('#automaticTable').DataTable({
				'processing'  : true,
				'serverSide'  : true,
				"oLanguage"   : {
					"sSearch"   : "Quick Search",
				},
				'ajax'        : {
					url: '<?=$dataUrl?>', 
					type: 'post',
				},
				'columnDefs': [
					{
						'targets': 0,
						'searchable': false,
						'orderable': false,
						'width': '1%',
						'className': 'dt-body-center',
						'render': function (data, type, full, meta){
							return '<input type="checkbox">';
						}
					},
					{
						'targets': 1,
						'width': '5%',
					}
				],
				'order': [[1, 'asc']],
				'rowCallback': function(row, data, dataIndex){
					var rowId = data[0];

					if($.inArray(rowId, rows_selected) !== -1){
						$(row).find('input[type="checkbox"]').prop('checked', true);
						$(row).addClass('selected');
					}
				}
			});

			function updateDataTableSelectAllCtrl(table){
				var $table             = table.table().node();
				var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
				var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
				var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

				if($chkbox_checked.length === 0){
					chkbox_select_all.checked = false;
					if('indeterminate' in chkbox_select_all){
						chkbox_select_all.indeterminate = false;
					}

				} else if ($chkbox_checked.length === $chkbox_all.length){
					chkbox_select_all.checked = true;
					if('indeterminate' in chkbox_select_all){
						chkbox_select_all.indeterminate = false;
					}

				} else {
					chkbox_select_all.checked = true;
					if('indeterminate' in chkbox_select_all){
						chkbox_select_all.indeterminate = true;
					}
				}
			}

			function reloadTable() {
				table.ajax.reload();
			}

			function closeAlert() {
				$('.alert').css('display', 'none');
			}

			$(document).ready(function() {

				<?php if(uriSegment(2) == 'report') { ?>
					$('#addButton').hide();
				<?php } ?>

				<?php if(uriSegment(2) != 'request') { ?>
					$('#reportButton').hide();
				<?php } ?>

				$('#filterButton').click(function() {
					if ($('input[name=filterKeyword]').val() == '') {
						Swal.fire('Please type the filter keyword!');
						return false;
					} else {
						reloadTable;
					}
				});

				$('#clearFilterButton').click(function() {
					$(location).attr('href', '<?=site_url(uriSegment(1) . (uriSegment(2) ? '/' . uriSegment(2) : ''))?>');
				});

				$('#automaticTable tbody').on('click', 'input[type="checkbox"]', function(e){
					var $row = $(this).closest('tr');
					var data = table.row($row).data();
					var rowId = data[0];
					var index = $.inArray(rowId, rows_selected);

					if(this.checked && index === -1) {
						rows_selected.push(rowId);

					} else if (!this.checked && index !== -1){
						rows_selected.splice(index, 1);
					}

					if(this.checked){
						$row.addClass('selected');
					} else {
						$row.removeClass('selected');
					}

					updateDataTableSelectAllCtrl(table);

					e.stopPropagation();

					if (rows_selected.length <= 1) {
						// detail
						$('#detailButton').data('src', '<?=site_url(uriSegment(1).'/detail?pk=')?>' + rows_selected);
						$('#detailButton').attr('data-fancybox-detail', true);
						$('#detailButton').attr('data-type', 'iframe');
						$('#detailButton').attr('data-src', '');
						$('#detailButton').attr('href', 'javascript:;');
						$("[data-fancybox-detail]").fancybox({
							iframe : {
								css : {
									width : 1200,
									height: '100%',
								}
							}
						});
					} else {
						// detail
						$('#detailButton').removeAttr('data-fancybox-detail', true);
						$('#detailButton').removeAttr('data-type', true);
						$('#detailButton').removeAttr('data-src', true);
						$('#detailButton').removeAttr('href', true);
					}
				});

				$('#automaticTable').on('click', 'tbody td, thead th:first-child', function(e){
					$(this).parent().find('input[type="checkbox"]').trigger('click');
				});

				$('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
					if(this.checked) {
						$('#automaticTable tbody input[type="checkbox"]:not(:checked)').trigger('click');
					} else {
						$('#automaticTable tbody input[type="checkbox"]:checked').trigger('click');
					}

					e.stopPropagation();
				});

				table.on('draw', function(){
					updateDataTableSelectAllCtrl(table);
				});				
				$('#frm-automaticTable').on('submit', function(e){
					var form = this;

					$.each(rows_selected, function(index, rowId){
						$(form).append(
							$('<input>')
								.attr('type', 'hidden')
								.attr('name', 'id[]')
								.val(rowId)
						);
					});				
					$('#automaticTable-console').text($(form).serialize());
					console.log("Form submission", $(form).serialize());				
					$('input[name="id\[\]"]', form).remove();				
					e.preventDefault();
				});

				// START OF ACTION BUTTON
				$('#addButton').click(function() {
					$(location).attr('href', '<?=site_url(urisegment(1).(in_array(uriSegment(2), array('request', 'report')) ? '/'.uriSegment(2) : '').'/form')?>');
				});

				$('#editButton').click(function() {
					if (rows_selected.length <= 0) {
						Swal.fire('Please select the data first!')
					} else {
						if (rows_selected.length > 1) {
							Swal.fire('You cannot edit multiple data at once!')
						} else {
							$(location).attr('href', '<?=site_url(uriSegment(1).(in_array(uriSegment(2), array('request', 'report')) ? '/'.uriSegment(2) : '').'/form/')?>'+rows_selected);
						}
					}
				});

				$('#detailButton').click(function() {
					if (rows_selected.length <= 0) {
						Swal.fire('Please select the data first!');
						return false;
					} else {
						if (rows_selected.length > 1) {
							Swal.fire('You cannot view multiple data at once!');
							return false;
						} else {
							// $.fancybox.open({
							// 	'type' 				: 'iframe',
							// 	'width'				: 800,
							// 	'height'			: 600,
							// 	'maxWidth'				: 800,
							// 	'maxHeight'			: 600,
							// 	'autoSize'			: false,
							// 	'autoDimensions' 	: false,
							// 	'src'       		: '<?=site_url(uriSegment(1).'/detail?pk=')?>' + rows_selected,
							// });
							// return false;
						}
					}
				});

				$('#deleteButton').click(function() {
					if (rows_selected.length <= 0) {
						Swal.fire('Please select the data first!')
					} else {
						Swal.fire({
							title: 'Are you sure?',
							text: "You won't be able to revert this!",
							type: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes, delete it!'
						}).then((result) => {
							if (result.value) {
								$.ajax({
									url: '<?=site_url(uriSegment(1).'/delete?ids=')?>'+rows_selected + '<?=uriSegment(2) == 'report' ? '&mode=report' : ''?>',
									type: 'GET'
								})
								.then(res => {
									if (res) {
										reloadTable();
										rows_selected = [];
										Swal.fire('Deleted!', 'Data has been deleted.', 'success')
									} else {
										Swal.fire('Failed!', 'Failed to delete data.', 'error')
									}
								});
							}
						});
					}
				});

				$('#reportButton').click(function() {
					if (rows_selected.length <= 0) {
						Swal.fire('Please select the data first!')
					} else {
						if (rows_selected.length > 1) {
							Swal.fire('You cannot edit multiple data at once!')
						} else {
							$(location).attr('href', '<?=site_url(uriSegment(1).'/report/form/')?>'+rows_selected);
						}
					}
				});

				$('#rekapButton').click(function() {
					// open print modal
				});

				$('#reloadButton').click(function() {
					reloadTable();
				});
				// END OF ACTION BUTTON
			});
		<?php } ?>

	</script>
<?php if ($withTemplate) {
	echo "</body>";
} ?>
</html>