<div id="page-wrapper">
        <div class="col-sm-12 table-responsive">
            <table class="table table-bordered table-hover table-striped" border="1">
                <thead>
                <tr>
                    <th colspan="40">
                        <?php
                        foreach ($data_get_all_monthly_effort_in_hours as $rHeader) {

                            $whoWoked = ($this->session->userdata['filter_staffId']=='' or empty($this->session->userdata['filter_staffId'])) ?'All Staff': $rHeader->fullNames;
                            $whichProject = ($this->session->userdata['filter_projectId']=='' or empty($this->session->userdata['filter_projectId'])) ?'All Projects': $rHeader->projectName;
                            $whichPeriod = ($this->session->userdata['filter_fromDate']=='' && $this->session->userdata['filter_toDate']=='') ?thisYear:'From: '.$this->session->userdata['filter_fromDate'].' To: '.$this->session->userdata['filter_toDate'].'';
                        }
                        echo "Hours Worked by " . $whoWoked . " on " . $whichProject . " " . $whichPeriod . "";
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
                foreach ($data_get_all_monthly_effort_in_hours as $rLoe) {

                    ?>

                    <tr>
                        <td><?= $n; ?></td>
                        <td><?= $rLoe->groupCode; ?></td>
                        <td><?= $rLoe->designation; ?></td>
                        <td><?= $rLoe->fullNames; ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursJan, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursJan) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursFeb, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursFeb) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursMar, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursMar) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursApr, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursApr) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursMay, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursMay) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursJun, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursJun) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursJul, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursJul) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursAug, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursAug) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursSep, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursSep) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursOct, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursOct) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursNov, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursNov) / (monthlyLoeTarget)) * 100), 2); ?></td>

                        <td align="right"><?= round(monthlyLoeTarget, 2); ?></td>
                        <td align="right"><?= round($rLoe->HoursDec, 2); ?></td>
                        <td align="right"><?= round(((($rLoe->HoursDec) / (monthlyLoeTarget)) * 100), 2); ?></td>

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







