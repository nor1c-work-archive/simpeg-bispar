<div id="detailContainer">
    <!-- <div class="form"> -->
        <fieldset id="detailFieldset">
            <legend>Filters</legend>
            <table class="table table-stripped table-bordered">
                <?php
                    trDetail('NIP', '<input type="text" class="form-control" style="width:100%">');
                    trDetail('Nama', '<input type="text" class="form-control" style="width:100%">');
                    echo "<tr>
                        <td>Tahun Kelahiran</td>
                        <td class='form-inline' style='border:none;border-right:solid 1px #eee;'>
                            <input type='text' class='form-control' style='width:47%' placeholder='Tahun Awal'> &nbsp; - &nbsp; 
                            <input type='text' class='form-control' style='width:47%' placeholder='Tahun Akhir'>
                        </td>
                    </tr>";
					inputOption('Golongan', 'golongan', '', ' style="width:100%" ', $golongan, 'golongan', 'golongan');
					inputOption('Pangkat', 'pangkat', '', ' style="width:100%" ', $pangkat, 'pangkat', 'pangkat');
					inputOption('Jabatan', 'jabatan', '', ' style="width:100%" ', $jabatan, 'jabatan', 'jabatan');
                ?>
            </table>
            <div style="bottom:0;position:relative;">
                <input id="submitButton" type="submit" class="btn btn-primary" value="CETAK">
            </div>
        </fieldset>
    <!-- </div> -->
</div>