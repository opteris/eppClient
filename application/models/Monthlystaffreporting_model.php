<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */

class Monthlystaffreporting_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getAllMonthlyEffortInHours()
    {
        $this->db->select("round(sum(t.`inputHours`),6) as `loeMonthTotal`
					from `tbl_timesheet` t,`tbl_project` p
					where p.`tbl_projectId`=t.`projectId`
					and month(t.timesheetdate)=".digitMonth."
					and YEAR(t.`timesheetDate`)=".thisYear."", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function highestMonthlySingleUserLoe()
    {
        $this->db->select("t.`userName` ,
					s.`fullNames`,
					round(sum(if(month(t.timesheetdate)=".digitMonth.",t.`inputHours`,0)),6) as `loeMonth`
					from `tbl_timesheet` t, `tbl_staff` s, `tbl_project` p
					where p.`tbl_projectId`=t.`projectId`
					and s.`tbl_staffId`=t.`userName`
					and YEAR(t.`timesheetDate`)=".thisYear."
					group by t.`userName`
					order by loeMonth desc limit 0,1", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function allUsersLoeWithoutHighest($highestUser)
    {
        $this->db->select("t.`userName` ,
                            s.`fullNames`,
                            round(sum(if(month(t.timesheetdate)=".digitMonth.",t.`inputHours`,0)),6) as `loeMonthOthers`
                            from `tbl_timesheet` t, `tbl_staff` s, `tbl_project` p
                            where p.`tbl_projectId`=t.`projectId`
                            and s.`tbl_staffId`=t.`userName`
                            and s.`fullNames` not like '".$highestUser."%'
                            and YEAR(t.`timesheetDate`)=".thisYear."
                            group by t.`userName`
                            order by loeMonthOthers DESC", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }




}

