<?php

    switch (uriSegment(2)) {
        case 'report':
                $pageTitle = 'Laporan Permohonan Pensiun Masa Kerja';
            break;
        
        default:
                $pageTitle = 'Pengajuan Permohonan Pensiun Masa Kerja';
            break;
    }

?>

<div class="continer">

    <h5><?=$pageTitle?></h5>

    <?php
        if (flashData('success')) {
            echo "<div class='alert alert-success'>".flashData('success')." <span style='float:right;font-weight:bold;cursor:pointer;' onClick='closeAlert()'>x</span> </div>";
        } else if (flashData('error')) {
            echo "<div class='alert alert-danger'>".flashData('error')." <span style='float:right;font-weight:bold;cursor:pointer;' onClick='closeAlert()'>x</span> </div>";
        }
    ?>

    <div class="content-section">
        <div class="filters">
            <div class="filter-search">
                <form class="form-inline">
                    <div class="form-group mb-2">
                        Search by
                    </div>
                    <div class="form-group mx-sm-1 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <select name="filterKey" id="" class="form-control">
                            <option value="nama">Nama Pegawai</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-1 mb-2">
                        <label for="inputPassword2" class="sr-only">Search Keyword</label>
                        <input type="text" name="filterKeyword" class="form-control" placeholder="Keyword" style="width:300px;" value="<?=inputGet('filterKeyword')?>">
                    </div>
                    <button id="filterButton" type="" class="btn btn-primary mb-2">Search</button>
                    <?php
                        if (inputGet('filterKey')) {
                            echo '&nbsp; <button id="clearFilterButton" href="#" type="button" class="btn btn-dark mb-2">Clear applied filter</button>';
                        }
                    ?>
                </form>
            </div>
            <!-- <div class="filter-order">
                <form class="form-inline">
                    <div class="form-group mb-2">
                        Order by
                    </div>
                    <div class="form-group mx-sm-1 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <select name="" id="" class="form-control">
                            <option value="">Nama Pegawai</option>
                        </select>
                    </div>
                    <div class="form-group mx-sm-1 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <select name="" id="" class="form-control">
                            <option value="">ASC</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Order</button>
                </form>
            </div> -->
        </div>
    </div>

    <div class="content-section">
        <div class="action-button">
            <?php $this->load->view('templates/actionButtons.php'); ?>
        </div>

        <div class="table-content">
            <?php $this->load->view('templates/automaticTable'); ?>
        </div>

    </div>

</div>