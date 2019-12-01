<?php foreach ($data as $key => $value) { ?>
    <div id="detailContainer">
        <div class="picture card" style="position:fixed">
            <fieldset id="detailFieldset">
                <legend style>Profile Picture</legend>
                <img src="<?=base_url('public/images/users/profile_pictures/'.($value['photo'] != '' ? $value['photo'] : 'template.png'))?>" class="card-img-top" alt="...">
            </fieldset>
        </div>

        <div class="form">
            <fieldset id="detailFieldset">
                <legend>Bio & Information</legend>
                <table class="table table-stripped table-bordered">
                    <?php
                        trDetail('NIP', $value['nip']);
                        trDetail('Nama Lengkap', $value['nama']);
                        trDetail('Tempat Lahir', $value['tempat_lahir']);
                        trDetail('Tanggal Lahir', $value['tgl_lahir']);
                        trDetail('No. Telepon', $value['no_telp']);
                    ?>
                </table>
            </fieldset>

            <fieldset id="detailFieldset">
                <legend>Pendidikan</legend>
                <table class="table table-stripped table-bordered">
                    <?php 
                        trDetail('Tmt SK Terakhir', $value['tmt_sk_terakhir']);
                        trDetail('Perguruan Tinggi', $value['perguruan_tinggi']);
                        trDetail('Pendidikan', $value['pendidikan']);
                        trDetail('Tahun Pendidikan', $value['tahun_pendidikan']);
                    ?>
                </table>
            </fieldset>

            <fieldset id="detailFieldset">
                <legend>Posisi</legend>
                <table class="table table-stripped table-bordered">
                    <?php
                        trDetail('Golongan', $value['golongan'] . ' (' . $value['pangkat'] . ')');
                        // trDetail('Pangkat', $value['pangkat']);
                        trDetail('Jabatan', $value['jabatan']);
                    ?>
                </table>
            </fieldset>
        </div>
    </div>
<?php } ?>