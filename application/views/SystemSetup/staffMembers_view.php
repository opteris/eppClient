<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View Staff Members</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_HoursWorked", "name" => "filter_HoursWorked");
    echo form_open("SystemSetupController/staffMembers", $attributes); ?>


    <div class="col-sm-6" align="left">
        <div class="form-group">

            <select name="staffId" id="staffId"  class="form-control">
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
               onclick="location.href='<?= site_url('SystemSetupController/staffMembers') ?>'" />
        <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
               value="Export to Excel" onclick="location.href='<?= site_url('SystemSetupController/staffMembers') ?>'"/>
    </div>
    <div class="col-sm-6" align="right">
        <input id="addUsers" name="addUsers" type="submit" class="btn btn-info" value="Add Users"
               onclick="location.href='<?= base_url('SystemSetupController/addStaffMembers') ?>'"/>

    </div>





    <?= form_close(); ?>

    <?php
    if ($this->session->flashdata('msg') != ''):
        echo $this->session->flashdata('msg');
    endif; ?>

    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr>
                <th colspan="11">ORS User Profiles</th>
            </tr>

            <tr>
                <th colspan="2">NO</th>
                <th colspan="4">NAME</th>
                <th>USERNAME</th>
                <th>USER GROUP</th>
                <th>DESIGNATION</th>
                <th>EMAIL</th>
                <th>CREDENTIAL STATUS</th>
                <th colspan="2">MODIFY</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_all_staff as $rowStaff) {
                ?>
                <tr id="delete_link_<?= $rowStaff->tbl_staffId; ?>">
                    <td>
                        <input name="loopkey[]" id="loopkey" value="1" type="hidden">
                        <input name="tbl_staffId[]" id="tbl_staffId" value="<?= $rowStaff->tbl_staffId; ?>"
                               type="checkbox">
                    </td>
                    <td><?= $n; ?></td>
                    <td colspan="4"><?= $rowStaff->fullNames; ?></td>
                    <td><?= $rowStaff->userName; ?></td>
                    <td><?= $rowStaff->groupName; ?></td>
                    <td><?= $rowStaff->name; ?></td>
                    <td colspan=""><?= $rowStaff->email; ?></td>
                    <?php
                    if (($rowStaff->emailStatus) != 'Sent') {
                        $data = '<td colspan=""><input class="sendCredentialsMail" name="sendmail" value="Send Credentials" onclick="window.location=\''. site_url("SystemSetupController/send_email/".$rowStaff->tbl_staffId."").'\'"  class="green_field" type="button"></td>';
                    } else {
                        $data = '<td colspan=""><i class="fa fa-check" style="color:green"></i> Sent</td>';
                    }

                    echo $data;
                    ?>
                    <td colspan="2">
                    <span class="btn-group">
                    <a class="btn btn-medium confirmbutton" onclick="window.location='<?php echo site_url("SystemSetupController/editStaffMember/".$rowStaff->tbl_staffId."");?>'"><i class="fa fa-edit"></i>
                        </i></a>
                    </span>


                    <span class="btn-group">
                    <a class="btn btn-medium confirmbutton" onclick="ConfirmStaffDelete('<?= $rowStaff->tbl_staffId; ?>')">



                        <i class="fa fa-trash"></i>
                        </i></a>
                    </span>
                    </td>

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







