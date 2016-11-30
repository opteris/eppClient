<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */
class Project_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getAllProjects($projectId)
    {
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " WHERE tbl_projectId  =" . $projectId . "" : " WHERE tbl_projectId like '%'";
        $this->db->select(" * FROM tbl_project " . $query_append_projectId . "  order by projectName asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getMilestones($projectId, $milestoneId)
    {
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " WHERE projectId  =" . $projectId . "" : "";
        $query_append_milestoneId = ((!empty($projectId)) and (!empty($milestoneId) or ($milestoneId != ''))) ? " and tbl_milestoneId  =" . $milestoneId . "" : "";

        $this->db->select(" `tbl_milestoneId`,`projectId`,`milestone`
            FROM `tbl_milestone`
             " . $query_append_projectId . "
             " . $query_append_milestoneId . "
             order by milestone asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getActivities($projectId, $milestoneId, $activityId)
    {
        $query_append_milestoneId = ((!empty($milestoneId)) and (!empty($projectId))) ? " where projectId  =" . $projectId . " and milestone  =" . $milestoneId . " " : "";
        $query_append_activityId = (((!empty($projectId)) and (!empty($milestoneId)) and (!empty($activityId) or (($activityId) != '')))) ? " and tbl_activityId  =" . $activityId . " " : "";
        $this->db->select("`projectId`,
                            `milestone`,
                            `tbl_activityId`,
                            `activityName`
                            FROM `tbl_activity`
                            " . $query_append_milestoneId . "
                            " . $query_append_activityId . "
                            order by activityName asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getSubActivities($projectId, $milestoneId, $activityId)
    {
        $query_append_activityId = ((!empty($activityId)) and (!empty($milestoneId)) and (!empty($projectId))) ? " where projectId  =" . $projectId . " and milestone  =" . $milestoneId . " and activity  =" . $activityId . " " : "";
        $this->db->select("`tbl_project_updatesId`,
        `projectId`,
        `milestone`,
        `activity`,
        `ProjectUpdate`
        FROM `tbl_project_updates`
        " . $query_append_activityId . "
        order by ProjectUpdate asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllActiveUserProjects($filter_staffId)
    {
        $query_append_staffId = (!empty($filter_staffId) or ($filter_staffId != '')) ? "" . $filter_staffId . "" : "" . $this->session->userdata['role_id'] . "";


        $this->db->select(" * FROM tbl_project
        where tbl_projectId
        in (SELECT `projectId` FROM `tbl_timesheet`
        WHERE year(`timesheetDate`)=" . thisYear . "
        and userName='" . $query_append_staffId . "'
        ORDER BY `tbl_timesheet`.`timesheetDate` DESC)  order by projectName asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }

    }

    function getAllStaff($staffId)
    {
        if ($staffId == '') {
            $this->db->select(" s.*, d.name, g.groupName
            FROM tbl_staff s
            join tbl_staff_groups g on (g.tbl_staff_groupsId=s.groupCode)
            join tbl_designation d on (d.tbl_designationId=s.designation )
            where s.staffStatus='Active'
            order by s.fullNames asc", FALSE);
        } else {
            $this->db->select(" s.*, d.name, g.groupName
            FROM tbl_staff s
            join tbl_staff_groups g on (g.tbl_staff_groupsId=s.groupCode)
            join tbl_designation d on (d.tbl_designationId=s.designation)
            where s.staffStatus='Active'
            and s.tbl_staffId =" . $staffId . "
            order by s.fullNames asc", FALSE);
        }
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllStatus()
    {
        $this->db->select(" * FROM `tbl_status`
            order by statusCode asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getTimesheetProjects($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select(" `t`.`projectId`,p.tbl_projectId, p.projectName
                    FROM `tbl_timesheet` as `t`
                    join tbl_project as p
                    on (p.tbl_projectId=t.projectId)
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    group by `t`.`projectId`
                    order by `t`.`tbl_timeSheetId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getTimesheetMilestones($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("`t`.`projectId`,`t`.`milestone`,m.tbl_milestoneId, m.milestone as `milestoneName`
                    FROM `tbl_timesheet` as `t`
                    join tbl_milestone as m
                    on (m.tbl_milestoneId=t.milestone)
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    group by `t`.`projectId`,`t`.`milestone`
                    order by `t`.`tbl_timeSheetId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getTimeSheetActivities($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";

        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("`t`.`ProjectUpdate`,a.milestone,a.tbl_activityId,a.activityName
                    FROM `tbl_timesheet` as `t`
                    join tbl_activity as a
                    on (a.tbl_activityId=t.activity)
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    group by `t`.`projectId`,`t`.`milestone`,`t`.`activity`
                    order by `t`.`tbl_timeSheetId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getTimeSheetSubActivities($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("u.tbl_project_updatesId,`t`.`ProjectUpdate`, u.activity, u.ProjectUpdate as `subActivityName`
                    FROM `tbl_timesheet` as `t`
                    join tbl_project_updates as u
                    on (u.tbl_project_updatesId=t.ProjectUpdate)
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    group by `t`.`projectId`,`t`.`milestone`,`t`.`activity`, `t`.`ProjectUpdate`
                    order by `t`.`tbl_timeSheetId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getTimeSheet($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("
                    `t`.`tbl_timeSheetId`,
                    `t`.`timeSubmitted`,
                    `t`.`projectId`,
                    `t`.`milestone`,
                    `t`.`activity`,
                    `t`.`ProjectUpdate`,
                    `t`.`taskDescription`,
                    `t`.`plannedHours`,
                    `t`.`inputHours`,
                    `t`.`statusCode`,
                    `t`.`comment`,
                    `t`.`supervisorComment`,
                    `t`.`timesheetDate`,
                    `t`.`userName`,
                    `t`.`WeekofReporting`,
                    `t`.`DayoftheWeek`,
                    `t`.`weeklyAlertStatus`,
                    `t`.`complianceAward`,
                    `t`.`reportedAs`,
                    `t`.`updatedBy`
                    FROM `tbl_timesheet` as `t`
                    " . $query_append_staffId . "
                    " . $query_append_projectId . "
                    " . $appendDate . "
                    order by `t`.`tbl_timeSheetId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getDailySalesActuals($staffId, $fromDate, $toDate){
        $sess_staffId = '%';
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " and `user_id`  =" . $staffId . "" : " and `user_id`  like '" . $sess_staffId . "'";

        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `activity_date` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("`a`.`tbl_call_sheet_actualsId`,
                            `a`.`user_id`,
                            `a`.`tbl_call_sheet_plannerId`,
                            `a`.`activity_date`,
                            `a`.`company_name`,
                            `a`.`client_location`,
                            `a`.`key_decision_maker`,
                            `a`.`product_of_interest`,
                            `z`.`full_name` as `productOfInterest`,
                            `a`.`special_client_date`,
                            `a`.`desc_special_client_date`,
                            `a`.`client_using_competitor_product`,
                            `a`.`desc_competitor_product`,
                            `a`.`client_already_using_our_product`,
                            `a`.`desc_inhouse_product`,
                            `a`.`client_contact`,
                            `a`.`type_of_call`,
                            `a`.`client_commitment`,
                            `a`.`call_comment`,
                            `a`.`call_purpose`,
                            `a`.`call_opening_conversation`,
                            `a`.`call_sales_story`,
                            `a`.`benefits_to_customer`,
                            `a`.`objections_response`,
                            `a`.`closing_remarks`,
                            `a`.`action_points`,
                            `s`.`statusCode`,
                            `a`.`next_follow_up_date`,
                            `a`.`display`,
                            `st`.`fullNames`,
                            `a`.`time_stamp`
                            FROM `tbl_call_sheet_actuals` as `a`
                            join `tbl_sales_lead_prospect_status` as `s`
                            on (`s`.`tbl_sales_lead_prospect_statusId` = `a`.`prospect_rating`) and `s`.display='Yes',
                            `tbl_staff` as `st`,
                            `tbl_project_categorization` as `z`
                            where `a`.`display`='Yes'
                            and `z`.`tbl_project_categorizationId`=`a`.`product_of_interest`
                            and `st`.`tbl_staffId`=`a`.`user_id`
                            " . $query_append_staffId . "
                            " . $appendDate . "
                            order by `a`.`user_id`,`a`.`tbl_call_sheet_actualsId`
                            desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getDailySalesActualsTeam($staffId, $fromDate, $toDate){
        $sess_staffId = '%';
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " and `user_id`  =" . $staffId . "" : " and `user_id`  like '" . $sess_staffId . "'";

        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `activity_date` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select("`a`.`tbl_call_sheet_actualsId`,
                            `a`.`user_id`,
                            `a`.`tbl_call_sheet_plannerId`,
                            `a`.`activity_date`,
                            `a`.`company_name`,
                            `a`.`client_location`,
                            `a`.`key_decision_maker`,
                            `a`.`product_of_interest`,
                            `a`.`special_client_date`,
                            `a`.`desc_special_client_date`,
                            `a`.`client_using_competitor_product`,
                            `a`.`desc_competitor_product`,
                            `a`.`client_already_using_our_product`,
                            `a`.`desc_inhouse_product`,
                            `a`.`client_contact`,
                            `a`.`type_of_call`,
                            `a`.`client_commitment`,
                            `a`.`call_comment`,
                            `a`.`call_purpose`,
                            `a`.`call_opening_conversation`,
                            `a`.`call_sales_story`,
                            `a`.`benefits_to_customer`,
                            `a`.`objections_response`,
                            `a`.`closing_remarks`,
                            `a`.`action_points`,
                            `s`.`statusCode`,
                            `a`.`next_follow_up_date`,
                            `a`.`display`,
                            `st`.`fullNames`,
                            `a`.`time_stamp`
                            FROM `tbl_call_sheet_actuals` as `a`
                            join `tbl_sales_lead_prospect_status` as `s`
                            on (`s`.`tbl_sales_lead_prospect_statusId` = `a`.`prospect_rating`) and `s`.display='Yes',
                            `tbl_staff` as `st`
                            where `a`.`display`='Yes'
                            and `st`.`tbl_staffId`=`a`.`user_id`
                            " . $query_append_staffId . "
                            " . $appendDate . "
                            group by `a`.`user_id`
                            order by `a`.`user_id`,`a`.`tbl_call_sheet_actualsId`
                            desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function timesheetSummary($projectId, $staffId, $fromDate, $toDate)
    {
        $sess_staffId = ($this->session->userdata['user_id']);
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " WHERE `t`.`userName`  =" . $staffId . "" : " WHERE `t`.`userName`  ='" . $sess_staffId . "'";
        $query_append_projectId = (!empty($projectId) or ($projectId != '')) ? " and t.projectId  =" . $projectId . "" : "";
        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `t`.`timesheetDate` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select(" count(`t`.`taskDescription`) as `sumActivities`,
                        sum(t.plannedHours) as `sumPHrs`,
                        sum(t.inputHours) as `sumIHrs`
                        FROM `tbl_timesheet` as `t`
                        " . $query_append_staffId . "
                        " . $query_append_projectId . "
                        " . $appendDate . "", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getDailySalesActualsSummary($staffId, $fromDate, $toDate)
    {
        $sess_staffId = '%';
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " and `user_id`  =" . $staffId . "" : " and `user_id`  like '" . $sess_staffId . "'";

        $appendFromDate = (empty($fromDate) or ($fromDate == '')) ? date("Y-m-01") : @date('Y-m-d', @strtotime($fromDate));
        $timestamp = strtotime("last day of");
        $appendToDate = (empty($toDate) or ($toDate == '')) ? date("Y-m-d", $timestamp) : @date('Y-m-d', @strtotime($toDate));
        $appendDate = " and `activity_date` between ('" . $appendFromDate . "')and ('" . $appendToDate . "')";

        $this->db->select(" count(t.`tbl_call_sheet_actualsId`) as `sumCalls`,
                        sum( if( t.client_commitment <> '', t.client_commitment, 0 ) ) AS commitmentInShillings,
                        sum( if( t.action_points <> '', 1, 0 ) ) AS actionPoints
                        FROM `tbl_call_sheet_actuals` as `t`,
                        `tbl_staff` as `st`
                        where `t`.`display`='Yes'
                        and `st`.`tbl_staffId`=`t`.`user_id`
                        " . $query_append_staffId . "
                        " . $appendDate . "
                        order by `t`.`tbl_call_sheet_actualsId` desc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getStaffName($staffId){
        $id=(!empty($staffId))?$staffId:$this->session->userdata['user_id'];
        $this->db->select(" s.*
            FROM tbl_staff s
            where s.staffStatus='Active'
            and s.tbl_staffId =" . $id . "
            order by s.fullNames asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function permissionsModel()
    {
        $this->db->select(" i.tbl_menu_itemsId, i.`menu_categoriesId`, i.MenuItem, p.MenuItem as pMenuItem, i.LinkvalCode, i.Rank
        from `tbl_menu_items` i
        left join `tbl_permisions` p
        on (p.MenuItem = i.tbl_menu_itemsId)
        group by i.tbl_menu_itemsId, i.`menu_categoriesId`, i.MenuItem, p.MenuItem, i.LinkvalCode, i.Rank
        order by i.Rank, i.tbl_menu_itemsId", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function currentPermissions($id)
    {
        $used_id=($id=='' or empty($id))?$this->session->userdata['role_id']:$id;

        $this->db->select(" i.tbl_menu_itemsId, i.`menu_categoriesId`, i.MenuItem, p.MenuItem as pMenuItem, i.LinkvalCode, i.Rank
        from `tbl_menu_items` i
        left join `tbl_permisions` p
        on (p.MenuItem = i.tbl_menu_itemsId)
        where p.role_id=".$used_id."
        group by i.tbl_menu_itemsId, i.`menu_categoriesId`, i.MenuItem, p.MenuItem, i.LinkvalCode, i.Rank
        order by i.Rank, i.tbl_menu_itemsId", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function LateReporters(){
        $endDate=date('Y-m-d', strtotime('-7 days'));

        $this->db->select(" l.*, g.groupName FROM `vw_lastreported`l join `tbl_staff_groups` g
        on (g.tbl_staff_groupsId=l.groupCode)
        WHERE l.`lastReported`<'".$endDate."'
            order by l.fullNames asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllStaffLastReported($staffId)
    {

            $this->db->select(" s.*, l.lastReported
            FROM tbl_staff s join `vw_lastreported`l on (`l`.`tbl_staffId` = `s`.`tbl_staffId`)
            where s.staffStatus='Active'
            and s.tbl_staffId =" . $staffId . "
            order by s.fullNames asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }
}

