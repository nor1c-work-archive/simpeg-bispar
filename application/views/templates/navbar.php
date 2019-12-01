<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="<?=site_url()?>">SIMPEG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?=site_url()?>">Dashboard</a>
            </li>
            <?php if (canAccess('employee')) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=site_url('employee')?>">Data Kepegawaian</a>
                </li>
            <?php } ?>
            
            <?php if (canAccess('promotion/request') || canAccess('promotion/report')) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?=site_url('')?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Kenaikan Pangkat Reguler
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if (canAccess('promotion/request')) { ?>
                        <a class="dropdown-item" href="<?=site_url('promotion/request')?>">Permohonan</a>
                    <?php } ?>
                    <?php if (canAccess('promotion/report')) { ?>
                        <a class="dropdown-item" href="<?=site_url('promotion/report')?>">Laporan</a>
                    <?php } ?>
                    <!-- <a class="dropdown-item" href="<?=site_url('promotion/history')?>">Riwayat</a> -->
                </div>
            </li>
            <?php } ?>
            
            <?php if (canAccess('retirement/request') || canAccess('retirement/report')) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?=site_url('')?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Data Pensiun
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if (canAccess('retirement/request')) { ?>
                        <a class="dropdown-item" href="<?=site_url('retirement/request')?>">Permohonan</a>
                    <?php } ?>
                    <?php if (canAccess('retirement/report')) { ?>
                        <a class="dropdown-item" href="<?=site_url('retirement/report')?>">Laporan</a>
                    <?php } ?>
                    <!-- <a class="dropdown-item" href="<?=site_url('retirement/history')?>">Riwayat</a> -->
                </div>
            </li>
            <?php } ?>
            
            <?php if (canAccess('notification')) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?=site_url('notification')?>">Notifikasi</a>
            </li>
            <?php } ?>

            <!-- <?php if (canAccess('golongan') || canAccess('roles')) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?=site_url('')?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Configuration
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if (canAccess('golongan')) { ?>
                        <a class="dropdown-item" href="<?=site_url('golongan')?>">Master Data Golongan</a>
                    <?php } ?>
                    <a class="dropdown-item" href="<?=site_url('jabatan')?>">Master Data Jabatan</a>
                    <a class="dropdown-item" href="<?=site_url('pangkat')?>">Master Data Pangkat</a>
                    <?php if (canAccess('roles')) { ?>
                        <a class="dropdown-item" href="<?=site_url('roles')?>">User Role Preferences</a>
                    <?php } ?>
                </div>
            </li>
            <?php } ?> -->
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="<?=site_url('')?>" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=sessData('nama')?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?=site_url('employee/form/'.sessData('nip').'/f')?>">Profil Saya</a>
                    <a class="dropdown-item" href="<?=site_url('auth/out')?>">Keluar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>