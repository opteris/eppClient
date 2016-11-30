<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active"><span>Days Worked Report</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_HoursWorked", "name" => "filter_HoursWorked");
    echo form_open("ReportsController/hoursWorked", $attributes); ?>
    <div class="form-group">

        <select name="projectId" id="projectId" class="form-control">
            <option value="" default selected>-All Projects-</option>
            <?php
            $p = 1;
            foreach ($data_get_all_projects as $rProjects) {
                $sel_Project = (($rProjects->projectId) == ($this->session->userdata['filter_DW_projectId'])) ? 'selected' : '';
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
                $sel_Staff = (($rStaff->tbl_staffId) == ($this->session->userdata['filter_DW_staffId'])) ? 'selected' : '';
                echo "<option value=\"" . $rStaff->tbl_staffId . "\" " . $sel_Staff . ">" . $rStaff->fullNames . "</option>";
                $s++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" data-date-format="yyyy-mm-dd" name="fromDate" id="fromDate"
                   value="<?= $this->session->userdata['filter_DW_fromDate']; ?>" class="form-control" placeholder="From Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" name="toDate" id="toDate" value="<?= $this->session->userdata['filter_DW_toDate']; ?>"
                   class="form-control" placeholder="To Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search" onclick="location.href='<?= site_url('ReportsController/hoursWorked') ?>'" />
    <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
           value="Export to Excel" onclick="location.href='<?= site_url('ReportsController/hoursWorked') ?>'"/>

    <?= form_close(); ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="40">
                    <?php
                    foreach ($data_get_all_monthly_effort_in_hours as $rHeader) {

                        $whoWoked = ($this->session->userdata['filter_DW_staffId']=='' or empty($this->session->userdata['filter_DW_staffId'])) ?'All Staff': $rHeader->fullNames;
                        $whichProject = ($this->session->userdata['filter_DW_projectId']=='' or empty($this->session->userdata['filter_DW_projectId'])) ?'All Projects': $rHeader->projectName;
                        $whichPeriod = ($this->session->userdata['filter_DW_fromDate']=='' && $this->session->userdata['filter_DW_toDate']=='') ?thisYear:'From: '.$this->session->userdata['filter_DW_fromDate'].' To: '.$this->session->userdata['filter_DW_toDate'].'';
                    }
                    echo "Days Worked by " . $whoWoked . " on " . $whichProject . " " . $whichPeriod . "";
                    ?>

                </th>
            </tr>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Department</th>
                <th rowspan="2">Designation</th>
                <th rowspan="2">Staff Name</th>

                <th colspan="3">Jan</th>
                <th colspan="3">Feb</th>
                <th colspan="3">Mar</th>
                <th colspan="3">Apr</th>
                <th colspan="3">May</th>
                <th colspan="3">Jun</th>
                <th colspan="3">Jul</th>
                <th colspan="3">Aug</th>
                <th colspan="3">Sep</th>
                <th colspan="3">Oct</th>
                <th colspan="3">Nov</th>
                <th colspan="3">Dec</th>

            </tr>
            <tr>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
                <th>T</th>
                <th>A</th>
                <th>%</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            if(!empty($data_get_all_monthly_effort_in_hours)){
            foreach ($data_get_all_monthly_effort_in_hours as $rLoe) {

                ?>

                <tr>
                    <td><?= $n; ?></td>
                    <td><?= $rLoe->groupCode; ?></td>
                    <td><?= $rLoe->designation; ?></td>
                    <td><?= $rLoe->fullNames; ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursJan)/(8)), 2); ?></td>
                    <td align="right"><?= round((((($rLoe->HoursJan)/(8)) / (monthlyLoeTarget/8)) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursFeb)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursFeb)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursMar)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursMar)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursApr)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursApr)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursMay)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursMay)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursJun)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursJun)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursJul)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursJul)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursAug)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursAug)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursSep)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursSep)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursOct)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursOct)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursNov)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursNov)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                    <td align="right"><?= round(((monthlyLoeTarget)/8), 2); ?></td>
                    <td align="right"><?= round((($rLoe->HoursDec)/(8)), 2); ?></td>
                    <td align="right"><?= round(((((($rLoe->HoursDec)/(8))) / (((monthlyLoeTarget)/8))) * 100), 2); ?></td>

                </tr>
                <?php
                $n++;
            }

            }else{

                $data='<tr><td colspan="40">No matching Result found</td></tr>';
                echo $data;
            }
            ?>

            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







