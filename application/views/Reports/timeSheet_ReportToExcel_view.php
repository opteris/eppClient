<div id="page-wrapper">
    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped" border="1" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <?php foreach ($data_get_staff_name as $rowName) {
                    $staffName = $rowName->fullNames; ?>
                    <th colspan="8">Timesheet Report
                        For: <?= $name = (!empty($staffName)) ? $staffName : 'All Team Members'; ?>
                        between <?= $from = (!empty($this->session->userdata['filter_fromDate'])) ? $this->session->userdata['filter_fromDate'] : date("Y-m-01"); ?>
                        and <?= $to = (!empty($this->session->userdata['filter_toDate'])) ? $this->session->userdata['filter_toDate'] : date("Y-m-d", strtotime("last day of")); ?></th>
                <?php } ?>
            </tr>
            <tr>
                <th>#</th>
                <th>Task Description</th>
                <th>Planned Hours</th>
                <th>Input Hours</th>
                <th>Date</th>
                <th>Status</th>
                <th>Staff Comment</th>
                <th>Supervisor Comment</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $p = 1;
            if(empty($data_get_timesheet_projects) or ($data_get_timesheet_projects=='')){
                ?>
                <div class="alert alert-danger">Timeheet Data Not Avalilable!!</div>
                <?php
            }else{
                foreach ($data_get_timesheet_projects as $rowProject) { ?>
                    <tr>
                        <td colspan="8" style="color: #29388F; font-weight: 100; font-size: larger;"><strong><i class="fa fa-dot-circle-o fa-2x"></i>
                                Project: </strong><?= $rowProject->projectName; ?></td>
                    </tr>
                    <?php
                    $m = 1;
                    foreach ($data_get_timesheet_milestones as $rowMilestone) {
                        $tbl_projectId= $rowProject->tbl_projectId;
                        $projectId = $rowMilestone->projectId;
                        if ($tbl_projectId == $projectId) { ?>
                            <tr>
                                <td colspan="8" style="color: green;"><strong><i class="fa fa-dot-circle-o"></i>
                                        Milestone: </strong> <?= $rowMilestone->milestoneName; ?></td>
                            </tr>

                            <?php
                            $a = 1;
                            foreach ($data_get_timesheet_activities as $rowActivity) {
                                $tbl_milestoneId = $rowMilestone->tbl_milestoneId;
                                $milestoneId = $rowActivity->milestone;
                                if ($tbl_milestoneId == $milestoneId) { ?>

                                    <tr>
                                        <td colspan="8" style="color: #FF3300;"><strong><i class="fa fa-space-shuttle"></i>
                                                Activity: </strong> <?= $rowActivity->activityName; ?></td>
                                    </tr>
                                    <div class="clearfix"></div>
                                    <?php
                                    $sub_a = 1;
                                    foreach ($data_get_timesheet_sub_activities as $rowSubActivity) {
                                        $tbl_activityId = $rowActivity->tbl_activityId;
                                        $activity = $rowSubActivity->activity;

                                        if ($tbl_activityId == $activity) { ?>
                                            <tr>
                                                <td colspan="8" style="color: #333333;"><strong><i class="fa fa-scissors"></i>
                                                        Sub-Activity:</strong> <?= $rowSubActivity->subActivityName; ?></td>
                                            </tr>
                                            <div class="clearfix"></div>
                                            <?php
                                            $n = 1;
                                            foreach ($data_get_timesheet as $rowTimesheet) {
                                                $subActivityId = $rowSubActivity->tbl_project_updatesId;
                                                $tbl_project_updatesId = $rowTimesheet->ProjectUpdate;
                                                if ($tbl_project_updatesId == $subActivityId) { ?>

                                                    <tr>
                                                        <td><?= $n; ?></td>
                                                        <td><?= $rowTimesheet->taskDescription; ?></td>
                                                        <td><?= $rowTimesheet->plannedHours; ?></td>
                                                        <td><?= $rowTimesheet->inputHours; ?></td>
                                                        <td><?= $rowTimesheet->timesheetDate; ?></td>
                                                        <td><?= $rowTimesheet->statusCode; ?></td>
                                                        <td><?= $rowTimesheet->comment; ?></td>
                                                        <td><?= $rowTimesheet->supervisorComment; ?></td>
                                                    </tr>
                                                    <div class="clearfix"></div>
                                                    <?php
                                                    $n++;
                                                } else {
                                                }
                                            }
                                        } else {
                                        }
                                        $sub_a++;
                                    }

                                    $a++;
                                } else {
                                }


                            }
                            $m++;
                        }else{

                        }
                    }
                    $p++;
                }
            }

            ?>
            <tr>
                <?php foreach($data_get_timesheet_summary as $rowSum){ ?>
                    <td  style="background-color: #3BAFDA; font-weight: bold;">#</td>
                    <td  style="background-color: #3BAFDA; font-weight: bold;" align="right">Total Number of Activities Reported: <?= $rowSum->sumActivities; ?></td>
                    <td  style="background-color: #3BAFDA; font-weight: bold;" align="right">Sum Planned Hours: <?= number_format($rowSum->sumPHrs,1); ?></td>
                    <td  style="background-color: #3BAFDA; font-weight: bold;" align="right">Sum Actual Hours: <?= number_format($rowSum->sumIHrs,1); ?></td>
                    <td  style="background-color: #3BAFDA; font-weight: bold;" colspan="4" ></td>
                <?php } ?>
            </tr>


            </tbody>
        </table>
        <div class="clearfix"></div>

    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







