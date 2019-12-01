<?php foreach ($data as $key => $value) { ?>
    <div class="detailContainer" style="padding:10px;">
        <div class="form">
            <fieldset id="formFieldset">
                <legend>Detail Pengajuan Kenaikan Pangkat Reguler</legend>
                <fieldset id="formFieldset" style="margin-top:-0px;">
                    <legend>Informasi Pegawai</legend>
                    <table class="table table-borderless">
                        <?php
                            trDetail('NIP', $value['userRequestNIP']);
                            trDetail('Nama Lengkap', $value['nama']);
                            trDetail('Tanggal SK Awal', date(dateFormat(), strtotime($value['currentSK'])));
                            trDetail('Golongan Awal', $value['currentGolongan']);
                        ?>
                    </table>
                </fieldset>

                <fieldset id="formFieldset">
                    <legend>Informasi Dokumen & Jabatan Baru</legend>
                    <table class="table table-borderless">
                        <?php
                            trDetail('Golongan yang Diajukan', $value['promotionGolongan']);
                            trDetail('SK Baru', date(dateFormat(), strtotime($value['promotionSK'])));
                        ?>
                        <tr>
                            <td>Dokumen Persyaratan</td>
                            <td>
                                <table class="table table-striped">
                                    <?php
                                        if (isset($documents)) {
                                            $no = 1;
                                            foreach ($documents as $d_key => $d_value) {
                                                if ($d_value['documentType'] != 'SK') {
                                                    echo '<tr>
                                                        <td>'.$no.'</td>
                                                        <td style="width:70%;">'.$d_value['documentName'].'</td>
                                                        <td>
                                                            <a style="float:right;font-weight:bold;font-style:italic" href="'.base_url($documentPath.$d_value['documentPath']).'" target="blank">[ view uploaded documents ]</a>
                                                        </td>
                                                    </tr>';
                                                }
                                                $no++;
                                            }
                                        }
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset id="formFieldset">
                    <legend>Admin Pemeriksa</legend>
                    <table class="table table-borderless">
                        <?php
                            trDetail('NIP Admin Pemeriksa', $value['adminReviewNIP']);
                            trDetail('Nama Admin Pemeriksa', $value['adminReviewName']);
                            trDetail('Tanggal Mulai Pemeriksaan', date(dateFormat(), strtotime($value['startReviewTime'])));
                            trDetail('Status Pemeriksaan', $value['requestStatus']);
                            if ($value['requestStatus'] == 'Done') {
                                trDetail('Keputusan', ($value['approved'] == 'Y' ? '<b style="color:green">Approved</b>' : '<b style="color:red">Rejected</b>'));
                                if ($value['approved'] == 'Y') {
                                    echo '<tr><td>SK</td><td><a target="_blank" href="'.base_url('public/documents/promotion/'.$documents[env('PROMOTION_DOC')]['documentPath']).'">Download</a></td></tr>';
                                }
                            }
                        ?>
                    </table>
                </fieldset>
            </fieldset>
        </div>
    </div>
<?php } ?>