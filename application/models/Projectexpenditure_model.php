<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */
class Projectexpenditure_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }


    function getProjectExpenditure($projectId, $staffId, $fromDate, $toDate)
    {
        $queryPartProjectId = ($projectId == '' or empty($projectId)) ? "and p.`tbl_projectId` like '%' " : "and p.`tbl_projectId` = " . $projectId . "";
        $queryPartStaffId = ($staffId == '' or empty($staffId)) ? "and `v`.`StaffId` like '%'" : "and `v`.`StaffId` = " . $staffId . "";
        $year = ($fromDate == '' && $toDate == '') ? "" : "and `v`.`RatedYear` between year('" . date("Y-m-d", strtotime($fromDate)) . "') and year('" . date("Y-m-d", strtotime($toDate)) . "')";
        $queryPartYear = ($year == '' or empty($year)) ? "and `v`.`RatedYear` <= " . (thisYear - 1) . "" : "" . $year . "";


        $this->db->select(" `v`.`userName`,
                            `v`.`StaffId`,
                            `v`.`RatedYear` as `sumYear`,
                            `v`.`StaffRate`,
                            `v`.`tbl_staffId`,
                            `v`.`fullNames`,
                            `v`.`inputhours`,
                            `v`.`hrfees`,
                            `p`.`projectName`
                            FROM `vw_projectbilling` as `v`
                            join `tbl_project` as `p` on (`p`.`tbl_projectId` = `v`.`projectId`)
                            WHERE 1
                            " . $queryPartProjectId . "
                            " . $queryPartStaffId . "
                            " . $queryPartYear . " order by `v`.`userName` asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getExpenditureSummations($projectId, $staffId, $fromDate, $toDate)
    {
        $queryPartProjectId = ($projectId == '' or empty($projectId)) ? "and p.`tbl_projectId` like '%' " : "and p.`tbl_projectId` = " . $projectId . "";
        $queryPartStaffId = ($staffId == '' or empty($staffId)) ? "and `v`.`StaffId` like '%'" : "and `v`.`StaffId` = " . $staffId . "";
        $year = ($fromDate == '' && $toDate == '') ? "" : "and `v`.`RatedYear` between year('" . date("Y-m-d", strtotime($fromDate)) . "') and year('" . date("Y-m-d", strtotime($toDate)) . "')";
        $queryPartYear = ($year == '' or empty($year)) ? "and `v`.`RatedYear` <= " . (thisYear - 1) . "" : "" . $year . "";


        $this->db->select(" `v`.`userName`,
                            `v`.`StaffId`,
                            `v`.`RatedYear` as `sumYear`,
                            `v`.`StaffRate`,
                            `v`.`tbl_staffId`,
                            `v`.`fullNames`,
                            sum(`v`.`inputhours`) as sumHours,
                            sum(`v`.`hrfees`) as sumFees,
                            `p`.`projectName`
                            FROM `vw_projectbilling` as `v`
                            join `tbl_project` as `p` on (`p`.`tbl_projectId` = `v`.`projectId`)
                            WHERE 1
                            " . $queryPartProjectId . "
                            " . $queryPartStaffId . "
                            " . $queryPartYear . "
                            group by
                            `p`.`projectName`
                            order by `v`.`userName` asc", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

}

