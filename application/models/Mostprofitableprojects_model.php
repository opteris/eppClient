<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */

class Mostprofitableprojects_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getFiveProfitableProjects()
    {
        $this->db->select("`v`.`projectId`,
                            `p`.`projectName`,
                            round(sum(`v`.`hrfees`),0)as `projectCost`,
                            round(sum(`v`.`inputHours`),0)as `loeInHours`
                            FROM `vw_projectbilling` as `v`
                            join `tbl_project` as `p` on (`p`.`tbl_projectId` = `v`.`projectId`)
                            GROUP BY `projectId`
                            order by projectCost ASC
                            limit 0,5", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }
    function getFiveCostlyProjects()
    {
        $this->db->select("`v`.`projectId`,
                            `p`.`projectName`,
                            round(sum(`v`.`hrfees`),0)as `projectCost`,
                            round(sum(`v`.`inputHours`),0)as `loeInHours`
                            FROM `vw_projectbilling` as `v`
                            join `tbl_project` as `p` on (`p`.`tbl_projectId` = `v`.`projectId`)
                            GROUP BY `projectId`
                            order by projectCost DESC
                            limit 0,5", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }



}

