<?php
/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 1/13/2016
 * Time: 12:08 PM
 */

class Dashindicatortwo_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function getIndicator2valuePartnerships()
    {
        $this->db->select("sum(sale_close_amount_ugx) as valuePartnerships from `tbl_closed_sales`", FALSE);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }





}
