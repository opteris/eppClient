<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */
class Projectsearch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    function getProjectProfile($search_term)
    {
        $query_append_search_term = (!empty($search_term) or ($search_term != '')) ? " WHERE search_terms like  '%" . $search_term . "%'" : " WHERE projectName like '%'";
        $this->db->select(" * FROM tbl_project " . $query_append_search_term . "  order by projectName asc", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }
}

