<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */

class Hoursworked_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getAllMonthlyEffortInHours($projectId,$staffId,$fromDate,$toDate)
    {

        $queryPartProjectId=($projectId=='' or empty($projectId))?"and p.`tbl_projectId` like '%'":"and p.`tbl_projectId` = ".$projectId."";
        $queryPartStaffId=($staffId=='' or empty($staffId))?"and s.`tbl_staffId` like '%'":"and s.`tbl_staffId` = ".$staffId."";
        $queryPartDate=($fromDate=='' && $toDate=='')?"":"and t.timesheetdate between ('".date("Y-m-d", strtotime($fromDate))."') and ('".date("Y-m-d", strtotime($toDate))."')";
        $year=($fromDate=='' && $toDate=='')?"":"and year(t.timesheetdate) between year('".date("Y-m-d", strtotime($fromDate))."') and year('".date("Y-m-d", strtotime($toDate))."')";
        $queryPartYear=($year=='' or empty($year))?"and YEAR(t.`timesheetDate`)=".thisYear."":"".$year."";


        $this->db->select(" `d`.`Department`,
        `de`.`name` as `designationName`,
        `s`.`fullNames`,
        round(sum(if(month(t.timesheetdate)=1,t.`inputHours`,0)),2) as `HoursJan`,
        round(sum(if(month(t.timesheetdate)=2,t.`inputHours`,0)),2) as `HoursFeb`,
        round(sum(if(month(t.timesheetdate)=3,t.`inputHours`,0)),2) as `HoursMar`,
        round(sum(if(month(t.timesheetdate)=4,t.`inputHours`,0)),2) as `HoursApr`,
        round(sum(if(month(t.timesheetdate)=5,t.`inputHours`,0)),2) as `HoursMay`,
        round(sum(if(month(t.timesheetdate)=6,t.`inputHours`,0)),2) as `HoursJun`,
        round(sum(if(month(t.timesheetdate)=7,t.`inputHours`,0)),2) as `HoursJul`,
        round(sum(if(month(t.timesheetdate)=8,t.`inputHours`,0)),2) as `HoursAug`,
        round(sum(if(month(t.timesheetdate)=9,t.`inputHours`,0)),2) as `HoursSep`,
        round(sum(if(month(t.timesheetdate)=10,t.`inputHours`,0)),2) as `HoursOct`,
        round(sum(if(month(t.timesheetdate)=11,t.`inputHours`,0)),2) as `HoursNov`,
        round(sum(if(month(t.timesheetdate)=12,t.`inputHours`,0)),2) as `HoursDec`
        FROM
        `tbl_timesheet` as `t`,
        `tbl_staff` as `s`,
        `tbl_project` as `p`,
        `tbl_department` as `d`,
        `tbl_designation` as `de`
        WHERE p.`tbl_projectId`=t.`projectId`
        AND s.`tbl_staffId`=t.`userName`
        and d.tbl_departmentId=s.`groupCode`
        and `de`.`tbl_designationId` = designation
        ".$queryPartProjectId."
        ".$queryPartStaffId."
        ".$queryPartDate."
        ".$queryPartYear."
        GROUP BY t.`userName` ORDER BY s.`fullNames`", FALSE);

        $db_rows = $this->db->get();


        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }






}

