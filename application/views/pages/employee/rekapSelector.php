<div id="detailContainer">
    <fieldset id="detailFieldset">
        <legend>Filters</legend>
        <form id="rekapForm" action="<?=site_url(uriSegment(1).'/rekapSelector')?>" target="print_popup" method="get" onsubmit="window.open('about:blank','print_popup','width=1000,height=800');">
            <table class="table table-stripped table-bordered">
                <input type="hidden" name="print" value="1">
                <?php
                    trDetail('NIP', '<input type="text" name="nip" class="form-control" style="width:30%">');
                    trDetail('Nama', '<input type="text" name="nama" class="form-control" style="width:80%">');
                    echo "<tr>
                        <td>Tahun Kelahiran</td>
                        <td class='form-inline' style='border:none;border-right:solid 1px #eee;'>
                            <input type='text' class='form-control' style='width:47%' name='firstBirthYear' placeholder='Tahun Awal'> &nbsp; - &nbsp; 
                            <input type='text' class='form-control' style='width:47%' name='lastBirthYear' placeholder='Tahun Akhir'>
                        </td>
                    </tr>";
                    inputForm('Tanggal SK', 'tmt_sk_terakhir', '', ' data-date-format="dd/mm/yyyy" ', '', ' datepicker-here ');
                    inputOption('Golongan', 'golongan', '', ' style="width:100%" ', $golongan, 'golongan', 'golongan');
                    inputOption('Pangkat', 'pangkat', '', ' style="width:100%" ', $pangkat, 'pangkat', 'pangkat');
                    inputOption('Jabatan', 'jabatan', '', ' style="width:100%" ', $jabatan, 'jabatan', 'jabatan');
                    inputOption('Status Kepegawaian', 'retirementStatus', '', ' style="width:100%" ', $retirementStatus, 'retirementStatus', 'retirementStatus', TRUE);
                ?>
            </table>
            <div style="bottom:0;position:relative;">
                <input id="submitRekapButton" type="submit" class="btn btn-primary" value="CETAK">
            </div>
        </form>
    </fieldset>
</div>