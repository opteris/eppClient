<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View Sales Targets</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_addSalesTargets", "name" => "filter_addSalesTargets");
    echo form_open("DataEntryController/addSalesTargets", $attributes); ?>


    <!--<div class="col-sm-6" align="left">
        <div class="form-group">

            <select name="filter_P_projectId" id="filter_P_projectId" class="form-control">
                <option value="" default selected>-All Projects-</option>
                <?php
/*
                foreach ($data_get_all_projects as $project) {
                    $sel_project = (($project->tbl_projectId) == (set_value('filter_P_projectId'))) ? 'selected' : '';
                    $project_data = '<option value="' . $project->tbl_projectId . '" ' . $sel_project . '>' . $project->projectName . '</option>';
                    echo $project_data;
                }

                */?>
            </select>
        </div>
        <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search" />
        <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
               value="Export to Excel" onclick="location.href='<?/*= site_url('DataEntryController/salesTargets') */?>'"/>
    </div>-->
    <div class="col-sm-6" align="right">
        <input id="addTarget" name="addTarget" type="submit" class="btn btn-info" value="Add New Target"
               onclick="location.href='<?= base_url('DataEntryController/addSalesTargets') ?>'"/>

    </div>





    <?= form_close(); ?>

    <?php
    if(!empty($this->session->flashdata('msg'))){
        $successData="<div class='alert alert-success'>.$this->session->flashdata('msg').</div> ";
        echo $successData;
    }
    ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <td rowspan="2"><label>#</label></td>
                <td rowspan="2"><label>NAME OF SALES EXECUTIVE</label></td>
                <td rowspan="2"><label>Designation</label></td>
                <td rowspan="2"><label>Financial Year</label></td>

                <td colspan="12">
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
            $n = 1;
            foreach ($data_get_all_targets as $rowLog) {
                ?>
                <tr>
                    <td><?= $n; ?></td>
                    <td><?= $rowLog->fullNames; ?></td>
                    <td><?= $rowLog->designationName; ?></td>
                    <td><?= $rowLog->financial_year; ?></td>
                    <td><?= $rowLog->target_Jan; ?></td>
                    <td><?= $rowLog->target_Feb; ?></td>
                    <td><?= $rowLog->target_Mar; ?></td>
                    <td><?= $rowLog->target_Apr; ?></td>
                    <td><?= $rowLog->target_May; ?></td>
                    <td><?= $rowLog->target_Jun; ?></td>
                    <td><?= $rowLog->target_Jul; ?></td>
                    <td><?= $rowLog->target_Aug; ?></td>
                    <td><?= $rowLog->target_Sep; ?></td>
                    <td><?= $rowLog->target_Oct; ?></td>
                    <td><?= $rowLog->target_Nov; ?></td>
                    <td><?= $rowLog->target_Dec; ?></td>
                </tr>
                <?php
                $n++;
            }
            ?>
            </tbody>
        </table>
        <div class="col-md-12 text-left">
            <?= $pagination; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







