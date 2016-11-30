<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View System Logins</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_systemLogins", "name" => "filter_systemLogins");
    echo form_open("SystemSetupController/systemLogins", $attributes); ?>


    <div class="col-sm-6" align="left">
        <div class="form-group">

            <select name="staffId" id="staffId" class="form-control">
                <option value="" default selected>-All staff members-</option>
                <?php
                $s = 1;
                foreach ($data_get_all_staff as $rStaff) {
                    $sel_Staff = (($rStaff->tbl_staffId) == ($this->session->userdata['filter_staffId'])) ? 'selected' : '';
                    echo "<option value=\"" . $rStaff->tbl_staffId . "\" " . $sel_Staff . ">" . $rStaff->fullNames . "</option>";
                    $s++;
                }
                ?>
            </select>
        </div>
        <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
               onclick="location.href='<?= site_url('SystemSetupController/systemLogins') ?>'"/>
        <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
               value="Export to Excel" onclick="location.href='<?= site_url('SystemSetupController/systemLogins') ?>'"/>
    </div>





    <?= form_close(); ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="11">User Details</th>
            </tr>

            <tr>
                <th>#</th>
                <th>LOG ID</th>
                <th>NAME</th>
                <th>Account</th>
                <th>User email</th>
                <th>Gender</th>
                <th>User Role</th>
                <th>Designation</th>
                <th>Time</th>
                <th>Ip Address</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_all_logs as $rowLog) {
                ?>
                <tr>
                    <td><?= $n; ?></td>
                    <td><?= $rowLog->login_id; ?></td>
                    <td><?= $rowLog->fullNames; ?></td>
                    <td><?= $rowLog->userName; ?></td>
                    <td><?= $rowLog->email; ?></td>
                    <td><?= $rowLog->gender; ?></td>
                    <td><?= $rowLog->role; ?></td>
                    <td><?= $rowLog->designation; ?></td>
                    <td><?= $rowLog->time; ?></td>
                    <td><?= $rowLog->ip_address; ?></td>
                </tr>
                <?php
                $n++;
            }
            ?>
            </tbody>
        </table>
        <div class="col-md-12 text-left">
            <?= $pagination; ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







