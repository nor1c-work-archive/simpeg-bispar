<ul>
    <?php if (canAccess(uriSegment(1).'/'.(in_array(uriSegment(2), array('request', 'report')) ? uriSegment(2).'/add' : 'add'))) { ?>
        <a id="addButton" class="actionButton"><li><i class="fas fa-plus"></i> &nbsp; TAMBAH</li></a>
    <?php } ?>

    <?php if (canAccess(uriSegment(1).'/'.(in_array(uriSegment(2), array('request', 'report')) ? uriSegment(2).'/edit' : 'edit'))) { ?>
        <a id="editButton" class="actionButton"><li><i class="fas fa-pen"></i> &nbsp; <?=uriSegment(2) == 'report' ? 'UPDATE' : 'UBAH' ?></li></a>
    <?php } ?>
        
    <?php if (canAccess(uriSegment(1).'/'.(in_array(uriSegment(2), array('request', 'report')) ? uriSegment(2).'/delete' : 'delete'))) { ?>
        <a id="deleteButton" class="actionButton"><li><i class="fas fa-trash"></i> &nbsp; HAPUS</li></a>
    <?php } ?>
    
    <?php if (canAccess(uriSegment(1).'/detail')) { ?>
        <a id="detailButton" class="actionButton"><li><i class="fas fa-search"></i> &nbsp; LIHAT DETAIL</li></a>
    <?php } ?>
    
    <?php if (canAccess(uriSegment(1).'/'.(in_array(uriSegment(2), array('request', 'report')) ? uriSegment(2).'/review' : 'review'))) { ?>
        <a id="reportButton" class="actionButton"><li><i class="fas fa-check"></i> &nbsp; REVIEW</li></a>
    <?php } ?>

    <!-- <?php if (uriSegment(1) == 'employee') { ?>
        <?php if (canAccess(uriSegment(1).'/'.(in_array(uriSegment(2), array('request', 'report')) ? uriSegment(2).'/rekap' : 'rekap'))) { ?>
            <a id="rekapButton" class="actionButton" data-fancybox-rekap data-type="iframe" data-src="<?=site_url(uriSegment(1).'/rekapSelector')?>" href="javascript:;"><li><i class="fas fa-print"></i> &nbsp; REKAP</li></a>
        <?php } ?>
    <?php } ?> -->
    
    <a id="reloadButton" class="actionButton"><li data-toggle="tooltip" data-placement="right" title="Reload Data"><i class="fas fa-refresh"></i></li></a>
</ul>