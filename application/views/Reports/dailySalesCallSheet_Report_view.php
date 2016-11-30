<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Daily Sales Report</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_DailySalesReport", "name" => "filter_DailySalesReport");
    echo form_open("ReportsController/dailySalesCallSheet", $attributes); ?>

    <?php
    $allStaffData = '';
    $allStaffData .= '<div class="form-group">

        <select name="staffId" id="staffId" class="form-control">
            <option value="" default selected>-All staff members-</option>';


    foreach ($get_all_sales_team as $rStaff) {
        $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId'))) ? 'selected' : '';
        $allStaffData .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';

    }
    $allStaffData .= '</select>
    </div>';

    $toggleStaffFilterDisplay = (!in_array(($this->session->userdata['role_id']), array('1', '4', '8', '9', '10', '11'), true)) ? '' : $allStaffData;
    echo $toggleStaffFilterDisplay;
    ?>

    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" data-date-format="yyyy-mm-dd" name="fromDate" id="fromDate"
                   value="<?= set_value('fromDate'); ?>" class="form-control"
                   placeholder="From Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" name="toDate" id="toDate" value="<?= set_value('toDate'); ?>"
                   class="form-control" placeholder="To Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
           onclick="location.href='<?= site_url('ReportsController/dailySalesCallSheet') ?>'"/>
    <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-primary btn-outline"
           value="Export to Excel" onclick="location.href='<?= site_url('ReportsController/dailySalesCallSheet') ?>'"/>

    <?= form_close(); ?>


    <!--Start Project display-->

    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <?php foreach ($data_get_staff_name as $rowName) {
                    $staffName = $rowName->fullNames; ?>
                    <th colspan="11">Daily Sales Report
                        For: <?= $name = ($staffName == '' or ($staffName == $this->session->userdata['name'])) ? 'All Team Members' : $staffName; ?>
                        between <?= $from = (!empty($this->session->userdata['filter_fromDate'])) ? $this->session->userdata['filter_fromDate'] : date("Y-m-01"); ?>
                        and <?= $to = (!empty($this->session->userdata['filter_toDate'])) ? $this->session->userdata['filter_toDate'] : date("Y-m-d", strtotime("last day of")); ?></th>
                <?php } ?>
            </tr>
            <tr>
                <th>#</th>
                <th colspan="2">Location</th>
                <th>Call Date</th>
                <th>Client/Prospect/Co. Contact</th>
                <th>Type of Call</th>
                <th>Call Purpose</th>
                <th>Action points</th>
                <th>Call Rating</th>
                <th>Next Follow Up Date</th>
                <th>Details</th>
            </tr>
            </thead>

            <tbody>
            <?php

            if (empty($data_get_daily_sales_team) or ($data_get_daily_sales_team == '')) {
                ?>
                <div class="alert alert-danger">Sales Data Not Avalilable!!</div>
                <?php
            } else {
                foreach ($data_get_daily_sales_team as $rowProject) { ?>

                    <tr style="background-color: rgba(240, 134, 0, 0.23); font-weight: bold;">
                        <td colspan="11" style="color: #29388F; font-weight: 100; font-size: larger;"><strong><i
                                    class="fa fa-dot-circle-o fa-2x"></i>
                                Sales Executive: </strong><?= $rowProject->fullNames; ?></td>
                        <div class="clearfix"></div>
                    <tr>
                    <?php
                    $p = 1;
                    foreach ($data_get_daily_sales as $rowProjectData) {

                        if (($rowProject->fullNames == $rowProjectData->fullNames)) {

                            ?>

                            <tr>
                                <td colspan="11"
                                    style="color: rgba(16, 40, 56, 0.93); font-weight: 100; font-size: larger;">
                                    <strong><i
                                            class="fa fa-circle" aria-hidden="true"></i>
                                        Sales Call to: </strong><?= $rowProjectData->company_name; ?></td>
                                <div class="clearfix"></div>
                            <tr>
                                <td><?= $p; ?></td>
                                <td colspan="2"><?= $rowProjectData->client_location; ?></td>
                                <td><?= $rowProjectData->activity_date; ?></td>
                                <td><?= $rowProjectData->client_contact; ?></td>
                                <td><?= $rowProjectData->type_of_call; ?></td>
                                <td><?= $rowProjectData->call_purpose; ?></td>
                                <td><?= $rowProjectData->action_points; ?></td>
                                <?php
                                switch ($rowProjectData->statusCode) {
                                    case 'Cold':
                                        echo '<td id="blue">' . $rowProjectData->statusCode . '</td>';
                                        break;
                                        ?>
                                        <?php
                                    case 'Warm':
                                        echo '<td id="orange">' . $rowProjectData->statusCode . '</td>';
                                        break;
                                        ?>
                                        <?php
                                    case 'Hot':
                                        echo '<td id="red">' . $rowProjectData->statusCode . '</td>';
                                        break;
                                        ?>
                                        <?php
                                    case 'Rejected':
                                        echo '<td id="black">' . $rowProjectData->statusCode . '</td>';
                                        break;
                                        ?>
                                        <?php

                                    default:
                                        break;

                                }
                                ?>


                                <?php
                                switch ($rowProjectData->next_follow_up_date) {
                                    case $rowProjectData->next_follow_up_date < date('Y-m-d'):
                                        echo '<td id="blue">' . $rowProjectData->next_follow_up_date . '</td>';
                                        break;
                                        ?>
                                        <?php
                                    case $rowProjectData->next_follow_up_date >= date('Y-m-d'):
                                        echo '<td id="red">' . $rowProjectData->next_follow_up_date . '</td>';
                                        break;
                                        ?>
                                        <?php

                                    default:
                                        break;

                                }
                                ?>

                                <?php
                                /*start details*/

                                    $fullNames = 'Demo Full Names';
                                    $i3_name = 'Daily Sales Call Sheet: Full Details';
                                    $i3_name_modal = 'FullDetailsDailySalesCallSheet';
                                    $i3_name_formula = 'Get all Expense on projects';
                                    $i3_aria_label = 'ariaFullDetails';

                                /*end details*/
                                ?>

                                <td>
                                    <input id="details" name="details" type="submit" class="btn btn-default" value="View Details"
                                           onclick="location.href='<?= site_url('ReportsController/dailySalesCallSheetDetails') ?>'"/>
                                </td>
                            </tr>
                            <div class="clearfix"></div>

                            <?php
                        } else {
                        }
                        $p++;
                    }


                }
            }

            ?>
            <tr style="background-color: #3BAFDA; font-weight: bold;">
                <?php foreach ($data_get_daily_sales_summary as $rowSum) { ?>
                    <td>#</td>
                    <td align="right">Total Number of Calls Made: <?= $rowSum->sumCalls; ?></td>
                    <td align="right">Sum Commitment Value: <?= $rowSum->commitmentInShillings; ?></td>
                    <td align="right">Sum Action Points: <?= $rowSum->actionPoints; ?></td>
                    <td colspan="7"></td>
                <?php } ?>
            </tr>


            </tbody>
        </table>
        <div class="clearfix"></div>

    </div>
</div>
<!-- /.col-lg-wrapper (nested) -->







