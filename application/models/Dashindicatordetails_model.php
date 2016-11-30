<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */

class Dashindicatordetails_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function getIndicatorDetails($id)
    {
        $this->db->select("`indicator_name`,
        `indicator_modal_name`,
        `indicator_aria_label`,
        `indicator_formula`,
        `indicator_num_tab_panes`
        from `tbl_dashboard_indicators`
        where `pk_dashboard_indicators` = '".$id."'
        and `display` = 'Yes'", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }


    function getIndicatorReportLinks($id)
    {
        $this->db->select("`fk_dashboard_indicators`,
         `report_name`,
          `report_link`
        from `tbl_dashboard_reports_links`
        where `fk_dashboard_indicators` = '".$id."'
        and `display` = 'Yes'", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }



    function getIndicatorDataSourceLinks($id)
    {
        $this->db->select("`datasource_name`,
        `datasource_link`
        from `tbl_dashboard_datasource_links`
        where `fk_dashboard_indicators` = '".$id."'
        and `display` = 'Yes'", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

}

