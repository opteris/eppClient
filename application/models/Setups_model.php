<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */
class Setups_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    //get department table to populate the country name dropdown
    function get_country()
    {
        $this->db->select('countryCode');
        $this->db->select('countryName');
        $this->db->from('tbl_country');
        $this->db->where('memberstatus', 'Yes');
        $this->db->order_by('countryName', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $country_id = array('-SELECT-');
        $country_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($country_id, $result[$i]->countryCode);
            array_push($country_name, $result[$i]->countryName);
        }
        return $country_result = array_combine($country_id, $country_name);
    }
    //get designation table to populate the designation dropdown
    function get_designation()
    {
        $this->db->select('tbl_designationId');
        $this->db->select('name');
        $this->db->from('tbl_designation');
        $this->db->where('display', 'Yes');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        $designation_id = array('-SELECT-');
        $designation_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($designation_id, $result[$i]->tbl_designationId);
            array_push($designation_name, $result[$i]->name);
        }
        return $designation_result = array_combine($designation_id, $designation_name);
    }
    //get designation table to populate the designation dropdown
    function get_gender()
    {
        $this->db->select('tbl_genderId');
        $this->db->select('name');
        $this->db->from('tbl_gender');
        $this->db->where('display', 'Yes');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        $gender_id = array('-SELECT-');
        $gender_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($gender_id, $result[$i]->tbl_genderId);
            array_push($gender_name, $result[$i]->name);
        }
        return $gender_result = array_combine($gender_id, $gender_name);
    }
    //get designation table to populate the staff groups dropdown
    function get_staffGroups()
    {
        $this->db->select('tbl_staff_groupsId');
        $this->db->select('groupName');
        $this->db->from('tbl_staff_groups');
        $this->db->order_by('groupName', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        $group_id = array('-select Role-');
        $group_name = array('-select Role-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($group_id, $result[$i]->tbl_staff_groupsId);
            array_push($group_name, $result[$i]->groupName);
        }
        return $group_result = array_combine($group_id, $group_name);
    }
    function get_staff_record($staffId)
    {
        $this->db->where('tbl_staffId', $staffId);
        $this->db->from('tbl_staff');
        $query = $this->db->get();
        return $query->result();
    }
    function get_financial_years()
    {
        $this->db->select('tbl_financial_yearsId');
        $this->db->select('financial_year');
        $this->db->from('tbl_financial_years');
        $this->db->where('display', 'Yes');
        $this->db->order_by('tbl_financial_yearsId', 'desc');
        $query = $this->db->get();
        $result = $query->result();

        //array to store financial id & financial_year name
        $financial_year_id = array('-SELECT-');
        $financial_year_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($financial_year_id, $result[$i]->tbl_financial_yearsId);
            array_push($financial_year_name, $result[$i]->financial_year);
        }
        return $financial_year_result = array_combine($financial_year_id, $financial_year_name);
    }
    function deleteStaffMember($id )
    {

        $status = 'Left';
        $data = array('staffStatus' => $status);
        $this->db->where('tbl_staffId', $id);
        $this->db->update('tbl_staff', $data);
    }
    //get department table to populate the country name dropdown
    function get_project_category()
{
    $this->db->select('tbl_project_categorizationId');
    $this->db->select('full_name');
    $this->db->from('tbl_project_categorization');
    $this->db->where('display', 'Yes');
    $this->db->order_by('tbl_project_categorizationId', 'asc');
    $query = $this->db->get();
    $result = $query->result();

    //array to store department id & department name
    $project_category_id = array('-SELECT-');
    $project_category_name = array('-SELECT-');

    for ($i = 0; $i < count($result); $i++) {
        array_push($project_category_id, $result[$i]->tbl_project_categorizationId);
        array_push($project_category_name, $result[$i]->full_name);
    }
    return $project_category_result = array_combine($project_category_id, $project_category_name);
}
    function get_project_team_leader()
    {
        $groupIds = array(1, 4, 8, 9);
        $this->db->select('tbl_staffId');
        $this->db->select('groupCode');
        $this->db->select('fullNames');
        $this->db->select('groupCode');
        $this->db->from('tbl_staff');
        $this->db->where('staffStatus', 'Active');
        $this->db->where_in('groupCode', $groupIds);
        $this->db->order_by('fullNames', 'asc');
        $query = $this->db->get();
        $result = $query->result();


        //array to store department id & department name
        $team_leader_id = array('-SELECT-');
        $team_leader_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($team_leader_id, $result[$i]->tbl_staffId);
            array_push($team_leader_name, $result[$i]->fullNames);
        }
        return $team_leader_result = array_combine($team_leader_id, $team_leader_name);
    }
    function get_project_client_type()
{
    $this->db->select('tbl_client_categorizationId');
    $this->db->select('full_name');
    $this->db->from('tbl_client_categorization');
    $this->db->where('display', 'Yes');
    $this->db->order_by('full_name', 'asc');
    $query = $this->db->get();
    $result = $query->result();


    //array to store department id & department name
    $client_type_id = array('-SELECT-');
    $client_type_name = array('-SELECT-');

    for ($i = 0; $i < count($result); $i++) {
        array_push($client_type_id, $result[$i]->tbl_client_categorizationId);
        array_push($client_type_name, $result[$i]->full_name);
    }
    return $client_type_result = array_combine($client_type_id, $client_type_name);
}
    function get_project_sector_type()
    {
        $this->db->select('tbl_client_sector_categoryId');
        $this->db->select('full_name');
        $this->db->from('tbl_client_sector_category');
        $this->db->where('display', 'Yes');
        $this->db->order_by('full_name', 'asc');
        $query = $this->db->get();
        $result = $query->result();


        //array to store department id & department name
        $client_type_id = array('-SELECT-');
        $client_type_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($client_type_id, $result[$i]->tbl_client_sector_categoryId);
            array_push($client_type_name, $result[$i]->full_name);
        }
        return $client_type_result = array_combine($client_type_id, $client_type_name);
    }
    function get_prospect_rating()
    {
        $this->db->select('tbl_sales_lead_prospect_statusId');
        $this->db->select('statusCode');
        $this->db->from('tbl_sales_lead_prospect_status');
        $this->db->where('display', 'Yes');
        $this->db->order_by('statusCode', 'asc');
        $query = $this->db->get();
        $result = $query->result();


        //array to store department id & department name
        $prospect_rating_id = array('-SELECT-');
        $prospect_rating_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($prospect_rating_id, $result[$i]->tbl_sales_lead_prospect_statusId);
            array_push($prospect_rating_name, $result[$i]->statusCode);
        }
        return $prospect_rating_result = array_combine($prospect_rating_id, $prospect_rating_name);
    }
    function get_project_currency()
    {
        $this->db->select('tbl_currencyId');
        $this->db->select('Currency');
        $this->db->from('tbl_currency');
        $this->db->where('display', 'Yes');
        $this->db->order_by('Currency', 'asc');
        $query = $this->db->get();
        $result = $query->result();


        //array to store department id & department name
        $currency_id = array('-SELECT-');
        $currency_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($currency_id, $result[$i]->tbl_currencyId);
            array_push($currency_name, $result[$i]->Currency);
        }
        return $currency_result = array_combine($currency_id, $currency_name);
    }
    function get_development_platform()
    {
        $this->db->select('tbl_platformsId');
        $this->db->select('name');
        $this->db->from('tbl_primary_development_platforms');
        $this->db->where('display', 'Yes');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $result = $query->result();


        //array to store department id & department name
        $platform_id = array('-SELECT-');
        $platform_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($platform_id, $result[$i]->tbl_platformsId);
            array_push($platform_name, $result[$i]->name);
        }
        return $platform_result = array_combine($platform_id, $platform_name);
    }
    function get_status()
    {
        $this->db->select('tbl_statusId');
        $this->db->select('statusCode');
        $this->db->from('tbl_status');
        $this->db->where('display', 'Yes');
        $this->db->order_by('statusCode', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $status_id = array('-SELECT-');
        $status_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++) {
            array_push($status_id, $result[$i]->tbl_statusId);
            array_push($status_name, $result[$i]->statusCode);
        }
        return $status_result = array_combine($status_id, $status_name);
    }
    function get_lastProjectId()
    {
        $this->db->select(' max(tbl_projectId) as lastProjectId FROM `tbl_project`',false);
        $db_rows = $this->db->get();
        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }
    public function record_count_login_records($staffId) {

        $appendToQuery_staffId=(($staffId == '') or empty($staffId))?'':$this->db->where('s.tbl_staffId', $staffId);
        $this->db->select('`v`.`login_id`,
                            `s`.`fullNames`,
                            `s`.`userName`,
                            `s`.`email`,
                            (case  when `s`.`gender`=1 then "Male"  when `s`.`gender`=2 then "Female" else "-" end) as `gender`,
                            `g`.`groupName` as `role`,
                            `d`.`name` as `designation`,
                            `v`.`time`,
                            `v`.`ip_address`', false);
        $this->db->from('`tbl_designation` d, view_login as v');
        $this->db->join('tbl_staff as s', '`s`.`tbl_staffId` = `v`.`user_id`');
        $this->db->join('tbl_staff_groups as g', '`g`.`tbl_staff_groupsId` = `s`.`groupCode`');
        $appendToQuery_staffId;
        $this->db->where('`s`.`designation` = `d`.`tbl_designationId`');
        $this->db->where('`d`.`display`', 'Yes');
        $this->db->order_by('v.login_id', 'desc');

        return  $this->db->count_all_results();
    }
    public function get_login_records($staffId, $limit, $start) {

        $appendToQuery_staffId=(($staffId == '') or empty($staffId))?'':$this->db->where('s.tbl_staffId', $staffId);
        $this->db->select('`v`.`login_id`,
                            `s`.`fullNames`,
                            `s`.`userName`,
                            `s`.`email`,
                            (case  when `s`.`gender`=1 then "Male"  when `s`.`gender`=2 then "Female" else "-" end) as `gender`,
                            `g`.`groupName` as `role`,
                            `d`.`name` as `designation`,
                            `v`.`time`,
                            `v`.`ip_address`', false);
        $this->db->from('`tbl_designation` d, view_login as v');
        $this->db->join('tbl_staff as s', '`s`.`tbl_staffId` = `v`.`user_id`');
        $this->db->join('tbl_staff_groups as g', '`g`.`tbl_staff_groupsId` = `s`.`groupCode`');
        $appendToQuery_staffId;
        $this->db->where('`s`.`designation` = `d`.`tbl_designationId`');
        $this->db->where('`d`.`display`', 'Yes');
        $this->db->order_by('v.login_id', 'desc');
        $this->db->limit($limit, $start);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }



    }
    public function record_count_project_records($projectId) {

        $appendToQuery_projectId=(($projectId == '') or empty($projectId))?'':$this->db->where('`p`.`tbl_projectId`', $projectId);
        $this->db->select(' `p`.*, `c`.`countryCode`,`c`.`countryName` ', false);
        $this->db->from('`tbl_project` as `p`');
        $this->db->join('`tbl_country` as `c`', '`c`.`countryCode` = `p`.`Country`');
        $appendToQuery_projectId;
        $this->db->order_by('`p`.`projectName`', 'desc');
        return  $this->db->count_all_results();
    }
    public function get_project_records($projectId, $limit, $start) {

        $appendToQuery_projectId=(($projectId == '') or empty($projectId))?'':$this->db->where('`p`.`tbl_projectId`', $projectId);
        $this->db->select(' `p`.*, `c`.`countryCode`,`c`.`countryName` ', false);
        $this->db->from('`tbl_project` as `p`');
        $this->db->join('`tbl_country` as `c`', '`c`.`countryCode` = `p`.`Country`');
        $appendToQuery_projectId;
        $this->db->order_by('`p`.`projectName`', 'desc');
        $this->db->limit($limit, $start);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }

    }
    public function get_project_record($projectId) {

        $appendToQuery_projectId=(($projectId == '') or empty($projectId))?'':$this->db->where('`p`.`tbl_projectId`', $projectId);
        $this->db->select(' `p`.*, `c`.`countryCode`,`c`.`countryName` ', false);
        $this->db->from('`tbl_project` as `p`');
        $this->db->join('`tbl_country` as `c`', '`c`.`countryCode` = `p`.`Country`');
        $appendToQuery_projectId;
        $this->db->order_by('`p`.`projectName`', 'desc');
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }

    }
    public function record_count_sales_pipeline_records($staffId) {

        if( (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '13')))){
            $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" and `sp`.`sales_exec_id`  =".$staffId."":"";
        }else{
            $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" and `sp`.`sales_exec_id`  like '%' ":" ";
        }


        $this->db->select('1,
                    `s`.`fullNames` as `sales_executive`,
                    `pr`.`full_name` as `assignment`,
                    `sp`.`amount_quoted`, `date_sale_made`,
                    `sp`.`assignment_start_date`,
                    `sp`.`assignment_end_date`,
                    `a`.`company_name` as `client`
                    from `sales_pipe_line` as `sp`
                    join `tbl_call_sheet_actuals` as `a`
                    on (`a`.`tbl_call_sheet_actualsId` = `sp`.`client_id`)
                    join `tbl_staff` as `s`
                    on (`s`.`tbl_staffId` = `a`.`user_id`),
                    `tbl_project_categorization` as `pr`
                    where 1=1
                    and `pr`.`tbl_project_categorizationId` = `sp`.`call_sheet_product_of_interest_id`
                    '.$query_append_staffId.'
                    order by `sp`.`pk_id` DESC', false);

        return  $this->db->count_all_results();
    }


}

