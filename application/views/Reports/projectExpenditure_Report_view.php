<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active"><span>Project Expenditure</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_ProjectExpenditure", "name" => "filter_ProjectExpenditure");
    echo form_open("ReportsController/projectExpenditure", $attributes); ?>
    <div class="form-group">

        <select name="projectId" id="projectId" class="form-control">
            <option value="" default selected>-All Projects-</option>
            <?php
            $p = 1;
            foreach ($data_get_all_projects as $rProjects) {
                $sel_Project = (($rProjects->projectId) == ($this->input->post("projectId"))) ? 'selected' : 22;
                echo "<option value=\"" . $rProjects->projectId . "\" " . $sel_Project . ">" . $rProjects->projectName . "</option>";
                $p++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">

        <select name="staffId" id="staffId" class="form-control">
            <option value="" default selected>-All staff members-</option>
            <?php
            $s = 1;
            foreach ($data_get_all_staff as $rStaff) {
                $sel_Staff = (($rStaff->tbl_staffId) == ($this->input->post("staffId"))) ? 'selected' : '';
                echo "<option value=\"" . $rStaff->tbl_staffId . "\" " . $sel_Staff . ">" . $rStaff->fullNames . "</option>";
                $s++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" data-date-format="yyyy-mm-dd" name="fromDate" id="fromDate"
                   value="<?= $this->input->post("fromDate"); ?>" class="form-control" placeholder="From Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" name="toDate" id="toDate" value="<?= $this->input->post("toDate"); ?>"
                   class="form-control" placeholder="To Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search" onclick="location.href='<?= site_url('ReportsController/projectExpenditure') ?>'"/>
    <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
           value="Export to Excel" onclick="location.href='<?= site_url('ReportsController/projectExpenditure') ?>'"/>

    <?= form_close(); ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <?php foreach ($data_get_expenditure_summations as $rSumsExpenditure) {
                    $projectName=$rSumsExpenditure->projectName;
                } ?>
                <th colspan="10">Project Billing Report on Project: <?=$projectName?> up until <?=thisYear;?></th>
            </tr>

            <tr>
                <th colspan="">Project</th>
                <th>Staff Name</th>
                <th>Level of Effort (LOE)</th>
                <th colspan="4">HR Fees(UGX)</th>
                <th>Transport</th>
                <th>Stationary</th>
                <th colspan="">Others</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_project_expenditure as $rExpenditure) {
                ?>
                <tr>
                    <td><?= $n; ?></td>
                    <td><?= $rExpenditure->fullNames; ?></td>
                    <td align="right"><?= number_format(($rExpenditure->inputhours), 2); ?></td>
                    <td align="right" class="" colspan="4"
                        align="right"><?= number_format(($rExpenditure->hrfees), 2); ?></td>
                    <td align="right" class="" align="right">-</td>
                    <td align="right" class="" align="right">-</td>
                    <td align="right" class="" align="right">-</td>
                </tr>

                <?php
                $n++;
            }
            ?>
            <?php
            foreach ($data_get_expenditure_summations as $rSumsExpenditure) {


                ?>
                <tr class="" style="color:black;">
                    <td class="" colspan="2" bgcolor="#9BB7FF"><strong><i class="fa fa-star"></i> Project
                            Total:</strong></td>
                    <td class="greenColor" style="color: #03054B;" colspan="" align="right" bgcolor="#9BB7FF">
                        <strong><?= number_format($rSumsExpenditure->sumHours, 2); ?>Hr(s) </strong></td>
                    <td style="color: #9BB7FF;" colspan="4" align="right" bgcolor="#9BB7FF">
                        <strong style="color:#03054B;"><?= number_format($rSumsExpenditure->sumFees, 2); ?></strong>
                    </td>
                    <td style="color: #9BB7FF;" colspan="3" align="right" bgcolor="#9BB7FF">
                        <strong style="color:#03054B;"></strong>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







