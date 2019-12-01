<?php
$ci =& get_instance();
?>
<div class="continer" style="display:inline-block;width:100%;">

    <?php
        if (flashData('success')) {
            echo "<div class='alert alert-success'>".flashData('success')." <span style='float:right;font-weight:bold;cursor:pointer;' onClick='closeAlert()'>x</span> </div>";
        }
        if (isset($notGrantedAlert) && $notGrantedAlert) {
            echo "<div class='alert alert-danger'>Maaf, anda tidak dapat mengakses halaman tersebut, silahkan hubungi Administrator!<span style='float:right;font-weight:bold;cursor:pointer;' onClick='closeAlert()'>x</span> </div>";
        }
    ?>

    <div class="dashboard-left">
        <div style="font-size:18px;margin-bottom:20px;">Quick Access</div>

        <ul>
            <?php if (canAccess('employee')) { ?>
                <li>
                    <a href="<?=site_url('employee')?>">
                        <img src="<?=base_url('public/images/menus/quick-access/employee.png')?>" alt="">
                    </a>
                </li>
            <?php } ?>
            
            <?php if (canAccess('promotion/request')) { ?>
                <li>
                    <a href="<?=site_url('promotion/request')?>">
                        <img src="<?=base_url('public/images/menus/quick-access/promotion.png')?>" alt="">
                    </a>
                </li>
            <?php } ?>

            <?php if (canAccess('promotion/report')) { ?>
                <li>
                    <a href="<?=site_url('promotion/report')?>">
                        <img src="<?=base_url('public/images/menus/quick-access/promotion_report.png')?>" alt="">
                    </a>
                </li>
            <?php } ?>
            
            <?php if (canAccess('retirement/request')) { ?>
                <li>
                    <a href="<?=site_url('retirement/request')?>">
                        <img src="<?=base_url('public/images/menus/quick-access/retirement.png')?>" alt="">
                    </a>
                </li>
            <?php } ?>
            
            <?php if (canAccess('retirement/report')) { ?>
                <li>
                    <a href="<?=site_url('retirement/report')?>">
                        <img src="<?=base_url('public/images/menus/quick-access/retirement_report.png')?>" alt="">
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="card" style="width: 18rem;float:right;width:19%;">
        <img src="<?=base_url($ci->profilePhotoPath."/".($photo != '' ? $photo : 'template.png'));?>" class="card-img-top" alt="...">
        <div class="card-body text-center">
            <div style="line-height:1px;">
                <h5 class="card-title text-center"><?=sess('nama')?></h5>
                <span class="card-text"><?=sess('jabatan')?></span>
            </div>
            
            <hr>
            
            <p>
                <span class="card-text"><?=sess('nip')?></span>
                <br>
                <span class="card-text"><?=sess('golongan')?></span>
            </p>
            
            <a href="<?=site_url('employee/form/'.sess('nip').'/f')?>" class="btn btn-primary" style="">Profil Saya</a>
            <a href="<?=site_url('auth/out')?>" class="btn btn-danger" style="">Keluar</a>
        </div>
    </div>

</div>