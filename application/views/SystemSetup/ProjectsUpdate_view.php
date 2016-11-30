<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <?php

            ?>
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#">Projects</a></li>
            <li class="active"><span>Edit Project</span></li>

        </ol>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
                <legend>Edit Project Details</legend>

                <?php
                $attributes = array("class" => "form-horizontal", "id" => "edit_projects", "name" => "edit_projects");
                echo form_open("DataEntryController/editProjects/" . $project_record[0]->tbl_projectId . "", $attributes); ?>

                <fieldset>
                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="projectName" class="control-label">Project Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea
                                    placeholder="Project Name..."
                                    class="form-control" id="projectName"
                                    name="projectName" cols="60"
                                    rows="5"><?= set_value('projectName', $project_record[0]->projectName); ?></textarea>
                                <span class="text-danger"><?= form_error('projectName'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="projectAcronym" class="control-label">Project Accronym</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="projectAcronym" name="projectAcronym" placeholder="Project Accronym"
                                       type="text"
                                       class="form-control"
                                       value="<?= set_value('projectAcronym', $project_record[0]->projectAcronym); ?>"/>
                                <span class="text-danger"><?= form_error('projectAcronym'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="RefNo" class="control-label">Reference Number</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="RefNo" name="RefNo" placeholder="Reference Number" type="text"
                                       class="form-control"
                                       value="<?= set_value('RefNo', $project_record[0]->RefNo); ?>"/>
                                <span class="text-danger"><?= form_error('RefNo'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="project_narrative" class="control-label">Project Narrative</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea
                                    placeholder="Project Narrative..."
                                    class="form-control" id="project_narrative"
                                    name="project_narrative" cols="60"
                                    rows="5"><?= set_value('project_narrative', $project_record[0]->project_narrative); ?></textarea>
                                <span class="text-danger"><?= form_error('project_narrative'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="version" class="control-label">Project version</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="version" name="version" placeholder="Project version" type="text"
                                       class="form-control"
                                       value="<?= set_value('version', $project_record[0]->version); ?>"/>
                                <span class="text-danger"><?= form_error('version'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="client" class="control-label">Name of Client</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="client" name="client" placeholder="Name of Client" type="text"
                                       class="form-control"
                                       value="<?= set_value('client', $project_record[0]->client); ?>"/>
                                <span class="text-danger"><?= form_error('client'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">

                            <div class="col-lg-4 col-sm-4">
                                <label for="client_address" class="control-label">Client Address</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea
                                    placeholder="Client Address..."
                                    class="form-control" id="client_address"
                                    name="client_address" cols="60"
                                    rows="5"><?= set_value('client_address', $project_record[0]->client_address); ?></textarea>
                                <span class="text-danger"><?= form_error('client_address'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="ContactPerson" class="control-label">Contact Person</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="ContactPerson" name="ContactPerson" placeholder="Contact Person" type="text"
                                       class="form-control"
                                       value="<?= set_value('ContactPerson', $project_record[0]->ContactPerson); ?>"/>
                                <span class="text-danger"><?= form_error('ContactPerson'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Contacts" class="control-label">Contact Details</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="Contacts" name="Contacts" placeholder="Contact Details" type="text"
                                       class="form-control"
                                       value="<?= set_value('Contacts', $project_record[0]->Contacts); ?>"/>
                                <span class="text-danger"><?= form_error('Contacts'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="statusCode" class="control-label">Project Status</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">

                                <?php
                                $attributes = 'class = "form-control" id = "statusCode"';
                                echo form_dropdown('statusCode', $statusCode, set_value('statusCode', $project_record[0]->statusCode), $attributes); ?>
                                <span class="text-danger"><?= form_error('statusCode'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="ProjectValue" class="control-label">Project Value</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="ProjectValue" name="ProjectValue" placeholder="Project Value" type="text"
                                       class="form-control"
                                       value="<?= set_value('ProjectValue', $project_record[0]->ProjectValue); ?>"/>
                                <span class="text-danger"><?= form_error('ProjectValue'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="TeamLeader" class="control-label">Team leader</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php
                                $attributes = 'class = "form-control" id = "TeamLeader"';
                                echo form_dropdown('TeamLeader', $teamLeader, set_value('TeamLeader', $project_record[0]->TeamLeader), $attributes); ?>
                                <span class="text-danger"><?= form_error('TeamLeader'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="ClientType" class="control-label">Client Type</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php
                                $attributes = 'class = "form-control" id = "ClientType"';
                                echo form_dropdown('ClientType', $clientType, set_value('ClientType', $project_record[0]->ClientType), $attributes); ?>
                                <span class="text-danger"><?= form_error('ClientType'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Country" class="control-label">Country</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php
                                $attributes = 'class = "form-control" id = "country"';
                                echo form_dropdown('country', $country, set_value('country', $project_record[0]->Country), $attributes); ?>
                                <span class="text-danger"><?= form_error('country'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="location_within_country" class="control-label">Location within country</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Location within country..." class="form-control" id="location_within_country" name="location_within_country" cols="60" rows="5"><?= set_value('location_within_country', $project_record[0]->location_within_country); ?></textarea>
                                <span class="text-danger"><?= form_error('location_within_country'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="projectSummary" class="control-label">Project Summary</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Project Summary" class="form-control" id="projectSummary" name="projectSummary" cols="60"rows="5"><?= set_value('projectSummary', $project_record[0]->projectSummary); ?></textarea>
                                <span class="text-danger"><?= form_error('projectSummary'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Amount" class="control-label">Project Amount</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="Amount" name="Amount" placeholder="Project Amount" type="text"
                                       class="form-control"
                                       value="<?= set_value('Amount', $project_record[0]->Amount); ?>"/>
                                <span class="text-danger"><?= form_error('Amount'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="value_services_provided_our_firm_in_contract" class="control-label">Value of services provided</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="value_services_provided_our_firm_in_contract" name="value_services_provided_our_firm_in_contract" placeholder="Value of services provided" type="text" class="form-control" value="<?= set_value('value_services_provided_our_firm_in_contract', $project_record[0]->value_services_provided_our_firm_in_contract); ?>"/>
                                <span class="text-danger"><?= form_error('value_services_provided_our_firm_in_contract'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Currency" class="control-label">Currency</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <?php
                                $attributes = 'class = "form-control" id = "Currency"';
                                echo form_dropdown('Currency', $currency, set_value('Currency', $project_record[0]->Currency), $attributes); ?>
                                <span class="text-danger"><?= form_error('Currency'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Contract_name" class="control-label">Contract Name</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="Contract_name" name="Contract_name" placeholder="Contract Name" type="text"
                                       class="form-control"
                                       value="<?= set_value('Contract_name', $project_record[0]->Contract_name); ?>"/>
                                <span class="text-danger"><?= form_error('Contract_name'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="TechnologiesUsed" class="control-label">Technologies Used</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="TechnologiesUsed" name="TechnologiesUsed" placeholder="Technologies Used"
                                       type="text"
                                       class="form-control"
                                       value="<?= set_value('TechnologiesUsed', $project_record[0]->TechnologiesUsed); ?>"/>
                                <span class="text-danger"><?= form_error('TechnologiesUsed'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="projectType" class="control-label">Project Type</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <input id="projectType" name="projectType" placeholder="Project Type" type="text" class="form-control" value="<?= set_value('projectType', $project_record[0]->projectType); ?>"/>
                                <span class="text-danger"><?= form_error('projectType'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="Comment" class="control-label">Comment</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Comment" class="form-control" id="Comment" name="Comment" cols="60"rows="5"><?= set_value('Comment', $project_record[0]->Comment); ?></textarea>
                                <span class="text-danger"><?= form_error('Comment'); ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row colbox">
                            <div class="col-lg-4 col-sm-4">
                                <label for="search_terms" class="control-label">Search Terms</label>
                            </div>
                            <div class="col-lg-8 col-sm-8">
                                <textarea placeholder="Search Terms" class="form-control" id="search_terms" name="search_terms" cols="60"rows="5"><?= set_value('search_terms', $project_record[0]->search_terms); ?></textarea>
                                <span class="text-danger"><?= form_error('search_terms'); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                            <input id="btn_update" name="btn_update" type="submit" class="btn btn-primary"
                                   value="Update"/>
                            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel"
                                   onclick="window.location='<?php echo site_url("DataEntryController/projects"); ?>'"/>
                        </div>
                    </div>

                    <?= form_close(); ?>
                    <?= $this->session->flashdata('msg'); ?>
                </fieldset>

            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







