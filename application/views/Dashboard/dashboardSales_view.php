<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/9/2016
 * Time: 7:11 PM
 */
?>
<div id="page-wrapper">

    <!--start brief row-->
    <div class="row">

        <!--start number of partners-->
        <div class="col-sm-3 dashboard-panel">
            <div class="panel panel-blue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php
                            foreach ($data_get_i1_Traders as $rows) {
                                $Traders = $rows->numTraders;
                            }
                            foreach ($data_get_i1_Exporters as $rows) {
                                $Exporters = $rows->numExporters;
                            }
                            $numPartners = ($Traders + $Exporters);
                            /*start details*/
                            foreach ($data_get_i1_Details as $rows) {
                                $i1_name = $rows->indicator_name;
                                $i1_name_modal = $rows->indicator_modal_name;
                                $i1_name_formula = $rows->indicator_formula;
                                $i1_aria_label = $rows->indicator_aria_label;
                            }
                            /*end details*/
                            ?>
                            <div class="huge"><?= number_format($numPartners); ?></div>
                            <div><?= $i1_name; ?></div>
                        </div>
                    </div>
                </div>


                <div class="panel-footer">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                            data-toggle="modal" data-target="#<?= $i1_name_modal; ?>">
                        View Details
                        <span class="pull-left"></span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </button>

                    <!--Start Partners Modal -->
                    <div class="modal fade " id="<?= $i1_name_modal; ?>" tabindex="-1" role="dialog"
                         aria-labelledby="<?= $i1_aria_label; ?>"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="<?= $i1_aria_label; ?>"><?= $i1_name; ?></h4>
                                </div>
                                <div class="tabbable">
                                    <div class="modal-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#1" data-toggle="tab">Data Sources</a></li>
                                            <li><a href="#2" data-toggle="tab">Reports</a></li>

                                        </ul>

                                        <!--Start Tab panes -->
                                        <div class="tab-content">
                                            <!--start pane on data-sources-->
                                            <div class="tab-pane active" id="1">
                                                <div class="clearfix"></div>
                                                <h5 class="text-center"><b><?= $i1_name; ?></b> =
                                                    (<?= $i1_name_formula; ?>)</h5>
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
                                                    foreach ($data_get_i1_DS as $rows) {
                                                        $i1_ds_name = $rows->datasource_name;
                                                        $i1_ds_link = $rows->datasource_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i1_ds_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i1_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i1_ds_name; ?> :Data</a></td>

                                                            <!--display the correct figures-->
                                                            <?php
                                                            switch ($i1_ds_name) {
                                                                case 'Form3 Exporters':
                                                                    $value = number_format($Exporters);
                                                                    break;
                                                                case 'Form4 Traders':
                                                                    $value = number_format($Traders);
                                                                    break;
                                                                default:
                                                                    break;
                                                            }
                                                            $data = '<td class="text-right">' . $value . '</td>';
                                                            echo $data;
                                                            ?>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end dataSources*/
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end pane on data sources-->

                                            <!--start of pane on reports-->
                                            <div class="tab-pane" id="2">
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
                                                    foreach ($data_get_i1_RP as $rows) {
                                                        $i1_rp_name = $rows->report_name;
                                                        $i1_rp_link = $rows->report_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i1_rp_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i1_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i1_rp_name; ?> :</a>
                                                            </td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end Reports*/
                                                    ?>
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
                    <!--End Partners Modal -->
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
        <!--end number of partners-->

        <!--start value of partnerships-->
        <div class="col-sm-3 dashboard-panel">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-usd fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php
                            foreach ($data_get_i2_Partnerships as $rows) {
                                $valuePartnerships = ($rows->valuePartnerships / cpma_dollar_rate);
                            }

                            /*start details*/
                            foreach ($data_get_i2_Details as $rows) {
                                $i2_name = $rows->indicator_name;
                                $i2_name_modal = $rows->indicator_modal_name;
                                $i2_name_formula = $rows->indicator_formula;
                                $i2_aria_label = $rows->indicator_aria_label;
                            }
                            /*end details*/
                            ?>
                            <div class="huge"><?= number_format($valuePartnerships, 1, '.', ',') . ' USD'; ?></div>
                            <div><?= $i2_name; ?></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                            data-toggle="modal" data-target="#<?= $i2_name_modal; ?>">
                        View Details
                        <span class="pull-left"></span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </button>

                    <!--Start partnerships Modal -->
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
                                            <li class="active"><a href="#ds_<?= $i2_name_modal; ?>" data-toggle="tab">Data
                                                    Sources</a></li>
                                            <li><a href="#rp_<?= $i2_name_modal; ?>" data-toggle="tab">Reports</a></li>

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
                                                    foreach ($data_get_i2_DS as $rows) {
                                                        $i2_ds_name = $rows->datasource_name;
                                                        $i2_ds_link = $rows->datasource_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i2_ds_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i2_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i2_ds_name; ?> :Data</a></td>
                                                            <td class="text-right"><?= number_format($valuePartnerships, 1, '.', ',') . ' USD'; ?></td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end dataSources*/
                                                    ?>
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
                                                    foreach ($data_get_i2_RP as $rows) {
                                                        $i2_rp_name = $rows->report_name;
                                                        $i2_rp_link = $rows->report_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i2_rp_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i2_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i2_rp_name; ?> :</a>
                                                            </td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end Reports*/
                                                    ?>
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
                    <!--End partnerships Modal -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--end value of partnerships-->

        <!--start volumes purchased-->
        <div class="col-sm-3 dashboard-panel">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php
                            foreach ($data_get_i3_VolumesPurchased as $rows) {
                                $val_VolumesPurchased = ($rows->volumesPurchased / 1000);
                            }
                            /*start details*/
                            foreach ($data_get_i3_Details as $rows) {
                                $i3_name = $rows->indicator_name;
                                $i3_name_modal = $rows->indicator_modal_name;
                                $i3_name_formula = $rows->indicator_formula;
                                $i3_aria_label = $rows->indicator_aria_label;
                            }
                            /*end details*/
                            ?>
                            <div
                                class="huge"><?= number_format($val_VolumesPurchased, 1, '.', ',') . ' MT'; ?></div>
                            <div><?= $i3_name; ?></div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                            data-toggle="modal" data-target="#<?= $i3_name_modal; ?>">
                        View Details
                        <span class="pull-left"></span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </button>

                    <!--Start volumes purchased Modal -->
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
                                                    foreach ($data_get_i3_DS as $rows) {
                                                        $i3_ds_name = $rows->datasource_name;
                                                        $i3_ds_link = $rows->datasource_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i3_ds_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i3_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i3_ds_name; ?> :Data</a>
                                                            </td>
                                                            <td class="text-right"><?= number_format($val_VolumesPurchased, 1, '.', ',') . ' MT'; ?></td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end dataSources*/
                                                    ?>
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
                                                    foreach ($data_get_i3_RP as $rows) {
                                                        $i3_rp_name = $rows->report_name;
                                                        $i3_rp_link = $rows->report_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i3_rp_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i3_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i3_rp_name; ?> :</a>
                                                            </td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end Reports*/
                                                    ?>
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
                    <!--End volumes purchased Modal -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--end volumes purchased-->

        <!--start volumes sold-->
        <div class="col-sm-3 dashboard-panel">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <!--<i class="fa fa-money fa-5x"></i>-->
                            <img src="<?= base_url() ?>assets/images/vol_sold.png"/>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php
                            foreach ($data_get_i4_VolumesSold as $rows) {
                                $val_VolumesSold = ($rows->volumesSold / 1000);
                            }
                            /*start details*/
                            foreach ($data_get_i4_Details as $rows) {
                                $i4_name = $rows->indicator_name;
                                $i4_name_modal = $rows->indicator_modal_name;
                                $i4_name_formula = $rows->indicator_formula;
                                $i4_aria_label = $rows->indicator_aria_label;
                            }
                            /*end details*/
                            ?>
                            <div class="huge"><?= number_format($val_VolumesSold, 1, '.', ',') . ' MT'; ?></div>
                            <div><?= $i4_name; ?></div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle"
                            data-toggle="modal" data-target="#<?= $i4_name_modal; ?>">
                        View Details
                        <span class="pull-left"></span>
                        <span><i class="fa fa-arrow-circle-right"></i></span>
                    </button>

                    <!--Start volumes sold Modal -->
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
                                                    foreach ($data_get_i4_DS as $rows) {
                                                        $i4_ds_name = $rows->datasource_name;
                                                        $i4_ds_link = $rows->datasource_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i4_ds_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i4_ds_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i4_ds_name; ?> :Data</a>
                                                            </td>
                                                            <td class="text-right"><?= number_format($val_VolumesSold, 1, '.', ',') . ' MT'; ?></td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end dataSources*/
                                                    ?>
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
                                                    foreach ($data_get_i4_RP as $rows) {
                                                        $i4_rp_name = $rows->report_name;
                                                        $i4_rp_link = $rows->report_link;

                                                        ?>

                                                        <tr>
                                                            <td><?= $i4_rp_name; ?></td>
                                                            <td>
                                                                <a onClick="location.href='<?= prep_url(oldsite_url) . $i4_rp_link; ?>&u_id=<?= $this->session->userdata['user_id']; ?>'"
                                                                   target="_blank"><?= $i4_rp_name; ?> :</a>
                                                            </td>
                                                        </tr>


                                                        <?php
                                                    }
                                                    /*end Reports*/
                                                    ?>
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
                    <!--End volumessold Modal -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!--end volumes sold-->

    </div>

    <!-- /.row -->
    <!--end brief row-->

    <!--start row-one-->
    <div class="row">

        <div class="col-lg-12 dashboard-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-pie-chart fa-fw dashboard-panel-heading"></i><strong
                        class="dashboard-panel-heading"> Sales Pipeline</strong>

                    <div class="pull-right">
                        <div class="btn-group">

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="graph-canvas-slaes" id="salesGraph"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
    <!--end row one-->

</div>
<!-- /#page-wrapper -->
