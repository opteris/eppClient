<?php
/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 1/13/2016
 * Time: 11:33 AM
 */

class Dashindicatorone_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function getIndicator1traders()
    {
        $this->db->select("DISTINCT sum(client_commitment) as numTraders FROM `tbl_call_sheet_actuals` where display='Yes' ", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getIndicator1exporters()
    {
        $this->db->select("DISTINCT COUNT(*) as numExporters FROM `tbl_call_sheet_actuals` where display='Yes' ", FALSE);

        $db_rows_small = $this->db->get();

        if ($db_rows_small->num_rows() > 0) {
            foreach ($db_rows_small->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    }
