<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <?php

            ?>
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Sale Closure</span></li>

        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                <legend>Sale Closure Details</legend>

                <?php
                $attributes = array("class" => "form-horizontal", "id" => "filter_closeSales", "name" => "filter_closeSales");
                echo form_open("DataEntryController/addCloseSale", $attributes); ?>

                <fieldset>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="staffId" class="control-label">Sales Executive</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
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
                                <span class="text-danger"><?= form_error('staffId'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="call_sheet_id" class="control-label">Negotiated Prospect be closed</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <select name="call_sheet_id" id="call_sheet_id" class="form-control">
                                    <option value="" default selected>-Prospects-</option>
                                    <?php
                                    $allSheetData = '';
                                    foreach ($data_get_all_call_sheets as $rSheet) {
                                    $sel_Sheet = (($rSheet->tbl_call_sheet_actualsId) == (set_value('call_sheet_id'))) ? 'selected' : '';
                                        $allSheetData .= '<option value="' . $rSheet->tbl_call_sheet_actualsId . '" ' . $sel_Sheet . '>' . $rSheet->SalesCall . '</option>';
                                    }
                                    $allSheetData .= '</select>';
                                    echo $allSheetData;
                                ?>
                                <span class="text-danger"><?= form_error('call_sheet_id'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="sale_close_date" class="control-label">Sale Close Date</label>
                            </div>
                            <div class="col-lg-8 col-sm-8 input-group date" data-provide="datepicker">
                                <input id="sale_close_date" name="sale_close_date" placeholder="Sale Close Date" type="text"
                                       class="form-control" value="<?= set_value('sale_close_date'); ?>"/>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <span class="text-danger"><?= form_error('sale_close_date'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="sale_contract_signing_date" class="control-label">Contract Signing Date</label>
                            </div>
                            <div class="col-lg-8 col-sm-8 input-group date" data-provide="datepicker">
                                <input id="sale_contract_signing_date" name="sale_contract_signing_date" placeholder="Contract Signing Date" type="text"
                                       class="form-control" value="<?= set_value('sale_contract_signing_date'); ?>"/>
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <span class="text-danger"><?= form_error('sale_contract_signing_date'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="sale_close_amount_ugx" class="control-label">Sale Amount in UGX</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="sale_close_amount_ugx" name="sale_close_amount_ugx" placeholder="Sale Closure Amount" type="text"
                                       class="form-control" value="<?= set_value('sale_close_amount_ugx'); ?>"/>
                                <span class="text-danger"><?= form_error('sale_close_amount_ugx'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-sm-4"><label for="exec_comment">Comment</label>
                            </div>
                            <div class="col-sm-8">
                                <textarea name="exec_comment" id="exec_comment" cols="45" rows="5" class="form-control"
                                          placeholder="Comment"><?= set_value('exec_comment'); ?></textarea>
                                <span class="text-danger"><?= form_error('exec_comment'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                            <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Close Sale"/>
                            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel"
                                   onclick="location.href='<?= base_url('DataEntryController/closeSale') ?>'"/>
                        </div>
                    </div>

                    <?= form_close(); ?>
                    <?= $this->session->flashdata('msg'); ?>
                </fieldset>

            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







