<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Close Sales</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_CloseSale", "name" => "filter_CloseSale");
    echo form_open("DataEntryController/closeSale", $attributes); ?>


    <div class="col-sm-6" align="left">
        <div class="form-group">
            <select name="staffId" id="staffId" class="form-control">
            <option value="" default selected>-Commercial Team Members-</option>
            <?php
            $allStaffData = '';
            foreach ($get_all_sales_team as $rStaff) {

                $sel_Staff_A = (($rStaff->tbl_staffId) == (($this->session->userdata['user_id']))) ? 'selected' : '';
                $sel_Staff_B = (($rStaff->tbl_staffId) == (set_value('staffId'))) ? 'selected' : '';
                $sel_Staff=($sel_Staff_B !=='')?$sel_Staff_B:$sel_Staff_A;
                $allStaffData .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
            }
            $allStaffData .= '</select>';
            echo $allStaffData;
            ?>

        </div>
        <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
               onclick="location.href='<?= site_url('DataEntryController/closeSale') ?>'" />
        <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
               value="Export to Excel" onclick="location.href='<?= site_url('DataEntryController/closeSale') ?>'"/>
    </div>
    <div class="col-sm-6" align="right">
        <input id="closeSale" name="closeSale" type="submit" class="btn btn-info" value="Close Sale"
               onclick="location.href='<?= base_url('DataEntryController/closeSale') ?>'"/>

    </div>





    <?= form_close(); ?>

    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="11">ORS Closed Sales</th>
            </tr>

            <tr>
                <th colspan="2">#</th>
                <th colspan="4">Sales Executive</th>
                <th>Sale Close Date</th>
                <th>Contract Signing Date</th>
                <th>Close Amount</th>
                <th>Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_all_closed_sales as $rowSale) {
                ?>
                <tr id="delete_link_<?= $rowSale->pk_id; ?>">
                    <td>
                        <input name="loopkey[]" id="loopkey" value="1" type="hidden">
                        <input name="pk_id[]" id="pk_id" value="<?= $rowSale->pk_id; ?>" type="checkbox">
                    </td>
                    <td><?= $n; ?></td>
                    <td colspan="4"><?= $rowSale->fullNames; ?></td>
                    <td><?= $rowSale->sale_close_date; ?></td>
                    <td><?= $rowSale->sale_contract_signing_date; ?></td>
                    <td><?= number_format($rowSale->sale_close_amount_ugx,2,'.',','); ?></td>
                    <td colspan=""><?= $rowSale->exec_comment; ?></td>

                </tr>
                <?php
                $n++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







