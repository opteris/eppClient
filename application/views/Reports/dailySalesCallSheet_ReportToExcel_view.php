<div id="page-wrapper">
    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped" border="1" cellpadding="1" cellspacing="1">
            <thead>
            <tr>
                <?php foreach ($data_get_staff_name as $rowName) {
                    $staffName = $rowName->fullNames; ?>
                    <th colspan="11">Daily Sales Report
                        For: <?= $name = ($staffName=='' or ($staffName==$this->session->userdata['name'])) ? 'All Team Members' : $staffName; ?>
                        between <?= $from = (!empty($this->session->userdata['filter_fromDate'])) ? $this->session->userdata['filter_fromDate'] : date("Y-m-01"); ?>
                        and <?= $to = (!empty($this->session->userdata['filter_toDate'])) ? $this->session->userdata['filter_toDate'] : date("Y-m-d", strtotime("last day of")); ?></th>
                <?php } ?>
            </tr>
            <tr>
                <th>#</th>
                <th colspan="2">Location</th>
                <th>Staff Name</th>
                <th>Call Date</th>
                <th>Client/Prospect/Co. Contact</th>
                <th>Type of Call</th>
                <th>Call Purpose</th>
                <th>Action points</th>
                <th>Call Rating</th>
                <th>Next Follow Up Date</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $p = 1;
            if (empty($data_get_daily_sales) or ($data_get_daily_sales == '')) {
                ?>
                <div class="alert alert-danger">Sales Data Not Avalilable!!</div>
                <?php
            } else {
                foreach ($data_get_daily_sales as $rowProject) { ?>
                    <tr>
                        <td colspan="11" style="color: #29388F; font-weight: 100; font-size: larger;"><strong><i
                                    class="fa fa-dot-circle-o fa-2x"></i>
                                Sales Call to: </strong><?= $rowProject->company_name; ?></td>
                        <div class="clearfix"></div>
                    <tr>
                        <td><?= $p; ?></td>
                        <td colspan="2"><?= $rowProject->client_location; ?></td>
                        <td><?= $rowProject->fullNames; ?></td>
                        <td><?= $rowProject->activity_date; ?></td>
                        <td><?= $rowProject->client_contact; ?></td>
                        <td><?= $rowProject->type_of_call; ?></td>
                        <td><?= $rowProject->call_purpose; ?></td>
                        <td><?= $rowProject->action_points; ?></td>
                        <?php
                        switch($rowProject->statusCode){
                            case 'Cold':
                                echo'<td id="blue">'.$rowProject->statusCode.'</td>';
                                break;
                                ?>
                                <?php
                            case 'Warm':
                                echo'<td id="orange">'.$rowProject->statusCode.'</td>';
                                break;
                                ?>
                                <?php
                            case 'Hot':
                                echo'<td id="green">'.$rowProject->statusCode.'</td>';
                                break;
                                ?>
                                <?php
                            case 'Rejected':
                                echo'<td id="red">'.$rowProject->statusCode.'</td>';
                                break;
                                ?>
                                <?php

                            default:
                                break;

                        }
                        ?>


                        <?php
                        switch($rowProject->next_follow_up_date){
                            case $rowProject->next_follow_up_date<date('Y-m-d'):
                                echo'<td id="blue">'.$rowProject->next_follow_up_date.'</td>';
                                break;
                                ?>
                                <?php
                            case $rowProject->next_follow_up_date>=date('Y-m-d'):
                                echo'<td id="red">'.$rowProject->next_follow_up_date.'</td>';
                                break;
                                ?>
                                <?php

                            default:
                                break;

                        }
                        ?>
                    </tr>
                    <div class="clearfix"></div>
                    <?php

                    $p++;
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
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







