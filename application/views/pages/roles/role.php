<div class="continer">

    <h5>Data Application Role</h5>

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
                        <label for="inputPassword2" class="sr-only">Key</label>
                        <select name="filterKey" id="" class="form-control">
                            <option value="roleName">Role Name</option>
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