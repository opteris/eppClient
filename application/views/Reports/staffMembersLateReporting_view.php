<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View Over Due timesheets</span></li>
        </ol>
    </div>
    <div class="clearfix"></div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_LateReporters", "name" => "filter_LateReporters");
    echo form_open("ReportsController/lastReported", $attributes); ?>





    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="11">ORS Over Due Reporters</th>
            </tr>

            <tr>
                <th>#</th>
                <th colspan="4">NAME</th>
                <th>USERNAME</th>
                <th>USER GROUP</th>
                <th>EMAIL</th>
                <th>LAST REPORTED</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_all_staff as $rowStaff) {
                ?>
                <tr id="delete_link_<?= $rowStaff->tbl_staffId; ?>">
                    <td><?= $n; ?>.</td>
                    <td colspan="4"><?= $rowStaff->fullNames; ?></td>
                    <td><?= $rowStaff->userName; ?></td>
                    <td><?= $rowStaff->groupName; ?></td>
                    <td colspan=""><?= $rowStaff->email; ?></td>
                    <td colspan=""><?= $rowStaff->lastReported; ?></td>
                    <td colspan=""><input class="sendReminderMail" name="sendReminderMail" value="Send Reminder"
                                                                                       onclick="window.location='<?= site_url('ReportsController/sendReminderMail/'.$rowStaff->tbl_staffId.'');?>'" class="green_field" type="button">
                    </td>



                </tr>
                <?php
                $n++;
            }
            ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<div class="clearfix"></div>
<!-- /.col-lg-wrapper (nested) -->







