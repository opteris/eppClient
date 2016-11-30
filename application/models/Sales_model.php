<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/9/2016
 * Time: 8:43 AM
 */
class Sales_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }



    function getAllSalesPlanWeekly($staffId){
        $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" where p.user_id  =".$staffId."":"";
        $this->db->select('`a`.`tbl_call_sheet_plannerId`,
                            a.`call_purpose`,
                            IF(DAYNAME(a.activity_date)="Monday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivityMondayActual`,
                            IF(DAYNAME(a.activity_date)="Tuesday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivityTuesdayActual`,
                            IF(DAYNAME(a.activity_date)="Wednesday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivityWednesdayActual`,
                            IF(DAYNAME(a.activity_date)="Thursday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivityThursdayActual`,
                            IF(DAYNAME(a.activity_date)="Friday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivityFridayActual`,
                            IF(DAYNAME(a.activity_date)="Saturday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivitySaturdayActual`,
                            IF(DAYNAME(a.activity_date)="Sunday",  CONCAT((LEFT(`a`.`call_purpose`, 60)),"..."), ("N/S")) as `ActivitySundayActual`,
                            `c`.`user_id`,
                            `c`.`groupCode`,
                            `c`.`activity_name`,
                            `c`.`activity_status`,
                            `c`.`date_planned`,
                            `c`.`display`,
                            `c`.`ActivityMonday`,
                            `c`.`ActivityTuesday`,
                            `c`.`ActivityWednesday`,
                            `c`.`ActivityThursday`,
                            `c`.`ActivityFriday`,
                            `c`.`ActivitySaturday`,
                            `c`.`ActivitySunday`,
                            `c`.`fullNames`,
                            `c`.`userName`,
                            `c`.`role`

                            from tbl_call_sheet_actuals a  right outer join
                            (SELECT
                            `p`.`tbl_call_sheet_plannerId`,
                            `p`.`user_id`,
                            `p`.`groupCode`,
                            `p`.`activity_name`,
                            `p`.`activity_status`,
                            `p`.`date_planned`,
                            `p`.`display`,
                            IF(DAYNAME(p.date_planned)="Monday", (`p`.`activity_name`), ("N/S")) as `ActivityMonday`,
                            IF(DAYNAME(p.date_planned)="Tuesday", (`p`.`activity_name`), ("N/S")) as `ActivityTuesday`,
                            IF(DAYNAME(p.date_planned)="Wednesday", (`p`.`activity_name`), ("N/S")) as `ActivityWednesday`,
                            IF(DAYNAME(p.date_planned)="Thursday", (`p`.`activity_name`), ("N/S")) as`ActivityThursday`,
                            IF(DAYNAME(p.date_planned)="Friday", (`p`.`activity_name`), ("N/S")) as `ActivityFriday`,
                            IF(DAYNAME(p.date_planned)="Saturday", (`p`.`activity_name`), ("N/S")) as `ActivitySaturday`,
                            IF(DAYNAME(p.date_planned)="Sunday", (`p`.`activity_name`), ("N/S")) as `ActivitySunday`,
                            `s`.`fullNames`,
                            `s`.`userName`,
                            `g`.`groupName` as `role`
                            FROM tbl_staff_groups as g,
                            tbl_staff as s
                            join tbl_call_sheet_planner as p on (`s`.`tbl_staffId` = `p`.`user_id`)
                            where `g`.`tbl_staff_groupsId` = `s`.`groupCode`
                            and p.display = "Yes"
                            order by p.date_planned desc
                            ) as c
                            on c.tbl_call_sheet_plannerId=`a`.`tbl_call_sheet_plannerId`
                             WHERE 1', false);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllClosedSales($staffId){
        if( (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '13')))){
            $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" and `s`.`exec_id`  =".$staffId."":"";
        }else{
            $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" and `s`.`exec_id`  like '%' ":" ";
        }


        $this->db->select('1,
        `s`.`pk_id`,
        `s`.`exec_id`,
        `sf`.`fullNames`,
        `s`.`call_sheet_id`,
        `s`.`client_full_name`,
        `s`.`client_acronym`,
        `s`.`sale_close_date`,
        `s`.`sale_contract_signing_date`,
        `s`.`sale_close_amount_ugx`,
        `s`.`exec_comment`,
        `a`.`user_id`,
        `a`.`tbl_call_sheet_plannerId`,
        `a`.`activity_date`,
        `a`.`company_name`
        FROM `tbl_closed_sales` as `s`
        join `tbl_call_sheet_actuals` as `a`
        on (`a`.`tbl_call_sheet_actualsId` = `s`.`call_sheet_id`)
        join `tbl_staff` as `sf` on  (`sf`.`tbl_staffId` = `s`.`exec_id`)
        where 1=1
        '.$query_append_staffId.'
        order by `s`.`sale_close_date` DESC', false);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getSalesPipeline($staffId, $limit, $start){
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
        $this->db->limit($limit, $start);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllSalesPlan($staffId)
    {
        $query_append_staffId = (!empty($staffId) or ($staffId != '')) ? " and user_id  =" . $staffId . "" : "";
        $this->db->select('
        `tbl_call_sheet_plannerId`,
         `user_id`,
          `groupCode`,
           `activity_name`,
            `activity_status`,
            `start_date`,
             `end_date`,
             `date_planned`,
             `date_created`,
              `display`
        FROM `tbl_call_sheet_planner`
        where year(start_date)='.thisYear.'
      '.$query_append_staffId.'', false);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }

    function getAllSalesTeamStaff()
    {
        $this->db->select(" * FROM `tbl_staff` where groupCode in (5,6,13,14) and staffStatus='Active' ORDER BY `tbl_staffId`  DESC", FALSE);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
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

    // Count all record of table "contact_info" in database.
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

    // Fetch data according to per_page limit.
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


    // Count all record of table "contact_info" in database.
    public function record_count_sales_target_records($staffId) {

        $appendToQuery_staffId=(($staffId == '') or empty($staffId))?'':$this->db->where('s.tbl_staffId', $staffId);
        $this->db->select('`ct`.`pk_id`,
                        `s`.`fullNames`,
                        `d`.`name` as `designationName`,
                        `s`.`userName`,
                        `fy`.`financial_year`,
                        `ct`.`target_Jan`,
                        `ct`.`target_Feb`,
                        `ct`.`target_Mar`,
                        `ct`.`target_Apr`,
                        `ct`.`target_May`,
                        `ct`.`target_Jun`,
                        `ct`.`target_Jul`,
                        `ct`.`target_Aug`,
                        `ct`.`target_Sep`,
                        `ct`.`target_Oct`,
                        `ct`.`target_Nov`,
                        `ct`.`target_Dec`',false);
        $this->db->from('`tbl_financial_years` as fy, tbl_commercial_team_targets as ct');
        $this->db->join('tbl_staff as s', '`s`.`tbl_staffId` = `ct`.`staff_id`');
        $this->db->join('tbl_designation as d', '`d`.`tbl_designationId` = `s`.`designation`');
        $appendToQuery_staffId;
        $this->db->where('`fy`.`tbl_financial_yearsId` =`ct`.`financial_year_id`');
        $this->db->where('`ct`.`display`', 'Yes');
        $this->db->order_by('`ct`.`pk_id`', 'desc');

        return  $this->db->count_all_results();
    }

    // Fetch data according to per_page limit.
    public function get_sales_targets_records($staffId, $limit, $start) {

        $appendToQuery_staffId=(($staffId == '') or empty($staffId))?'':$this->db->where('s.tbl_staffId', $staffId);
        $this->db->select('`ct`.`pk_id`,
                        `s`.`fullNames`,
                        `d`.`name` as `designationName`,
                        `s`.`userName`,
                        `fy`.`financial_year`,
                        `ct`.`target_Jan`,
                        `ct`.`target_Feb`,
                        `ct`.`target_Mar`,
                        `ct`.`target_Apr`,
                        `ct`.`target_May`,
                        `ct`.`target_Jun`,
                        `ct`.`target_Jul`,
                        `ct`.`target_Aug`,
                        `ct`.`target_Sep`,
                        `ct`.`target_Oct`,
                        `ct`.`target_Nov`,
                        `ct`.`target_Dec`',false);
        $this->db->from('`tbl_financial_years` as fy, tbl_commercial_team_targets as ct');
        $this->db->join('tbl_staff as s', '`s`.`tbl_staffId` = `ct`.`staff_id`');
        $this->db->join('tbl_designation as d', '`d`.`tbl_designationId` = `s`.`designation`');
        $appendToQuery_staffId;
        $this->db->where('`fy`.`tbl_financial_yearsId` =`ct`.`financial_year_id`');
        $this->db->where('`ct`.`display`', 'Yes');
        $this->db->order_by('`ct`.`pk_id`', 'desc');
        $this->db->limit($limit, $start);

        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }



    }

    function  getAllSalesCallSheets($staffId){
        $query_append_staffId=(!empty($staffId) or ($staffId !=''))?" and `a`.`user_id`  =".$staffId."":" and `a`.`user_id`  like \"%\"";
        $this->db->select('1,`a`.`tbl_call_sheet_actualsId`,
        concat("Sales Call to ",`a`.`company_name`," for ",`z`.`full_name`," Product") as `SalesCall`
        FROM `tbl_call_sheet_actuals`  as `a`
        join `tbl_project_categorization` as `z`
        on (`z`.`tbl_project_categorizationId` = `a`.`product_of_interest`)
        where 1=1
        and `a`.`tbl_call_sheet_actualsId` not in (SELECT call_sheet_id FROM `tbl_closed_sales`)
        '.$query_append_staffId.'
        order by `a`.`activity_date` DESC', false);
        $db_rows = $this->db->get();

        if ($db_rows->num_rows() > 0) {
            foreach ($db_rows->result() as $data) {
                $db_data_fetched_array[] = $data;
            }
            return $db_data_fetched_array;
        }
    }
}

