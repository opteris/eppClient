<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <?php

            ?>
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= $staff_record[0]->fullNames; ?></a></li>
            <li class="active"><span>Edit</span></li>

        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                <legend>Edit Staff Details</legend>

                <?php
                $attributes = array("class" => "form-horizontal", "id" => "edit_staffMember", "name" => "edit_staffMember");
                echo form_open("SystemSetupController/editStaffMember/".$staff_record[0]->tbl_staffId."", $attributes); ?>

                <fieldset>
                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="fname" class="control-label">First Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="fname" name="fname" placeholder="First Name" type="text"
                                       class="form-control" value="<?=set_value('fname', strstr($staff_record[0]->fullNames, ' ', true)); ?>"/>
                                <span class="text-danger"><?=form_error('fname'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="lname" class="control-label">Last Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="lname" name="lname" placeholder="Last Name" type="text"
                                       class="form-control" value="<?=set_value('lname', substr($staff_record[0]->fullNames, strrpos($staff_record[0]->fullNames, ' ') + 1)); ?>"/>
                                <span class="text-danger"><?=form_error('lname'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="pusername" class="control-label">Preffered Username</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="pusername" name="pusername" placeholder="Preffered Username" type="text"
                                       class="form-control" value="<?=set_value('pusername', $staff_record[0]->userName); ?>"/>
                                <span class="text-danger"><?=form_error('pusername'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="pass" class="control-label">Password</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="pass" name="pass" placeholder="Password" type="password"
                                       class="form-control" value="<?=set_value('pass', substr($staff_record[0]->EncryptionHint, 6)); ?>"/>
                                <span class="text-danger"><?=form_error('pass'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="rpass" class="control-label">Repeat Password</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="rpass" name="rpass" placeholder="Repeat Password" type="password"
                                       class="form-control" value="<?=set_value('rpass', substr($staff_record[0]->EncryptionHint, 6)); ?>"/>
                                <span class="text-danger"><?=form_error('rpass'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="email" class="control-label">Email Address</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="email" name="email" placeholder="Email Address" type="text"
                                       class="form-control" value="<?=set_value('email', $staff_record[0]->email); ?>"/>
                                <span class="text-danger"><?=form_error('email'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="dob" class="control-label">Birthday</label>
                            </div>
                            <div class="col-lg-8 col-sm-8 input-group date" data-provide="datepicker">
                                <input id="dob" name="dob" placeholder="Birthday" type="text"
                                       class="form-control" value="<?=set_value('dob', $staff_record[0]->dob); ?>"/>

                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                                <span class="text-danger"><?=form_error('dob'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="country" class="control-label">Country</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "country"';
                                echo form_dropdown('country',$country, set_value('country', $staff_record[0]->country), $attributes);?>

                                <span class="text-danger"><?=form_error('country'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="gender" class="control-label">Gender</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "gender"';
                                echo form_dropdown('gender',$gender, set_value('gender', $staff_record[0]->gender), $attributes);?>

                                <span class="text-danger"><?=form_error('gender'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="designation" class="control-label">Designation</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "designation"';
                                echo form_dropdown('designation',$designation, set_value('designation', $staff_record[0]->designation), $attributes);?>

                                <span class="text-danger"><?=form_error('designation'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="ugroup" class="control-label">User Group</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "ugroup"';
                                echo form_dropdown('ugroup',$ugroup, set_value('ugroup', $staff_record[0]->groupCode), $attributes);?>

                                <span class="text-danger"><?=form_error('ugroup'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                            <input id="btn_update" name="btn_update" type="submit" class="btn btn-primary" value="Update" />
                            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel"  onclick="window.location='<?php echo site_url("SystemSetupController/staffMembers");?>'" />
                        </div>
                    </div>

                    <?= form_close(); ?>
                    <?=$this->session->flashdata('msg'); ?>
                </fieldset>

            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







