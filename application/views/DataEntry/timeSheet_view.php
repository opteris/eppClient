<div id="page-wrapper">
    <div class="col-sm-12 container breadcrumb-container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="#"><?= strstr(uri_string(), 'Controller/', true); ?></a></li>
            <li><a href="#"><?= substr(base_url(uri_string()), strrpos(base_url(uri_string()), '/') + 1); ?></a></li>
            <li class="active"><span>Add Time Sheet</span></li>
        </ol>
    </div>
    <?php
    $attributes = array("class" => "col-sm-12 form-inline", "id" => "filter_timeSheet", "name" => "filter_timeSheet");
    echo form_open("DataEntryController/timeSheet", $attributes); ?>


    <div class="col-sm-12" align="left">
        <div class="form-group">
            <select name="filter_TS_projectId" id="filter_TS_projectId" class="form-control">
                <option value="" default selected>-All Projects-</option>
                <?php

                foreach ($data_get_all_projects as $project) {
                    $sel_project = (($project->tbl_projectId) == (set_value('filter_TS_projectId'))) ? 'selected' : '';
                    $project_data = '<option value="' . $project->tbl_projectId . '" ' . $sel_project . '>' . $project->projectName . '</option>';
                    echo $project_data;
                }

                ?>
            </select>

            <select name="filter_TS_milestoneId" id="filter_TS_milestoneId"
                    class="form-control">
                <option value="" default selected>-Milestone-</option>
                <?php

                foreach ($data_get_milestones as $milestone) {
                    if (empty(set_value('filter_TS_projectId')) or ((set_value('filter_TS_projectId')) == '')) {
                        $milestone_data = "";
                    } else {
                        $sel_milestone = (($milestone->tbl_milestoneId) == (set_value('filter_TS_milestoneId'))) ? 'selected' : '';
                        $milestone_data = '<option value="' . $milestone->tbl_milestoneId . '" ' . $sel_milestone . '>' . $milestone->milestone . '</option>';

                    }

                    echo $milestone_data;
                }

                ?>
            </select>

            <select name="filter_TS_activityId" id="filter_TS_activityId"
                    class="form-control">
                <option value="" default selected>-Activity-</option>
                <?php

                foreach ($data_get_activities as $activity) {
                    if (empty(set_value('filter_TS_milestoneId')) or ((set_value('filter_TS_milestoneId')) == '')) {
                        $activity_data = "";
                    } else {
                        $sel_activity = (($activity->tbl_activityId) == (set_value('filter_TS_activityId'))) ? 'selected' : '';
                        $activity_data = '<option value="' . $activity->tbl_activityId . '" ' . $sel_activity . ' >' . $activity->activityName . '</option>';


                    }

                    echo $activity_data;
                }

                ?>
            </select>

            <?php
            $dt = new DateTime('December 28th, ' . thisYear . '');
            $totalWeeks = $dt->format('W');
            $yr = date('W');
            $end = $yr;
            $startYear = 1;
            $week_data = '<select name="weekoftheyear" id="weekoftheyear" class="form-control">
                <option value="" default selected>-week of the year-</option>';
            $selected = (set_value('weekoftheyear'));

            do {
                $sel = ($end == $selected) ? "selected" : "";
                $week_data .= '<option value="' . $end . '" ' . $sel . ' >' . readNumber($end, $depth = 0) . '</option>';
                $end--;
            } while ($end >= $startYear);
            $week_data .= '</select> out of ' . $totalWeeks;
            echo $week_data;
            ?>


        </div>
        <input id="submit" name="submit" type="submit" class="btn btn-default" value="Search"
               onclick="location.href='<?= site_url('DataEntryController/timeSheet') ?>'"/>

    </div>


    <?= form_close(); ?>

    <!--Start timesheet display-->
    <?php if (empty(set_value('filter_TS_projectId')) or ((set_value('filter_TS_projectId')) == '')) { ?>
        <div class="clearfix"></div>
        <div class="alert alert-info">
            <strong><i class="fa fa-info-circle fa-3x"
                       style="color: green;""></i></strong> Please filter out a project on which you wish to submit a
            timesheet.
        </div>

    <?php } else { ?>
        <!--table-responsive -->
        <div class="col-sm-12 table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th colspan="9">Data Entry: Daily Timesheet</th>
                </tr>

                <tr>
                    <th>#<img src="" height="0.1px" width="150px;"></th>
                    <th>Sub Activity</th>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
                </thead>

                <?php
                /*start of project parameters*/
                $p = 1;
                foreach ($data_get_all_projects as $prjData) {
                    $projectId = $prjData->tbl_projectId;
                    $projectName = $prjData->projectName;
                    ?>
                    <tbody>

                    <tr>
                        <td><strong><i class="fa fa-dot-circle-o fa-2x" style="color: #333333;"></i>
                                Project:</strong></td>
                        <td class="greenColor" colspan="8"><strong><?= $projectName; ?></strong></td>
                    </tr>

                    <?php if (empty(set_value('filter_TS_milestoneId')) or ((set_value('filter_TS_milestoneId')) == '')) { ?>
                        <div class="clearfix"></div>
                        <div class="alert alert-info">
                            <strong><i class="fa fa-info-circle fa-3x"
                                       style="color: green;""></i></strong> Please filter out a Milestone on
                            Project: <?= $projectName; ?>.
                        </div>

                    <?php } else {
                        /*start milestones*/

                        $m = 1;
                        foreach ($data_get_milestones as $milData) {
                            $milestoneId = $milData->tbl_milestoneId;
                            $milestoneName = $milData->milestone;
                            ?>

                            <tr>
                                <td style="color:#006600;"><strong><i class="fa fa-dot-circle-o"
                                                                      style="color: green;"></i>
                                        Milestone:</strong>
                                </td>
                                <td colspan="8" style="color:#006600;"><strong><?= $milestoneName; ?> </strong></td>
                            </tr>

                            <?php if (empty(set_value('filter_TS_activityId')) or ((set_value('filter_TS_activityId')) == '')) { ?>
                                <div class="clearfix"></div>
                                <div class="alert alert-info">
                                    <strong><i class="fa fa-info-circle fa-3x"
                                               style="color: green;""></i></strong> Please filter out an Activity on
                                    Milestone: <?= $milestoneName; ?> ,<br/>
                                    Project: <?= $projectName; ?>.
                                </div>

                            <?php } else {
                                /*Start Actitivities*/
                                $ac = 1;
                                foreach ($data_get_activities as $activityData) {
                                    $activityId = $activityData->tbl_activityId;
                                    $activityName = $activityData->activityName;
                                    ?>

                                    <tr>
                                        <td style="color:#FF3300;"><strong><i class="fa fa-space-shuttle"
                                                                              style="color: #FF3300;"></i>
                                                Activity:</strong></td>
                                        <td style="color:#FF3300;" colspan="8">
                                            <strong><?= $activityName; ?></strong></td>
                                    </tr>

                                    <!--Start Sub-activities-->
                                    <?php

                                    $subAc = 1;
                                    foreach ($data_get_sub_activities as $subActivityData) {
                                        $subActivityId = $subActivityData->tbl_project_updatesId;
                                        $subActivityName = $subActivityData->ProjectUpdate;
                                        ?>

                                        <tr class="greyish">
                                            <td><i class="fa fa-scissors" style="color: #333333;"></i> Sub-Activity:
                                            </td>
                                            <td><a href="#" title="View All">
                                                    <?= $subActivityName; ?></a>

                                            </td>

                                            <td align="center" class="timesheetSunday"><a id="Sunday" class="Sunday"
                                                                                          href="#" data-toggle="modal"
                                                                                          data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetSunday"
                                                                                          value="Sunday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Sunday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetSunday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetSunday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Sunday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetSunday" . $subAc . "", "name" => "form_timeSheetSunday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input  id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodySunday'>
                                                                        <tr id="first-of-addRowSunday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Sunday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowSunday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgSunday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divSunday">
                                                                    <tr id="first-of-addRowSunday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Sunday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetSunday"
                                                                        id="submitTimesheetSunday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitSundayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>


                                            <td align="center" class="timesheetMonday"><a id="Monday" class="Monday"
                                                                                          href="#" data-toggle="modal"
                                                                                          data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetMonday"
                                                                                          value="Monday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Monday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetMonday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetMonday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Monday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetMonday" . $subAc . "", "name" => "form_timeSheetMonday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodyMonday'>
                                                                        <tr id="first-of-addRowMonday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Monday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowMonday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgMonday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divMonday">
                                                                    <tr id="first-of-addRowMonday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Monday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetMonday"
                                                                        id="submitTimesheetMonday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitMondayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>

                                            <td align="center" class="timesheetTuesday"><a id="Tuesday" class="Tuesday"
                                                                                           href="#" data-toggle="modal"
                                                                                           data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetTuesday"
                                                                                           value="Tuesday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Tuesday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetTuesday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetTuesday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Tuesday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetTuesday" . $subAc . "", "name" => "form_timeSheetTuesday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodyTuesday'>
                                                                        <tr id="first-of-addRowTuesday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Tuesday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowTuesday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgTuesday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divTuesday">
                                                                    <tr id="first-of-addRowTuesday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Tuesday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetTuesday"
                                                                        id="submitTimesheetTuesday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitTuesdayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>


                                            <td align="center" class="timesheetWednesday"><a id="Wednesday" class="Wednesday"
                                                                                             href="#" data-toggle="modal"
                                                                                             data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetWednesday"
                                                                                             value="Wednesday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Wednesday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetWednesday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetWednesday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Wednesday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetWednesday" . $subAc . "", "name" => "form_timeSheetWednesday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodyWednesday'>
                                                                        <tr id="first-of-addRowWednesday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Wednesday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowWednesday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgWednesday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divWednesday">
                                                                    <tr id="first-of-addRowWednesday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Wednesday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetWednesday"
                                                                        id="submitTimesheetWednesday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitWednesdayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>

                                            <td align="center" class="timesheetThursday"><a id="Thursday" class="Thursday"
                                                                                            href="#" data-toggle="modal"
                                                                                            data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetThursday"
                                                                                            value="Thursday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Thursday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetThursday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetThursday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Thursday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetThursday" . $subAc . "", "name" => "form_timeSheetThursday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodyThursday'>
                                                                        <tr id="first-of-addRowThursday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Thursday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowThursday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgThursday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divThursday">
                                                                    <tr id="first-of-addRowThursday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Thursday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetThursday"
                                                                        id="submitTimesheetThursday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitThursdayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>

                                            <td align="center" class="timesheetFriday"><a id="Friday" class="Friday"
                                                                                          href="#" data-toggle="modal"
                                                                                          data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetFriday"
                                                                                          value="Friday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Friday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetFriday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetFriday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Friday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetFriday" . $subAc . "", "name" => "form_timeSheetFriday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodyFriday'>
                                                                        <tr id="first-of-addRowFriday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Friday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowFriday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgFriday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divFriday">
                                                                    <tr id="first-of-addRowFriday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Friday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetFriday"
                                                                        id="submitTimesheetFriday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitFridayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>

                                            <td align="center" class="timesheetSaturday"><a id="Saturday" class="Saturday"
                                                                                            href="#" data-toggle="modal"
                                                                                            data-target="#<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetSaturday"
                                                                                            value="Saturday"><i
                                                        class="fa fa-times-circle fa-3x"
                                                        style="color: red;"></i> </a>

                                                <!-- Modal Saturday-->
                                                <div
                                                    id="<?= $projectId . '_' . $milestoneId . '_' . $activityId . '_' . $subActivityId; ?>_timesheetSaturday"
                                                    class="modal fade" tabindex="-1" role="dialog"
                                                    aria-labelledby="gridSystemModalLabel">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content" id="tblTimesheetSaturday">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close"><span
                                                                        aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="gridSystemModalLabel">Saturday
                                                                    Time Sheet
                                                                    for:<?= $this->session->userdata['name']; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
                                                                $attributes = array("class" => "form-vertical", "id" => "form_timeSheetSaturday" . $subAc . "", "name" => "form_timeSheetSaturday");
                                                                echo form_open("SystemSetupController/submitTimeSheet", $attributes);
                                                                ?>

                                                                <div class="form-group">
                                                                    <?php
                                                                    if (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12'))) {
                                                                        $data = "";
                                                                    } else {
                                                                        $data = '<div class="col-lg-6 col-sm-6" align="left">
                                                                            <select name="staffId[]" id="staffId1"  class="form-control">
                                                                                <option value="" default selected>-All staff members-</option>';

                                                                        $s = 1;
                                                                        foreach ($data_get_all_staff as $rStaff) {
                                                                            $sel_Staff = (($rStaff->tbl_staffId) == (set_value('staffId[]'))) ? 'selected' : '';
                                                                            $data .= '<option value="' . $rStaff->tbl_staffId . '" ' . $sel_Staff . '>' . $rStaff->fullNames . '</option>';
                                                                            $s++;
                                                                        }

                                                                        $data .= '</select>';
                                                                        $data .= '</div>';
                                                                    }
                                                                    echo $data;
                                                                    ?>


                                                                    <div class="col-lg-6 col-sm-6 input-group date"
                                                                         data-provide="datepicker"
                                                                         align="right">
                                                                        <input id="Date1" name="Date[]"
                                                                               placeholder="Timesheet Date"
                                                                               type="text"
                                                                               class="form-control"
                                                                               value="<?= set_value('Date[]'); ?>"/>

                                                                        <div class="input-group-addon">
                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 table-responsive">
                                                                    <table
                                                                        class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Task Description</th>
                                                                            <th>Planned Hours</th>
                                                                            <th>Input Hours</th>
                                                                            <th>Comment</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id='theBodySaturday'>
                                                                        <tr id="first-of-addRowSaturday<?= $subAc; ?>">
                                                                            <td id="firstCell<?= $subAc; ?>">1</td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="loopkey[]" id="loopkey"
                                                                                           value="1"
                                                                                           type="hidden">
                                                                                    <input name="projectId[]"
                                                                                           id="projectId1"
                                                                                           value="<?= $projectId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="milestoneId[]"
                                                                                           id="milestoneId1"
                                                                                           value="<?= $milestoneId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="activityId[]"
                                                                                           id="activityId1"
                                                                                           value="<?= $activityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="subactivityId[]"
                                                                                           id="subactivityId1"
                                                                                           value="<?= $subActivityId; ?>"
                                                                                           type="hidden">
                                                                                    <input name="day[]" id="day1"
                                                                                           value="Saturday"
                                                                                           type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription[]'); ?></textarea>
                                                                                </div>

                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Planned hours on task..."
                                                                                           class="form-control"
                                                                                           name="plannedHours[]"
                                                                                           id="plannedHours1"
                                                                                           value="<?php echo set_value('plannedHours[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                                    <input type="text"
                                                                                           placeholder="Actual hours spent on task..."
                                                                                           class="form-control"
                                                                                           name="hoursSpent[]"
                                                                                           id="hoursSpent1"
                                                                                           value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                                </div>
                                                                            </td>

                                                                            <td>

                                                                                <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment ie challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                                </div>
                                                                            </td>

                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="statusCode[]"
                                                                                            id="statusCode1"
                                                                                            class="form-control">
                                                                                        <option value="" default
                                                                                                selected>-Status-
                                                                                        </option>
                                                                                        <?php
                                                                                        $data2 = '';
                                                                                        foreach ($data_get_all_status as $rStatus2) {
                                                                                            $sel_Status2 = (($rStatus2->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                            $data2 .= '<option value="' . $rStatus2->tbl_statusId . '" ' . $sel_Status2 . '>' . $rStatus2->statusCode . '</option>';

                                                                                        }
                                                                                        echo $data2;
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <div align="left" class="col-lg-12">
                                                                        <input type='button' class="btn btn-primary"
                                                                               name='addTask'
                                                                               id="addTask"
                                                                               TITLE='Add Task' value='Add Task'
                                                                               onclick="addRowSaturday(null,null,<?= $subAc; ?>)"/>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="errorMsgSaturday<?= $subAc; ?>"
                                                                         id="alert-msg"></div>

                                                                </div>

                                                                <?php echo form_close(); ?>
                                                                <table style='display:none'>
                                                                    <tbody id="template-divSaturday">
                                                                    <tr id="first-of-addRowSaturday<?= $subAc; ?>">
                                                                        <td id="firstCell<?= $subAc; ?>">1</td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input name="projectId[]"
                                                                                       id="projectId1"
                                                                                       value="<?= $projectId; ?>"
                                                                                       type="hidden">
                                                                                <input name="milestoneId[]"
                                                                                       id="milestoneId1"
                                                                                       value="<?= $milestoneId; ?>"
                                                                                       type="hidden">
                                                                                <input name="activityId[]"
                                                                                       id="activityId1"
                                                                                       value="<?= $activityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="subactivityId[]"
                                                                                       id="subactivityId1"
                                                                                       value="<?= $subActivityId; ?>"
                                                                                       type="hidden">
                                                                                <input name="day[]" id="day1"
                                                                                       value="Saturday"
                                                                                       type="hidden">
                                                                    <textarea
                                                                        placeholder="Describe another task worked on here..."
                                                                        class="form-control" id="taskDescription1"
                                                                        name="taskDescription[]" cols="60"
                                                                        rows="5"><?= set_value('taskDescription'); ?></textarea>
                                                                            </div>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Planned hours on task..."
                                                                                       class="form-control"
                                                                                       name="plannedHours[]"
                                                                                       id="plannedHours1"
                                                                                       value="<?php echo set_value('plannedHours[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                                <input type="text"
                                                                                       placeholder="Actual hours spent on task..."
                                                                                       class="form-control"
                                                                                       name="hoursSpent[]"
                                                                                       id="hoursSpent1"
                                                                                       value="<?php echo set_value('hoursSpent[]'); ?>">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-group">
                                                                    <textarea
                                                                        placeholder="Add a comment i.e challenge..."
                                                                        class="form-control" id="comment1"
                                                                        name="comment[]" cols="60"
                                                                        rows="5"><?php echo set_value('comment[]'); ?></textarea>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group">
                                                                                <select name="statusCode[]"
                                                                                        id="statusCode1"
                                                                                        class="form-control">
                                                                                    <option value="" default selected>
                                                                                        -Status-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                                                    <?php
                                                                                    $data3 = '';

                                                                                    foreach ($data_get_all_status as $rStatus) {
                                                                                        $sel_Status = (($rStatus->tbl_statusId) == (set_value('statusCode[]'))) ? 'selected' : '';
                                                                                        $data3 .= '<option value="' . $rStatus->tbl_statusId . '" ' . $sel_Status . '>' . $rStatus->statusCode . '</option>';

                                                                                    }
                                                                                    echo $data3;
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" name="submitTimesheetSaturday"
                                                                        id="submitTimesheetSaturday<?= $subAc; ?>"
                                                                        class="btn btn-primary"
                                                                        onclick="submitSaturdayTimesheet(<?= $subAc; ?>)">
                                                                    Submit Timesheet
                                                                </button>
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">
                                                                    Close
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                        <!--</div>-->
                                                        <!-- /.modal-dialog -->
                                                        <!--</div>-->
                                                        <!-- /.modal -->


                                            </td>


                                        </tr>


                                        <tr>
                                            <td colspan="9" class="offwhite">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        </tr>

                                        <!--end Sub-activities-->
                                        <?php
                                        $subAc++;
                                    }
                                    ?>


                                    <?php
                                    $ac++;
                                }
                            }
                            /*End Activities*/
                            ?>


                            <?php
                            $m++;
                        }
                    }
                    /*end milestones*/
                    ?>


                    </tbody>
                    <?php
                    $p++;
                }
                /*end of project parameters*/
                ?>


            </table>
        </div>
        <div class="clearfix"></div>
        <!-- /.table-responsive -->
    <?php } ?>
    <!--End Timesheet Display-->


</div>
<!-- /.col-lg-wrapper (nested) -->







