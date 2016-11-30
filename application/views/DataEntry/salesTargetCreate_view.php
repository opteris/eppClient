<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Add/Modify Sales Targets</span></li>
        </ol>
    </div>


    <?php
    if (!empty($this->session->flashdata('msg'))) {
        $successData = "
        <div class='alert alert-success'>.$this->session->flashdata('msg').</div>
        ";
        echo $successData;
    }
    ?>
    <?php
    $attributes = array("class" => "form-horizontal", "id" => "formSalesTargets", "name" => "formSalesTargets");
    echo form_open("DataEntryController/addSalesTargets", $attributes); ?>

    <div class="col-sm-12 table-responsive">

        <div class="form-group">
            <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="prj_category" class="control-label">Financial Year</label>
                </div>
                <div class="col-lg-8 col-sm-8">

                    <?php
                    $attributes = 'class = "form-control" id = "financial_year" name="financial_year"';
                    echo form_dropdown('financial_year', $financial_year, set_value('financial_year'), $attributes); ?>

                    <span class="text-danger"><?= form_error('financial_year'); ?></span>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="block_commercial_team_target" class="control-label">Block Commercial Team Target: </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="block_commercial_team_target" name="block_commercial_team_target" placeholder="Block Commercial Team Target" type="text"
                           class="form-control" value="<?= set_value('block_commercial_team_target'); ?>"/>
                    <span class="text-danger"><?= form_error('block_commercial_team_target'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="prj_acronym" class="control-label">Quarter One Commercial Team Target: </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="qtr_one_commercial_team_target" name="qtr_one_commercial_team_target" placeholder="Quater One Commercial Team Target" type="text"
                           class="form-control" value="<?= set_value('qtr_one_commercial_team_target'); ?>"/>
                    <span class="text-danger"><?= form_error('qtr_one_commercial_team_target'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="qtr_two_commercial_team_target" class="control-label">Quarter Two Commercial Team Target: </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="qtr_two_commercial_team_target" name="qtr_two_commercial_team_target" placeholder="Quater Two Commercial Team Target" type="text"
                           class="form-control" value="<?= set_value('qtr_two_commercial_team_target'); ?>"/>
                    <span class="text-danger"><?= form_error('qtr_two_commercial_team_target'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="qtr_three_commercial_team_target" class="control-label">Quarter Three Commercial Team Target: </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="qtr_three_commercial_team_target" name="qtr_three_commercial_team_target" placeholder="Quater Three Commercial Team Target" type="text"
                           class="form-control" value="<?= set_value('qtr_three_commercial_team_target'); ?>"/>
                    <span class="text-danger"><?= form_error('qtr_three_commercial_team_target'); ?></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="qtr_four_commercial_team_target" class="control-label">Quarter Four Commercial Team Target: </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="qtr_four_commercial_team_target" name="qtr_four_commercial_team_target" placeholder="Quater Four Commercial Team Target" type="text"
                           class="form-control" value="<?= set_value('qtr_four_commercial_team_target'); ?>"/>
                    <span class="text-danger"><?= form_error('qtr_four_commercial_team_target'); ?></span>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td rowspan="2"><strong>&nbsp;</strong>
                    <label>NAME OF SALES EXECUTIVE</label></td>

                <td colspan="12"><strong>&nbsp;</strong>
                    <label>MONTHLY TARGETS(UGX)</label>
                </td>
            </tr>
            <tr>
                <td><label>JAN</label></td>
                <td><label>FEB</label></td>
                <td><label>MAR</label></td>
                <td><label>APR</label></td>
                <td><label>MAY</label></td>
                <td><label>JUN</label></td>
                <td><label>JUL</label></td>
                <td><label>AUG</label></td>
                <td><label>SEP</label></td>
                <td><label>OCT</label></td>
                <td><label>NOV</label></td>
                <td><label>DEC</label></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $k=1;
            foreach($data_get_sales_team as $row_sales){
                $member_id=$row_sales->tbl_staffId;
                $member_name=$row_sales->fullNames;

            ?>
            <tr>
                <td><?=$member_name;?></td>
                <input id="target_loop_key" name="target_loop_key[]" type="hidden" value="1" />
                <input id="target_member_id<?=$k;?>" name="target_member_id[]" type="hidden" value="<?= $member_id; ?>"/>
                <td>

                        <input id="target_Jan_<?=$k;?>" name="target_Jan[]" placeholder="Jan Target" type="text"
                               class="form-control" value="<?= set_value('target_Jan[]'); ?>"/>
                        <span class="text-danger"><?= form_error('target_Jan[]'); ?></span>

                </td>

                <td>

                    <input id="target_Feb_<?=$k;?>" name="target_Feb[]" placeholder="Feb Target" type="text"
                           class="form-control" value="<?= set_value('target_Feb[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Feb[]'); ?></span>

                </td>

                <td>

                    <input id="target_Mar_<?=$k;?>" name="target_Mar[]" placeholder="Mar Target" type="text"
                           class="form-control" value="<?= set_value('target_Mar[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Mar[]'); ?></span>

                </td>

                <td>

                    <input id="target_Apr_<?=$k;?>" name="target_Apr[]" placeholder="Apr Target" type="text"
                           class="form-control" value="<?= set_value('target_Apr[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Apr[]'); ?></span>

                </td>

                <td>

                    <input id="target_May_<?=$k;?>" name="target_May[]" placeholder="May Target" type="text"
                           class="form-control" value="<?= set_value('target_May[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_May[]'); ?></span>

                </td>

                <td>

                    <input id="target_Jun_<?=$k;?>" name="target_Jun[]" placeholder="Jun Target" type="text"
                           class="form-control" value="<?= set_value('target_Jun[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Jun[]'); ?></span>

                </td>

                <td>

                    <input id="target_Jul_<?=$k;?>" name="target_Jul[]" placeholder="Jul Target" type="text"
                           class="form-control" value="<?= set_value('target_Jul[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Jul[]'); ?></span>

                </td>

                <td>

                    <input id="target_Aug_<?=$k;?>" name="target_Aug[]" placeholder="Aug Target" type="text"
                           class="form-control" value="<?= set_value('target_Aug[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Aug[]'); ?></span>

                </td>

                <td>

                    <input id="target_Sep_<?=$k;?>" name="target_Sep[]" placeholder="Sep Target" type="text"
                           class="form-control" value="<?= set_value('target_Sep[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Sep[]'); ?></span>

                </td>

                <td>

                    <input id="target_Oct_<?=$k;?>" name="target_Oct[]" placeholder="Oct Target" type="text"
                           class="form-control" value="<?= set_value('target_Oct[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Oct[]'); ?></span>

                </td>

                <td>

                    <input id="target_Nov_<?=$k;?>" name="target_Nov[]" placeholder="Nov Target" type="text"
                           class="form-control" value="<?= set_value('target_Nov[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Nov[]'); ?></span>

                </td>

                <td>

                    <input id="target_Dec_<?=$k;?>" name="target_Dec[]" placeholder="Dec Target" type="text"
                           class="form-control" value="<?= set_value('target_Dec[]'); ?>"/>
                    <span class="text-danger"><?= form_error('target_Dec[]'); ?></span>

                </td>

            </tr>
            <?php
                $k++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
            <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary"
                   value="Insert"/>
            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger"
                   value="Cancel"
                   onclick="location.href='<?= base_url('DataEntry/salesTarget_view') ?>'"/>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







