<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>View Projects</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_projectsForm", "name" => "filter_projectsForm");
    echo form_open("DataEntryController/projects", $attributes); ?>


    <div class="col-sm-6" align="left">
        <div class="form-group">

            <select name="filter_P_projectId" id="filter_P_projectId" class="form-control">
                <option value="" default selected>-All Projects-</option>
                <?php

                foreach ($data_get_all_projects as $project) {
                    $sel_project = (($project->tbl_projectId) == (set_value('filter_P_projectId'))) ? 'selected' : '';
                    $project_data = '<option value="' . $project->tbl_projectId . '" ' . $sel_project . '>' . $project->projectName . '</option>';
                    echo $project_data;
                }

                ?>
            </select>
        </div>
        <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
               onclick="location.href='<?= site_url('SystemSetupController/projects') ?>'" />
        <input id="export_to_excel" name="export_to_excel" type="submit" class="btn btn-default"
               value="Export to Excel" onclick="location.href='<?= site_url('SystemSetupController/projects') ?>'"/>
    </div>
    <div class="col-sm-6" align="right">
        <input id="addUsers" name="addProject" type="submit" class="btn btn-info" value="Add New Project"
               onclick="location.href='<?= base_url('SystemSetupController/addStaffMembers') ?>'"/>

    </div>





    <?= form_close(); ?>

    <?php
    if(!empty($this->session->flashdata('msg'))){
        $successData="
        <div class='alert alert-success'>.$this->session->flashdata('msg').</div>
        ";
        echo $successData;
    }
    ?>


    <div class="col-sm-12 table-responsive">
        <table class="table table-bordered table-hover table-striped standard-report-grid">
            <thead>
            <tr>
                <th colspan="11">ORS Project Profiles</th>
            </tr>

            <tr>
                <th class="first-cell-header">#</th>
                <th class="large-cell-header">Project</th>
                <th class="small-cell-header">Version</th>
                <th class="small-cell-header">Team Leader</th>
                <th class="small-cell-header">Client name</th>
                <th class="small-cell-header">Country</th>
                <th class="small-cell-header">Start Date</th>
                <th class="small-cell-header">Endss Date</th>
                <th class="small-cell-header">Project Documents</th>
                <th class="small-cell-header">Status</th>
                <th class="largest-cell-header" colspan="2">ACTION</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $n = 1;
            foreach ($data_get_all_projects as $rowProject) {
                ?>
                <tr id="delete_link_<?= $rowProject->tbl_projectId; ?>">

                    <td><?= $n; ?></td>
                    <td><?= $rowProject->projectName; ?></td>
                    <td><?= $rowProject->version; ?></td>
                    <td><?= $rowProject->TeamLeader; ?></td>
                    <td><?= $rowProject->client; ?></td>
                    <td><?= $rowProject->countryName; ?></td>
                    <td><?= $rowProject->startDate; ?></td>
                    <td><?= $rowProject->endDate; ?></td>
                    <td>Project Docs</td>
                    <td><?= $rowProject->statusCode; ?></td>


                    <td colspan="2">
                    <span class="btn-group">
                    <a class="btn btn-medium confirmbutton" data-toggle="popover" title="Edit Project"
                       data-content="Click to Edit Project"  data-trigger="hover" data-placement="right"
                       onclick="window.location='<?php echo site_url("DataEntryController/editProjects/" . $rowProject->tbl_projectId . ""); ?>'"><i
                            class="fa fa-edit" style="color: #30b1ff;"></i>
                        </i></a>
                    </span>
                    <span class="btn-group">
                    <a class="btn btn-medium confirmbutton"  data-toggle="popover" title="Delete Project" data-content="Click to Delete Project"  data-trigger="hover" data-placement="right"
                       onclick="ConfirmStaffDelete('<?= $rowProject->tbl_projectId; ?>')">


                        <i class="fa fa-trash" style="color: #ff342a;"></i>
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
        <div class="col-md-12 text-left">
            <?= $pagination; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- /.table-responsive -->
</div>
<!-- /.col-lg-wrapper (nested) -->







