<div id="page-wrapper">

    <!--start row-one-->
    <div class="row">
        <div class="col-lg-4 dashboard-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /*start details*/

                    foreach ($get_highest_monthly_single_user_loe as $rHighest) {
                    $fullNames = $rHighest->fullNames;


                        $i5_name = 'PERCENTAGE LOE in '.thisMonth.'-'.thisYear.'';
                        $i5_name_modal = 'HoursWorkedReportModal';
                        $i5_name_formula = '(InputHoursOfStaffMember divide by AllInputHoursOfStaffMembers )*100';
                        $i5_aria_label = 'ariaOne';
                    }
                    /*end details*/
                    ?>
                    <i class="fa fa-bar-chart-o fa-fw dashboard-panel-heading"></i><strong
                        class="dashboard-panel-heading"> <?= $i5_name; ?></strong>

                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                    data-toggle="modal" data-target="#<?= $i5_name_modal; ?>">
                                View Details
                                <span class="caret"></span>
                            </button>
                            <!--Start MONTHLY PERCENTAGE LOE Modal -->
                            <div class="modal fade " id="<?= $i5_name_modal; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="<?= $i5_aria_label; ?>"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="<?= $i5_aria_label; ?>"><?= $i5_name; ?></h4>
                                        </div>
                                        <div class="tabbable">
                                            <div class="modal-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#ds_<?= $i5_name_modal; ?>"
                                                                          data-toggle="tab">Data Sources</a></li>
                                                    <li><a href="#rp_<?= $i5_name_modal; ?>" data-toggle="tab">Reports</a>
                                                    </li>

                                                </ul>

                                                <!--Start Tab panes -->
                                                <div class="tab-content">
                                                    <!--start pane on data-sources-->
                                                    <div class="tab-pane active" id="ds_<?= $i5_name_modal; ?>">
                                                        <div class="clearfix"></div>
                                                        <h5 class="text-center"><b><?= $i5_name; ?></b> =
                                                            (<?= $i5_name_formula; ?>)</h5>
                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Data Source</th>
                                                                <th>Data Link</th>
                                                                <th class="text-right">Values</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start dataSources*/
                                                                $i5_ds_name = 'ds_name';
                                                                $i5_ds_link = 'ds_link';

                                                                ?>

                                                                <tr>
                                                                    <td><?= $i5_ds_name; ?></td>
                                                                    <td>
                                                                        <a onClick="location.href='<?= prep_url(oldsite_url) . $i5_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                           target="_blank"><?= $i5_ds_name; ?> :Data</a>
                                                                    </td>
                                                                    <td class="text-right">n/a</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end pane on data sources-->

                                                    <!--start of pane on reports-->
                                                    <div class="tab-pane" id="rp_<?= $i5_name_modal; ?>">
                                                        <div class="clearfix"></div>
                                                       
                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Report Name</th>
                                                                <th>Report Link</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start Reports*/

                                                                $i5_rp_name = 'Hours Worked Report';
                                                                $i5_rp_link = 'HoursWorkedReportLink';

                                                                ?>

                                                                <tr>
                                                                    <td><?= $i5_rp_name; ?></td>
                                                                    <td>
                                                                        <a onClick="location.href='<?= prep_url(oldsite_url) . $i5_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                           target="_blank"><?= $i5_rp_name; ?> :</a>
                                                                    </td>
                                                                </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end of pane on reports-->

                                                </div>
                                                <!--end of tab panes-->
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Farmers Trained Modal -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="graph-canvas" id="staffReporting"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-4 -->

        <div class="col-lg-4 dashboard-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /*start details*/

                    foreach ($get_highest_monthly_single_user_loe as $rHighest) {
                        $fullNames = $rHighest->fullNames;


                        $i2_name = 'Annual LOE Across all Projects -'.thisYear.'';
                        $i2_name_modal = 'AnnualLoeAcrossAllProjectsModal';
                        $i2_name_formula = 'Count All inputhours for All projects From All Staff';
                        $i2_aria_label = 'ariaTwo';
                    }
                    /*end details*/
                    ?>
                    <i class="fa fa-bar-chart-o fa-fw dashboard-panel-heading"></i><strong
                        class="dashboard-panel-heading"> <?= $i2_name; ?></strong>

                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                    data-toggle="modal" data-target="#<?= $i2_name_modal; ?>">
                                View Details
                                <span class="caret"></span>
                            </button>
                            <!--AnnualLoe Across All Projects Modal -->
                            <div class="modal fade " id="<?= $i2_name_modal; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="<?= $i2_aria_label; ?>"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="<?= $i2_aria_label; ?>"><?= $i2_name; ?></h4>
                                        </div>
                                        <div class="tabbable">
                                            <div class="modal-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#ds_<?= $i2_name_modal; ?>"
                                                                          data-toggle="tab">Data Sources</a></li>
                                                    <li><a href="#rp_<?= $i2_name_modal; ?>" data-toggle="tab">Reports</a>
                                                    </li>

                                                </ul>

                                                <!--Start Tab panes -->
                                                <div class="tab-content">
                                                    <!--start pane on data-sources-->
                                                    <div class="tab-pane active" id="ds_<?= $i2_name_modal; ?>">
                                                        <div class="clearfix"></div>
                                                        <h5 class="text-center"><b><?= $i2_name; ?></b> =
                                                            (<?= $i2_name_formula; ?>)</h5>
                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Data Source</th>
                                                                <th>Data Link</th>
                                                                <th class="text-right">Values</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start dataSources*/
                                                            $i2_ds_name = 'ds_name';
                                                            $i2_ds_link = 'ds_link';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i2_ds_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i2_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i2_ds_name; ?> :Data</a>
                                                                </td>
                                                                <td class="text-right">n/a</td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end pane on data sources-->

                                                    <!--start of pane on reports-->
                                                    <div class="tab-pane" id="rp_<?= $i2_name_modal; ?>">
                                                        <div class="clearfix"></div>

                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Report Name</th>
                                                                <th>Report Link</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start Reports*/

                                                            $i2_rp_name = 'MONTHLY PERCENTAGE LOE ';
                                                            $i2_rp_link = 'HoursWorkedReportLink';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i2_rp_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i2_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i2_rp_name; ?> :</a>
                                                                </td>
                                                            </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end of pane on reports-->

                                                </div>
                                                <!--end of tab panes-->
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Farmers Trained Modal -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="graph-canvas" id="annualLoe"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-4 -->


    </div>
    <!-- /.row -->
    <!--end row one-->

    <!--start row-Two-->
    <div class="row">
        <!--start top least five   loe consuming projects-->
        <div class="col-lg-4 dashboard-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /*start details*/

                    foreach ($get_highest_monthly_single_user_loe as $rHighest) {
                        $fullNames = $rHighest->fullNames;


                        $i4_name = 'Top Five Least LOE Consumming PROJECTS';
                        $i4_name_modal = 'TopFiveHighestLoeConsummingProjects';
                        $i4_name_formula = '(InputHoursOfStaffMember divide by AllInputHoursOfStaffMembers )*100';
                        $i4_aria_label = 'ariaOne';
                    }
                    /*end details*/
                    ?>
                    <i class="fa fa-bar-chart-o fa-fw dashboard-panel-heading"></i><strong
                        class="dashboard-panel-heading"> <?= $i4_name; ?></strong>

                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                    data-toggle="modal" data-target="#<?= $i4_name_modal; ?>">
                                View Details
                                <span class="caret"></span>
                            </button>
                            <!--Start Farmers Trained Modal -->
                            <div class="modal fade " id="<?= $i4_name_modal; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="<?= $i4_aria_label; ?>"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="<?= $i4_aria_label; ?>"><?= $i4_name; ?></h4>
                                        </div>
                                        <div class="tabbable">
                                            <div class="modal-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#ds_<?= $i4_name_modal; ?>"
                                                                          data-toggle="tab">Data Sources</a></li>
                                                    <li><a href="#rp_<?= $i4_name_modal; ?>" data-toggle="tab">Reports</a>
                                                    </li>

                                                </ul>

                                                <!--Start Tab panes -->
                                                <div class="tab-content">
                                                    <!--start pane on data-sources-->
                                                    <div class="tab-pane active" id="ds_<?= $i4_name_modal; ?>">
                                                        <div class="clearfix"></div>
                                                        <h5 class="text-center"><b><?= $i4_name; ?></b> =
                                                            (<?= $i4_name_formula; ?>)</h5>
                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Data Source</th>
                                                                <th>Data Link</th>
                                                                <th class="text-right">Values</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start dataSources*/
                                                            $i4_ds_name = 'ds_name';
                                                            $i4_ds_link = 'ds_link';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i4_ds_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i4_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i4_ds_name; ?> :Data</a>
                                                                </td>
                                                                <td class="text-right">n/a</td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end pane on data sources-->

                                                    <!--start of pane on reports-->
                                                    <div class="tab-pane" id="rp_<?= $i4_name_modal; ?>">
                                                        <div class="clearfix"></div>

                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Report Name</th>
                                                                <th>Report Link</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start Reports*/

                                                            $i4_rp_name = 'Hours Worked Report';
                                                            $i4_rp_link = 'HoursWorkedReportLink';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i4_rp_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i4_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i4_rp_name; ?> :</a>
                                                                </td>
                                                            </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end of pane on reports-->

                                                </div>
                                                <!--end of tab panes-->
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Farmers Trained Modal -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="graph-canvas" id="topFiveCostlyProjects"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!--end top five highest loe consuming projects-->

        <!--start highest  five consuming LOE projects-->
        <div class="col-lg-4 dashboard-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    /*start details*/

                    foreach ($get_highest_monthly_single_user_loe as $rHighest) {
                        $fullNames = $rHighest->fullNames;


                        $i3_name = 'Top FIVE Highest LOE consumming Projects';
                        $i3_name_modal = 'TopFiveLowestLoeProjects';
                        $i3_name_formula = 'Get all Expense on projects';
                        $i3_aria_label = 'ariaThree';
                    }
                    /*end details*/
                    ?>
                    <i class="fa fa-bar-chart-o fa-fw dashboard-panel-heading"></i><strong
                        class="dashboard-panel-heading"> <?= $i3_name; ?></strong>

                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                                    data-toggle="modal" data-target="#<?= $i3_name_modal; ?>">
                                View Details
                                <span class="caret"></span>
                            </button>
                            <!--AnnualLoe Across All Projects Modal -->
                            <div class="modal fade " id="<?= $i3_name_modal; ?>" tabindex="-1" role="dialog"
                                 aria-labelledby="<?= $i3_aria_label; ?>"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="<?= $i3_aria_label; ?>"><?= $i3_name; ?></h4>
                                        </div>
                                        <div class="tabbable">
                                            <div class="modal-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#ds_<?= $i3_name_modal; ?>"
                                                                          data-toggle="tab">Data Sources</a></li>
                                                    <li><a href="#rp_<?= $i3_name_modal; ?>" data-toggle="tab">Reports</a>
                                                    </li>

                                                </ul>

                                                <!--Start Tab panes -->
                                                <div class="tab-content">
                                                    <!--start pane on data-sources-->
                                                    <div class="tab-pane active" id="ds_<?= $i3_name_modal; ?>">
                                                        <div class="clearfix"></div>
                                                        <h5 class="text-center"><b><?= $i3_name; ?></b> =
                                                            (<?= $i3_name_formula; ?>)</h5>
                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Data Source</th>
                                                                <th>Data Link</th>
                                                                <th class="text-right">Values</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start dataSources*/
                                                            $i3_ds_name = 'ds_name';
                                                            $i3_ds_link = 'ds_link';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i3_ds_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i3_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i3_ds_name; ?> :Data</a>
                                                                </td>
                                                                <td class="text-right">n/a</td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end pane on data sources-->

                                                    <!--start of pane on reports-->
                                                    <div class="tab-pane" id="rp_<?= $i3_name_modal; ?>">
                                                        <div class="clearfix"></div>

                                                        <table class="table table-striped" id="tblGrid">
                                                            <thead id="tblHead">
                                                            <tr>
                                                                <th>Report Name</th>
                                                                <th>Report Link</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                            /*start Reports*/

                                                            $i3_rp_name = 'Hours Worked Report';
                                                            $i3_rp_link = 'HoursWorkedReportLink';

                                                            ?>

                                                            <tr>
                                                                <td><?= $i3_rp_name; ?></td>
                                                                <td>
                                                                    <a onClick="location.href='<?= prep_url(oldsite_url) . $i3_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                       target="_blank"><?= $i3_rp_name; ?> :</a>
                                                                </td>
                                                            </tr>



                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--end of pane on reports-->

                                                </div>
                                                <!--end of tab panes-->
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Farmers Trained Modal -->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="graph-canvas" id="topFiveProfitableProjects"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!--start highest five consuming LOE projects-->

        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <!--end row Two-->

</div>
<!-- /#page-wrapper -->




