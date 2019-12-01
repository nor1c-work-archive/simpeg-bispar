<div id="detailContainer">
    <!-- <div class="form"> -->
        <fieldset id="detailFieldset">
            <legend>Filters</legend>
            <form id="rekapForm" action="<?=site_url(uriSegment(1).'/rekapSelector')?>" target="print_popup" method="get" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
            <table class="table table-stripped table-bordered">
                <?php
                    trDetail('NIP', '<input type="text" name="userRequestNIP" class="form-control" style="width:100%">');
                    trDetail('Nama', '<input type="text" name="userRequestName" class="form-control" style="width:100%">');
                    trDetail('Tahun Pengajuan', '<input type="text" name="yearCreated" class="form-control" style="width:100%">');
                    echo "<tr>
                        <td>Tanggal Pengajuan</td>
                        <td class='form-inline' style='border:none;border-right:solid 1px #eee;'>
                            <input type='text' name='firstRequestDate' class='form-control' style='width:47%' placeholder='Tanggal Awal'> &nbsp; - &nbsp; 
                            <input type='text' name='lastRequestDate' class='form-control' style='width:47%' placeholder='Tanggal Akhir'>
                        </td>
                    </tr>";
                    echo "<tr>
                        <td>Status Pengajuan</td>
                        <td class='form-inline' style='border:none;border-right:solid 1px #eee;'>
                            <select name='requestStatus' id='' class='form-control' style='width:100%'>
								<option value='' selected disabled>--Status Pemeriksaan--</option>
								<option value='Open'>Open</option>
								<option value='Sedang Direview'>Tahap Pemeriksaan Dokumen</option>
								<option value='Reject'>Tolak/Revisi</option>
								<option value='Sedang Dikirim'>Tahap Pengiriman ke DITJEN</option>
								<option value='Done'>Done/Selesai</option>
							</select>
                        </td>
                    </tr>";
                    echo "<tr>
                        <td>Keputusan Akhir</td>
                        <td class='form-inline' style='border:none;border-right:solid 1px #eee;'>
                            <select name='approved' id='' class='form-control result' style='width:100%'>
								<option value='' selected disabled>--Keputusan Pemeriksaan--</option>
								<option value='Y'>Approve</option>
								<option value='N'>Reject</option>
							</select>
                        </td>
                    </tr>";				
                ?>
            </table>
            </form>
            <div style="bottom:0;position:relative;">
                <input id="submitRekapButton" type="submit" class="btn btn-primary" value="CETAK">
            </div>
        </fieldset>
    <!-- </div> -->
</div>