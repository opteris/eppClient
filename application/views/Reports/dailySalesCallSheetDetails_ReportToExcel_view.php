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
                <th >#</th>
                <th >Location</th>
                <th >Date of sales Call</th>
                <th >Key Decision Maker in the Company</th>
                <th >Product of client interest</th>
                <th >Is the client using an existing product from a competitor </th>
                <th >Name of Competitor Product</th>
                <th >Is the client already using a Data Care Product</th>
                <th >Name of Data Care Product</th>
                <th >Client Contact</th>
                <th >Type of Call</th>
                <th >Any Commitment from the client(By Value  in UGX)</th>
                <th >Comments</th>
                <th >Purpose of Call</th>
                <th >Opening Conversation</th>
                <th >Sales Story</th>
                <th >Benefits to customer</th>
                <th >Objections or resistance  response</th>
                <th >Closing Remarks</th>
                <th >Key Action Points</th>
                <th >Special Client Date</th>
                <th >Description of Special Client Date</th>
                <th >Rate this Sale Prospect</th>
                <th >Next follow up date</th>
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
                        <td colspan="24" style="color: #29388F; font-weight: 100; font-size: larger;"><strong><i
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
                                <td colspan="24"
                                    style="color: rgba(16, 40, 56, 0.93); font-weight: 100; font-size: larger;">
                                    <strong><i
                                            class="fa fa-circle" aria-hidden="true"></i>
                                        Sales Call to: </strong><?= $rowProjectData->company_name; ?></td>
                                <div class="clearfix"></div>
                            <tr>
                                <td><?= $p; ?></td>
                                <td><?= $rowProjectData->client_location; ?></td>
                                <td><?= $rowProjectData->activity_date; ?></td>
                                <td><?= $rowProjectData->key_decision_maker; ?></td>
                                <td><?= $rowProjectData->productOfInterest; ?></td>
                                <td><?= $rowProjectData->client_using_competitor_product; ?></td>
                                <td><?= $rowProjectData->desc_competitor_product; ?></td>
                                <td><?= $rowProjectData->client_already_using_our_product; ?></td>
                                <td><?= $rowProjectData->desc_inhouse_product; ?></td>
                                <td><?= $rowProjectData->client_contact; ?></td>
                                <td><?= $rowProjectData->type_of_call; ?></td>
                                <td><?= $rowProjectData->client_commitment; ?></td>
                                <td><?= $rowProjectData->call_comment; ?></td>
                                <td><?= $rowProjectData->call_purpose; ?></td>
                                <td><?= $rowProjectData->call_opening_conversation; ?></td>
                                <td><?= $rowProjectData->call_sales_story; ?></td>
                                <td><?= $rowProjectData->benefits_to_customer; ?></td>
                                <td><?= $rowProjectData->objections_response; ?></td>
                                <td><?= $rowProjectData->closing_remarks; ?></td>
                                <td><?= $rowProjectData->action_points; ?></td>
                                <td><?= $rowProjectData->special_client_date; ?></td>
                                <td><?= $rowProjectData->desc_special_client_date; ?></td>
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
                    <td colspan="5" align="right">Total Number of Calls Made: <?= $rowSum->sumCalls; ?></td>
                    <td colspan="5" align="right">Sum Commitment Value: <?= $rowSum->commitmentInShillings; ?></td>
                    <td colspan="5" align="right">Sum Action Points: <?= $rowSum->actionPoints; ?></td>
                    <td colspan="5"></td>
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







