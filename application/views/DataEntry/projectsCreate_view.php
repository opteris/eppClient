<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <?php

            ?>
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Add Project</span></li>

        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8 well">
                <legend>Add project details</legend>

                <?php
                $attributes = array("class" => "form-horizontal", "id" => "filter_formProjects", "name" => "filter_formProjects");
                echo form_open("DataEntryController/addProjects", $attributes); ?>

                <fieldset>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_name" class="control-label">Project Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Full Project Name..." class="form-control" id="prj_name" name="prj_name" cols="60" rows="5"><?php echo set_value('prj_name'); ?></textarea>
                                <span class="text-danger"><?= form_error('prj_name'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_acronym" class="control-label">Project Acronym</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="prj_acronym" name="prj_acronym" placeholder="Project Acronym" type="text"
                                       class="form-control" value="<?= set_value('prj_acronym'); ?>"/>
                                <span class="text-danger"><?= form_error('prj_acronym'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_category" class="control-label">Project Category</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "prj_category"';
                                echo form_dropdown('prj_category', $prj_category, set_value('prj_category'), $attributes); ?>

                                <span class="text-danger"><?= form_error('prj_category'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_version" class="control-label">Project Version</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="prj_version" name="prj_version" placeholder="Project Version" type="text"
                                       class="form-control" value="<?= set_value('prj_version'); ?>"/>
                                <span class="text-danger"><?= form_error('prj_version'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_team_leader" class="control-label">Project Team Leader</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "prj_team_leader"';
                                echo form_dropdown('prj_team_leader', $prj_team_leader, set_value('prj_team_leader'), $attributes); ?>

                                <span class="text-danger"><?= form_error('prj_team_leader'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_client_name" class="control-label">Client Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Client Name..." class="form-control" id="prj_client_name" name="prj_client_name" cols="60" rows="5"><?php echo set_value('prj_client_name'); ?></textarea>
                                <span class="text-danger"><?= form_error('prj_client_name'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="prj_specialClientDate" class="control-label">Special Client Date</label>
                            </div>

                            <div class="col-lg-4 col-sm-4">
                                <div class="input-group date"
                                     data-provide="datepicker"
                                     align="right">
                                    <input id="prj_specialClientDate" name="prj_specialClientDate"
                                           placeholder="Special Client Date"
                                           type="text"
                                           class="form-control"
                                           value="<?= set_value('prj_specialClientDate'); ?>"/>

                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <span class="text-danger"><?= form_error('prj_specialClientDate'); ?></span>
                                </div>
                            </div>


                            <div class="col-lg-4 col-sm-4">
                                <textarea placeholder="Description of Special Client Date..." class="form-control" id="prj_desc_specialClientDate" name="prj_desc_specialClientDate" cols="60" rows="5"><?php echo set_value('prj_desc_specialClientDate'); ?></textarea>
                                <span class="text-danger"><?= form_error('prj_desc_specialClientDate'); ?></span>

                            </div>
                        </div>
                    </div>



                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_client_type" class="control-label">Client Type</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">

                                    <?php
                                    $attributes = 'class = "form-control" id = "prj_client_type"';
                                    echo form_dropdown('prj_client_type', $prj_client_type, set_value('prj_client_type'), $attributes); ?>

                                    <span class="text-danger"><?= form_error('prj_client_type'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_country" class="control-label">Project Source Country</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">

                                    <?php
                                    $attributes = 'class = "form-control" id = "prj_country"';
                                    echo form_dropdown('prj_country', $prj_country, set_value('prj_country'), $attributes); ?>

                                    <span class="text-danger"><?= form_error('prj_country'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">

                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_summary" class="control-label">Project Summary</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Project Summary..." class="form-control" id="prj_summary" name="prj_summary" cols="60" rows="5"><?php echo set_value('prj_summary'); ?></textarea>
                                    <span class="text-danger"><?= form_error('prj_summary'); ?></span>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                    <label for="prj_startDate" class="control-label">Project Start Date</label>
                                </div>
                                <div class="col-lg-8 col-sm-8 input-group date"
                                     data-provide="datepicker"
                                     align="right">
                                    <input id="prj_startDate" name="prj_startDate"
                                           placeholder="Project Start Date"
                                           type="text"
                                           class="form-control"
                                           value="<?= set_value('prj_startDate'); ?>"/>

                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <span class="text-danger"><?= form_error('prj_startDate'); ?></span>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                    <label for="prj_endDate" class="control-label">Project End Date</label>
                                </div>
                                <div class="col-lg-8 col-sm-8 input-group date"
                                     data-provide="datepicker"
                                     align="right">
                                    <input id="prj_endDate" name="prj_endDate"
                                           placeholder="Project End Date"
                                           type="text"
                                           class="form-control"
                                           value="<?= set_value('prj_endDate'); ?>"/>

                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                    <span class="text-danger"><?= form_error('prj_endDate'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">

                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_amount" class="control-label">Project Amount</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <input id="prj_amount" name="prj_amount" placeholder="Project Amount" type="text"
                                           class="form-control" value="<?= set_value('prj_amount'); ?>"/>
                                    <span class="text-danger"><?= form_error('prj_amount'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_currency" class="control-label">Project Amount Currency</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">

                                    <?php
                                    $attributes = 'class = "form-control" id = "prj_currency"';
                                    echo form_dropdown('prj_currency', $prj_currency, set_value('prj_currency'), $attributes); ?>

                                    <span class="text-danger"><?= form_error('prj_currency'); ?></span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row colbox">

                                <div class="col-lg-4 col-sm-4">
                                    <label for="pass" class="control-label">Client Contact Person</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                    <input id="prj_client_contact" name="prj_client_contact" placeholder="Client Contact Person" type="text"
                                           class="form-control" value="<?= set_value('prj_client_contact'); ?>"/>
                                    <span class="text-danger"><?= form_error('prj_client_contact'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">

                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_client_contact_address" class="control-label">Client Contact Address</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Client Contact Address..." class="form-control" id="prj_client_contact_address" name="prj_client_contact_address" cols="60" rows="5"><?php echo set_value('prj_client_contact_address'); ?></textarea>
                                    <span class="text-danger"><?= form_error('prj_client_contact_address'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_platform" class="control-label">Primary Implementation Platform</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">

                                    <?php
                                    $attributes = 'class = "form-control" id = "prj_platform"';
                                    echo form_dropdown('prj_platform', $prj_platform, set_value('prj_platform'), $attributes); ?>

                                    <span class="text-danger"><?= form_error('prj_platform'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row colbox">
                                <div class="col-lg-4 col-sm-4">
                                    <label for="prj_status" class="control-label">Project Status</label>
                                </div>
                                <div class="col-lg-8 col-sm-8">

                                    <?php
                                    $attributes = 'class = "form-control" id = "prj_status"';
                                    echo form_dropdown('prj_status', $prj_status, set_value('prj_status'), $attributes); ?>

                                    <span class="text-danger"><?= form_error('prj_status'); ?></span>
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary"
                                       value="Insert"/>
                                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger"
                                       value="Cancel"
                                       onclick="location.href='<?= base_url('DataEntry/projects_view') ?>'"/>
                            </div>
                        </div>

                </fieldset>

            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







