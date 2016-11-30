<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */

class Annualloe_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getLOEForeachMonth()
    {
        $this->db->select("round(sum(if(month(t.timesheetdate)=1,t.`inputHours`,0)),1) as `HoursJan`,
									round(sum(if(month(t.timesheetdate)=2,t.`inputHours`,0)),1) as `HoursFeb`,
									round(sum(if(month(t.timesheetdate)=3,t.`inputHours`,0)),1) as `HoursMar`,
									round(sum(if(month(t.timesheetdate)=4,t.`inputHours`,0)),1) as `HoursApr`,
									round(sum(if(month(t.timesheetdate)=5,t.`inputHours`,0)),1) as `HoursMay`,
									round(sum(if(month(t.timesheetdate)=6,t.`inputHours`,0)),1) as `HoursJun`,
									round(sum(if(month(t.timesheetdate)=7,t.`inputHours`,0)),1) as `HoursJul`,
									round(sum(if(month(t.timesheetdate)=8,t.`inputHours`,0)),1) as `HoursAug`,
									round(sum(if(month(t.timesheetdate)=9,t.`inputHours`,0)),1) as `HoursSep`,
									round(sum(if(month(t.timesheetdate)=10,t.`inputHours`,0)),1) as `HoursOct`,
									round(sum(if(month(t.timesheetdate)=11,t.`inputHours`,0)),1) as `HoursNov`,
									round(sum(if(month(t.timesheetdate)=12,t.`inputHours`,0)),1) as `HoursDec`
									FROM `tbl_timesheet` t,`tbl_project` p
									WHERE p.`tbl_projectId`=t.`projectId`
									AND YEAR(t.`timesheetDate`)=".thisYear."", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }



}

