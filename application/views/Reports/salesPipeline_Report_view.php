<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#">Home</a></li>
            <li><a href="#">Reports</a></li>
            <li class="active"><span>Sales Pipeline Report</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_HoursWorked", "name" => "filter_HoursWorked");
    echo form_open("ReportsController/hoursWorked", $attributes); ?>

    <div class="form-group">

        <select name="staffId" id="staffId" class="form-control">
            <option value="" default selected>-All Commercial team-</option>
            <?php
            $s = 1;
            foreach ($data_get_sales_all_staff as $rStaff) {
                $sel_Staff = (($rStaff->tbl_staffId) == ($this->session->userdata['filter_staffId'])) ? 'selected' : '';
                echo "<option value=\"" . $rStaff->tbl_staffId . "\" " . $sel_Staff . ">" . $rStaff->fullNames . "</option>";
                $s++;
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" data-date-format="yyyy-mm-dd" name="fromDate" id="fromDate"
                   value="<?= $this->session->userdata['filter_fromDate']; ?>" class="form-control"
                   placeholder="From Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <div class="form-group">
        <div class="input-group date" data-provide="datepicker">
            <input type="text" name="toDate" id="toDate" value="<?= $this->session->userdata['filter_toDate']; ?>"
                   class="form-control" placeholder="To Date">

            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>


    <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
           onclick="location.href='<?= site_url('ReportsController/hoursWorked') ?>'"/>
    <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-primary btn-outline"
           value="Export to Excel" onclick="location.href='<?= site_url('ReportsController/hoursWorked') ?>'"/>

    <?= form_close(); ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan='8'><?="Sales pipeline Report From: " . appendSuperpositionInteger(1) . " ".date('M').", ".date('Y')."   To: " . appendSuperpositionInteger(date('d')) . " ".date('M').", ".date('Y').""; ?></th>
            </tr>
            <tr style='color:#ffffff; background:#171433;' >
                <th rowspan='2'>#</th>
                <th rowspan='2'>Client</th>
                <th rowspan='2'>Sales Executive</th>
                <th rowspan='2'>Assignment</th>
                <th rowspan='2'>Contract Amount</th>
                <th rowspan='2'>Sale Close date</th>
                <th colspan='2'>Sale Key Dates</th>
            </tr>
            <tr style='color:#ffffff; background:#171433;'>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            </thead>
            <tbody>

            <?php


            $v = 1;
            foreach ($data_get_sales_pipe_line as $rSalesPipeline) {
                $client = $rSalesPipeline->client;
                $sales_executive = $rSalesPipeline->sales_executive;
                $assignment= $rSalesPipeline->assignment;
                $amount_quoted = $rSalesPipeline->amount_quoted;
                $date_sale_made = $rSalesPipeline->date_sale_made;
                $assignment_start_date = $rSalesPipeline->assignment_start_date;
                $assignment_end_date = $rSalesPipeline->assignment_end_date;

                ?>



            <tr>
                <td align='right'><?=$v;?></td>
                <td width='30%'><?=$client;?></td>
                <td width='30%'><?=$sales_executive;?></td>
                <td><?=$assignment;?></td>
                <td width='20%' align='right'><?=number_format($amount_quoted,2);?></td>
                <td><?=$date_sale_made;?></td>
                <td><?=$assignment_start_date;?></td>
                <td><?=$assignment_end_date;?></td>
            </tr>


                <?php
                $v++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







