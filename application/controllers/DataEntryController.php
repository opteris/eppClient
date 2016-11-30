<?php
/**successfully*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class DataEntryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->helper('utility');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->library('email');
        /*$this->config->load('custom_config');*/
        $this->load->library('pagination');
        $this->load->model('Project_model');
        $this->load->model('Sales_model');
        $this->load->library("excel");
        $this->load->model('Setups_model');
        $this->load->model('Menu_model');
        $this->load->model('Mycal_model');

    }

    public function timeSheet()
    {

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $prj_id = $this->input->post("filter_TS_projectId");
        $projectId = (!empty($prj_id) or ($prj_id != '')) ? $prj_id : '';
        $milId = $this->input->post("filter_TS_milestoneId");
        $milestoneId = (!empty($milId) or ($milId != '')) ? $milId : '';
        $acId = $this->input->post("filter_TS_activityId");
        $activityId = (!empty($acId) or ($acId != '')) ? $acId : '';


        $data['data_get_all_projects'] = $this->Project_model->getAllProjects($projectId);
        $data['data_get_milestones'] = $this->Project_model->getMilestones($projectId, $milestoneId);
        $data['data_get_activities'] = $this->Project_model->getActivities($projectId, $milestoneId, $activityId);
        $data['data_get_sub_activities'] = $this->Project_model->getSubActivities($projectId, $milestoneId, $activityId);
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($staffId = '');
        $data['data_get_all_status'] = $this->Project_model->getAllStatus();


        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('DataEntry/timeSheet_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function submitTimeSheet()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Time Sheet',
            'filter_TS_projectId' => $this->input->post("filter_TS_projectId"),
            'filter_TS_milestoneId' => $this->input->post("filter_TS_milestoneId"),
            'filter_TS_activityId' => $this->input->post("filter_TS_activityId"),
            'filter_TS_subactivityId' => $this->input->post("filter_TS_subactivityId")
        );
        $this->session->set_userdata($pageAndFilterParameters);

        //set validation rules
        $this->form_validation->set_rules('Date[]', 'Timesheet Date', 'trim|required|callback_date_check_past|callback_date_check_future');
        $this->form_validation->set_rules('day[]', 'Timesheet Day', 'trim|required|callback_day_check');
        $this->form_validation->set_rules('taskDescription[]', 'Task Description', 'trim|required');
        $this->form_validation->set_rules('plannedHours[]', 'Planned Hours', 'trim|required');
        $this->form_validation->set_rules('hoursSpent[]', 'Hours Spent', 'trim|required|callback_hoursSpent_check');
        /*$this->form_validation->set_rules('comment[]', 'Comment', 'trim|callback_string_check');*/
        $this->form_validation->set_rules('statusCode[]', 'Status Code', 'trim|required');


        //run validation check
        if ($this->form_validation->run() == FALSE) {   //validation fails
            echo validation_errors();
        } else {
            //get the form data

            for ($k = 0; $k <= count($this->input->post('loopkey[' . $k . ']')); $k++) {

                $timesheetDate = @date('Y-m-d', @strtotime($this->input->post('Date[0]')));
                $WeekofReporting = date('W', strtotime($timesheetDate));
                $userName = $this->session->userdata['user_id'];
                $userName2 = $this->input->post('staffId[0]');
                $user = (($userName2) != '' or !empty($userName2)) ? $userName2 : $userName;
                $timesheetDay = date('l', strtotime($timesheetDate));

                $projectId = $this->input->post('projectId[0]');
                $milestoneId = $this->input->post('milestoneId[0]');
                $activityId = $this->input->post('activityId[0]');
                $subactivityId = $this->input->post('subactivityId[0]');


                $taskDescription = $this->input->post('taskDescription[' . $k . ']');
                $plannedHours = $this->input->post('plannedHours[' . $k . ']');
                $hoursSpent = $this->input->post('hoursSpent[' . $k . ']');
                $comment = $this->input->post('comment[' . $k . ']');
                $statusCode = $this->input->post('statusCode[' . $k . ']');

                $data = array(
                    'tbl_timeSheetId' => null,
                    'timeSubmitted' => toDay,
                    'projectId' => $projectId,
                    'milestone' => $milestoneId,
                    'activity' => $activityId,
                    'ProjectUpdate' => $subactivityId,
                    'taskDescription' => $taskDescription,
                    'plannedHours' => ($plannedHours * 1.0),
                    'inputHours' => ($hoursSpent * 1.0),
                    'statusCode' => $statusCode,
                    'comment' => $comment,
                    'supervisorComment' => 'Awaiting supervisor comment ',
                    'timesheetDate' => $timesheetDate,
                    'userName' => $user,
                    'WeekofReporting' => $WeekofReporting,
                    'DayoftheWeek' => $timesheetDay,
                    'weeklyAlertStatus' => '',
                    'complianceAward' => 0,
                    'reportedAs' => $this->session->userdata['user_name'],
                    'updatedBy' => $this->session->userdata['user_name'],
                );


                //insert the form data into database
                if ($this->db->insert('tbl_timesheet', $data)) {
                    echo "YES";
                } else {
                    echo "NO";
                }


            }


        }
    }

    public function projects()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:View ORS Projects',
            'projectId' => $this->input->post("filter_P_projectId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);
        $filter_projectId = $this->session->userdata['projectId'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['prj_category'] = $this->Setups_model->get_project_category();
        $data['prj_team_leader'] = $this->Setups_model->get_project_team_leader();
        $data['prj_client_type'] = $this->Setups_model->get_project_client_type();
        $data['prj_country'] = $this->Setups_model->get_country();
        $data['prj_currency'] = $this->Setups_model->get_project_currency();
        $data['prj_platform'] = $this->Setups_model->get_development_platform();
        $data['prj_status'] = $this->Setups_model->get_status();

        $config = array();
        $config["base_url"] = base_url() . '/DataEntryController/projects';
        $config["total_rows"] = $this->Setups_model->record_count_project_records($filter_projectId);
        $config['per_page'] = "10";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config['per_page'];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data_get_all_projects'] = $this->Setups_model->get_project_records($filter_projectId, $config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();


        if ($this->input->post("addProject") == 'Add New Project') {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/projectsCreate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/projects_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function editProjects($projectId)
    {
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['projectId'] = $projectId;

        //fetch data from currency,clientType,teamLeader,country and statusCode tables

        $data['statusCode'] = $this->Setups_model->get_status();
        $data['country'] = $this->Setups_model->get_country();
        $data['teamLeader'] = $this->Setups_model->get_project_team_leader();
        $data['clientType'] = $this->Setups_model->get_project_client_type();
        $data['currency'] = $this->Setups_model->get_project_currency();

        //fetch project record for the given given the projectId
        $data['project_record'] = $this->Setups_model->get_project_record($projectId);


        //set validation rules
        $this->form_validation->set_rules('projectName', 'Project Name', 'trim|required');
        $this->form_validation->set_rules('projectAcronym', 'Project Acronym', 'trim');
        $this->form_validation->set_rules('RefNo', 'Reference Number', 'trim');
        $this->form_validation->set_rules('project_narrative', 'Project Narrative', 'trim|required');
        $this->form_validation->set_rules('version', 'Project Version', 'trim|required');
        $this->form_validation->set_rules('client', 'Client', 'trim|required');
        $this->form_validation->set_rules('client_address', 'Client Address', 'trim|required');
        $this->form_validation->set_rules('ContactPerson', 'Contact Person', 'trim|required');
        $this->form_validation->set_rules('Contacts', 'Contacts', 'trim|required');
        $this->form_validation->set_rules('statusCode', 'Status code', 'callback_combo_check');
        $this->form_validation->set_rules('ProjectValue', 'Project Value', 'trim|required');
        $this->form_validation->set_rules('TeamLeader', 'Team Leader', 'callback_combo_check');
        $this->form_validation->set_rules('ClientType', 'Client Type', 'callback_combo_check');
        $this->form_validation->set_rules('country', 'country', 'callback_combo_check');
        $this->form_validation->set_rules('location_within_country', 'Location', 'trim|required');
        $this->form_validation->set_rules('projectSummary', 'Project Summary', 'trim|required');
        $this->form_validation->set_rules('Amount', 'Project Amount', 'trim|required');
        $this->form_validation->set_rules('value_services_provided_our_firm_in_contract', 'Value of Service Provided', 'trim|required');
        $this->form_validation->set_rules('Currency', 'Currency', 'callback_combo_check');
        $this->form_validation->set_rules('Contract_name', 'Contract Name', 'trim|required');
        $this->form_validation->set_rules('Contract_type', 'Contract Type', 'callback_combo_check');
        $this->form_validation->set_rules('TechnologiesUsed', 'Technologies Used', 'trim|required');
        $this->form_validation->set_rules('projectType', 'Project Type', 'callback_combo_check');
        $this->form_validation->set_rules('Comment', 'Comment', 'trim');
        $this->form_validation->set_rules('search_terms', 'Search terms', 'trim');


        if ($this->form_validation->run() == FALSE) {
            //fail validation
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('SystemSetup/ProjectsUpdate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            //pass validation
            $data = array(
                'projectAcronym' => $this->input->post('projectAcronym'),
                'projectId' => $projectId,
                'RefNo' => $this->input->post('RefNo'),
                'projectName' => $this->input->post('projectName'),
                'project_narrative' => $this->input->post('project_narrative'),
                'version' => $this->input->post('version'),
                'client' => $this->input->post('client'),
                'client_address' => $this->input->post('client_address'),
                'statusCode' => $this->input->post('statusCode'),
                'ProjectValue' => $this->input->post('ProjectValue'),
                'TeamLeader' => $this->input->post('TeamLeader'),
                'ClientType' => $this->input->post('ClientType'),
                'Country' => $this->input->post('country'),
                'location_within_country' => $this->input->post('location_within_country'),
                'projectSummary' => $this->input->post('projectSummary'),
                'Amount' => $this->input->post('Amount'),
                'value_services_provided_our_firm_in_contract' => $this->input->post('value_services_provided_our_firm_in_contract'),
                'Currency' => $this->input->post('Currency'),
                'ContactPerson' => $this->input->post('ContactPerson'),
                'Contacts' => $this->input->post('Contacts'),
                'Contract_name' => $this->input->post('Contract_name'),
                'Contract_type' => $this->input->post('Contract_type'),
                'TechnologiesUsed' => $this->input->post('TechnologiesUsed'),
                'userName' => $this->session->userdata['user_name'],
                'projectType' => $this->input->post('projectType'),
                'Comment' => $this->input->post('Comment'),
                'search_terms' => $this->input->post('search_terms')
            );

            //update employee record
            $this->db->where('tbl_projectId', $projectId);
            $this->db->update('tbl_project', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Project Record is Successfully Updated!</div>');
            redirect('DataEntryController/projects');
        }
    }

    public function addProjects()
    {
        {
            //get the posted filter values
            $pageAndFilterParameters = array(
                'page_name' => 'Data Entry:Add Projects',
                'filter_staffId' => $this->input->post("staffId"),

            );
            $this->session->set_userdata($pageAndFilterParameters);


            $filter_staffId = $this->session->userdata['filter_staffId'];

            $data['data_get_cat'] = $this->Menu_model->Categories();
            $data['data_get_subCat'] = $this->Menu_model->SubCategories();
            $prj_id = $this->input->post("filter_P_projectId");
            $projectId = (!empty($prj_id) or ($prj_id != '')) ? $prj_id : '';
            $data['data_get_all_projects'] = $this->Project_model->getAllProjects($projectId);

            $data['prj_category'] = $this->Setups_model->get_project_category();
            $data['prj_team_leader'] = $this->Setups_model->get_project_team_leader();
            $data['prj_client_type'] = $this->Setups_model->get_project_client_type();
            $data['prj_country'] = $this->Setups_model->get_country();
            $data['prj_currency'] = $this->Setups_model->get_project_currency();
            $data['prj_platform'] = $this->Setups_model->get_development_platform();
            $data['prj_status'] = $this->Setups_model->get_status();
            $data['get_last_prj_id'] = $this->Setups_model->get_lastProjectId();
            foreach ($data['get_last_prj_id'] as $rowHighestProjectId) {
                $lastProjectId = $rowHighestProjectId->lastProjectId;
            }

            //set validation rules

            $this->form_validation->set_rules('prj_name', 'Project Name', 'trim|required');
            $this->form_validation->set_rules('prj_acronym', 'Project Acronym', 'trim|required');
            $this->form_validation->set_rules('prj_category', 'Project Category', 'trim|required|callback_combo_check');
            $this->form_validation->set_rules('prj_version', 'Project Version', 'trim|required');
            $this->form_validation->set_rules('prj_team_leader', 'Project Team Leader', 'trim|required|callback_combo_check');
            $this->form_validation->set_rules('prj_client_name', 'Client Name', 'trim|required');
            $this->form_validation->set_rules('prj_specialClientDate', 'Client special Date', 'trim|required');
            $this->form_validation->set_rules('prj_desc_specialClientDate', 'Decsription of the Client Special Date', 'trim|required');
            $this->form_validation->set_rules('prj_client_type', 'Client Type', 'callback_combo_check');
            $this->form_validation->set_rules('prj_country', 'Project Host Country', 'callback_combo_check');
            $this->form_validation->set_rules('prj_summary', 'Brief Project Summary', 'trim|required');
            $this->form_validation->set_rules('prj_startDate', 'Project Start Date', 'trim|required');
            $this->form_validation->set_rules('prj_endDate', 'Project End Date', 'trim|required');
            $this->form_validation->set_rules('prj_amount', 'Project Contract Amount', 'trim|required');
            $this->form_validation->set_rules('prj_currency', 'Currency of Project Contract Amount', 'callback_combo_check');
            $this->form_validation->set_rules('prj_client_contact', 'Client Contact', 'trim|required');
            $this->form_validation->set_rules('prj_client_contact_address', 'Client Contact Address', 'trim|required');
            $this->form_validation->set_rules('prj_platform', 'Project Implementation Platform', 'callback_combo_check');
            $this->form_validation->set_rules('prj_status', 'Project Current Status', 'callback_combo_check');


            if ($this->form_validation->run() == FALSE) {
                //fail validation
                $this->load->view('header');
                $this->load->view('left_nav_menu', $data);
                $this->load->view('DataEntry/projectsCreate_view', $data);
                $this->load->view('footer');
                $this->load->view('footer_close_tags');
            } else {
                //pass validation  then process Data Array

                $data = array(

                    'tbl_projectId' => null,
                    'projectAcronym' => $this->input->post('prj_acronym'),
                    'project_category' => $this->input->post('prj_category'),
                    'projectId' => ($lastProjectId + 1),
                    'RefNo' => ('DC-PRJ-' . substr("" . thisYear . "", -2) . '-' . ($lastProjectId + 1)),
                    'projectName' => $this->input->post('prj_name'),
                    'version' => $this->input->post('prj_version'),
                    'client' => $this->input->post('prj_client_name'),
                    'client_special_day' => @date('Y-m-d', @strtotime($this->input->post('prj_specialClientDate'))),
                    'client_special_day_description' => $this->input->post('prj_desc_specialClientDate'),
                    'statusCode' => $this->input->post('prj_status'),
                    'startDate' => @date('Y-m-d', @strtotime($this->input->post('prj_startDate'))),
                    'endDate' => @date('Y-m-d', @strtotime($this->input->post('prj_endDate'))),
                    'ProjectValue' => $this->input->post('prj_amount'),
                    'vatRate' => (0.150000005960464480000000),
                    'whtRate' => (0.059999998658895490000000),
                    'percentMargin' => (0.150000005960464480000000),
                    'EnteredBy' => $this->session->userdata['user_name'],
                    'EntryDate' => toDay,
                    'TeamLeader' => $this->input->post('prj_team_leader'),
                    'ClientType' => $this->input->post('prj_client_type'),
                    'Country' => $this->input->post('prj_country'),
                    'projectSummary' => $this->input->post('prj_summary'),
                    'Amount' => $this->input->post('prj_amount'),
                    'Currency' => $this->input->post('prj_currency'),
                    'ContactPerson' => $this->input->post('prj_client_contact'),
                    'Contacts' => $this->input->post('prj_client_contact_address'),
                    'TechnologiesUsed' => $this->input->post('prj_platform'),
                    'projectType' => $this->input->post('prj_client_type'),
                );

                //insert the form data into database
                $this->db->insert('tbl_project', $data);

                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">New ORS Project details added to Database!!!</div>');
                redirect('DataEntry/projects_view');
            }

        }


    }

    public function dailySalesCallSheet()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:View Daily Sales Call Sheet',
            'filter_staffId' => $this->input->post("staffId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);


        /*$staffId = $this->session->userdata['user_id'];*/
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();

        $data['prj_category'] = $this->Setups_model->get_project_category();
        $data['prospect_rating'] = $this->Setups_model->get_prospect_rating();
        $data['prospect_type'] = $this->Setups_model->get_project_client_type();
        $data['prospect_sector'] = $this->Setups_model->get_project_sector_type();
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();

        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('DataEntry/dailySalesCallSheet_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function dailySalesHome()
    {

        //get the posted filter values
        $pageAndFilterParameters = array('page_name' => 'Data Entry:Sales Funnel Home',);
        $this->session->set_userdata($pageAndFilterParameters);
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();


        $data['prj_category'] = $this->Setups_model->get_project_category();
        $data['prospect_rating'] = $this->Setups_model->get_prospect_rating();
        $data['prospect_type'] = $this->Setups_model->get_project_client_type();
        $data['prospect_sector'] = $this->Setups_model->get_project_sector_type();
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();

        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('DataEntry/salesHome_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function dailySalesCallSheetNew()
    {


        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:Daily Sales Call sheet Actuals',

        );
        $this->session->set_userdata($pageAndFilterParameters);
        $staffId = $this->session->userdata['user_id'];
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['prj_category'] = $this->Setups_model->get_project_category();
        $data['prospect_rating'] = $this->Setups_model->get_prospect_rating();
        $data['prospect_type_record'] = $this->Setups_model->get_project_client_type();
        $data['prospect_sector_record'] = $this->Setups_model->get_project_sector_type();
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();
        $data['get_all_sales_plan_weekly'] = $this->Sales_model->getAllSalesPlanWeekly($staffId);


        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('DataEntry/dailySalesCallSheetActual_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function addDailySalesSheet()
    {
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();

        if (isset($_POST["submitSalesSheet"])) {

            $data['prj_category'] = $this->Setups_model->get_project_category();
            $data['prospect_rating'] = $this->Setups_model->get_prospect_rating();
            $data['prospect_type'] = $this->Setups_model->get_project_client_type();
            $data['prospect_sector'] = $this->Setups_model->get_project_sector_type();
            $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();


            //set validation rules

            $this->form_validation->set_rules('activity_date', 'Call Activity Date', 'trim|required|callback_date_check_past|callback_date_check_sales_past');
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required');
            $this->form_validation->set_rules('client_location', 'Client Location', 'trim|required');
            $this->form_validation->set_rules('client_contact', 'Client Contact', 'trim|required');
            $this->form_validation->set_rules('type_of_call', 'Type of Call', 'trim|required');
            $this->form_validation->set_rules('call_purpose', 'Call Purpose', 'trim|required');
            $this->form_validation->set_rules('closing_remarks', 'Closing Remarks', 'trim|required');
            $this->form_validation->set_rules('action_points', 'Action Points', 'trim|required');
            $this->form_validation->set_rules('prospect_rating', 'Prospect or Client Rating', 'callback_combo_check');
            $this->form_validation->set_rules('next_follow_up_date', 'Next Follow Up Date', 'trim|required|callback_date_check_sales_today');

            if ($this->form_validation->run() == FALSE) {
                //fail validation
                echo validation_errors();
            } else {
                //pass validation  then process Data Array
                $commitment = (empty($this->input->post('client_commitment')) || ($this->input->post('client_commitment') == '')) ? 0 : $this->input->post('client_commitment');

                $data = array(
                    'tbl_call_sheet_actualsId' => null,
                    'user_id' => $this->session->userdata['user_id'],
                    'tbl_call_sheet_plannerId' => $this->input->post('plannerd_id'),
                    'activity_date' => @date('Y-m-d', @strtotime($this->input->post('activity_date'))),
                    'company_name' => $this->input->post('company_name'),
                    'client_location' => $this->input->post('client_location'),
                    'key_decision_maker' => $this->input->post('key_decision_maker'),
                    'product_of_interest' => $this->input->post('prj_category'),
                    'special_client_date' => @date('Y-m-d', @strtotime($this->input->post('special_client_date'))),
                    'desc_special_client_date' => $this->input->post('desc_special_client_date'),
                    'client_using_competitor_product' => $this->input->post('client_using_competitor_product'),
                    'desc_competitor_product' => $this->input->post('desc_competitor_product'),
                    'client_already_using_our_product' => $this->input->post('client_already_using_our_product'),
                    'desc_inhouse_product' => $this->input->post('desc_inhouse_product'),
                    'client_contact' => $this->input->post('client_contact'),
                    'type_of_call' => $this->input->post('type_of_call'),
                    'client_commitment' => $commitment,
                    'call_comment' => $this->input->post('call_comment'),
                    'call_purpose' => $this->input->post('call_purpose'),
                    'call_opening_conversation' => $this->input->post('call_opening_conversation'),
                    'call_sales_story' => $this->input->post('call_sales_story'),
                    'benefits_to_customer' => $this->input->post('benefits_to_customer'),
                    'objections_response' => $this->input->post('objections_response'),
                    'closing_remarks' => $this->input->post('closing_remarks'),
                    'action_points' => $this->input->post('action_points'),
                    'prospect_rating' => $this->input->post('prospect_rating'),
                    'next_follow_up_date' => @date('Y-m-d', @strtotime($this->input->post('next_follow_up_date'))),
                );

                //insert the form data into database
                if ($this->db->insert('tbl_call_sheet_actuals', $data)) {
                    echo "YES";
                } else {
                    echo "NO";
                }


            }

        }


    }

    public function salesTargets()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:View Sales Targets',
            'filter_staffId' => $this->input->post("staffId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);


        $filter_staffId = $this->session->userdata['filter_staffId'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();

        $config = array();
        $config["base_url"] = base_url() . '/index.php/DataEntryController/salesTargets';
        $config["total_rows"] = $this->Sales_model->record_count_sales_target_records($filter_staffId);
        $config['per_page'] = "20";
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config['per_page'];
        $config["num_links"] = floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['data_get_all_targets'] = $this->Sales_model->get_sales_targets_records($filter_staffId, $config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['data_get_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();
        $data['financial_year'] = $this->Setups_model->get_financial_years();


        if ($this->input->post("addTarget") == 'Add New Target') {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/salesTargetCreate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/salesTarget_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function addSalesTargets()
    {
        {
            //get the posted filter values
            $pageAndFilterParameters = array(
                'page_name' => 'Data Entry:Add Sales Targets',
                'filter_staffId' => $this->input->post("staffId"),

            );
            $this->session->set_userdata($pageAndFilterParameters);


            $filter_staffId = $this->session->userdata['filter_staffId'];

            $data['data_get_cat'] = $this->Menu_model->Categories();
            $data['data_get_subCat'] = $this->Menu_model->SubCategories();
            $data['financial_year'] = $this->Setups_model->get_financial_years();
            $data['data_get_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();


            //set validation rules

            $this->form_validation->set_rules('financial_year', 'Financial Year', 'trim|required|callback_financial_year_check');
            $this->form_validation->set_rules('block_commercial_team_target', 'Block Commercial Team Target', 'trim|required');
            $this->form_validation->set_rules('qtr_one_commercial_team_target', 'Quarter One Commercial Team Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']');
            $this->form_validation->set_rules('qtr_two_commercial_team_target', 'Quarter Two Commercial Team Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']');
            $this->form_validation->set_rules('qtr_three_commercial_team_target', 'Quarter Three Commercial Team Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']');
            $this->form_validation->set_rules('qtr_four_commercial_team_target', 'Quarter Four Commercial Team Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']');

            $this->form_validation->set_rules('target_Jan[]', 'January Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_one_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Feb[]', 'February Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_one_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Mar[]', 'March Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_one_commercial_team_target') . ']');

            $this->form_validation->set_rules('target_Apr[]', 'April Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_two_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_May[]', 'May Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_two_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Jun[]', 'June Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_two_commercial_team_target') . ']');

            $this->form_validation->set_rules('target_Jul[]', 'July Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_three_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Aug[]', 'August Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_three_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Sep[]', 'September Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_three_commercial_team_target') . ']');

            $this->form_validation->set_rules('target_Oct[]', 'October Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_four_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Nov[]', 'November Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_four_commercial_team_target') . ']');
            $this->form_validation->set_rules('target_Dec[]', 'December Target', 'trim|less_than[' . $this->input->post('block_commercial_team_target') . ']|less_than[' . $this->input->post('qtr_four_commercial_team_target') . ']');


            if ($this->form_validation->run() == FALSE) {
                //fail validation
                $this->load->view('header');
                $this->load->view('left_nav_menu', $data);
                $this->load->view('DataEntry/salesTargetCreate_view', $data);
                $this->load->view('footer');
                $this->load->view('footer_close_tags');
            } else {
                //pass validation  then process Data Array

                $financial_year_id = $this->input->post('financial_year');
                $block_team_target = $this->input->post('block_commercial_team_target');
                $target_qtr_one = $this->input->post('qtr_one_commercial_team_target');
                $target_qtr_two = $this->input->post('qtr_two_commercial_team_target');
                $target_qtr_three = $this->input->post('qtr_three_commercial_team_target');
                $target_qtr_four = $this->input->post('qtr_four_commercial_team_target');

                $data = array(
                    'financial_year_id' => $financial_year_id = (!empty($financial_year_id)) ? $financial_year_id : 0,
                    'block_team_target' => $block_team_target = (!empty($block_team_target)) ? $block_team_target : 0,
                    'target_qtr_one' => $target_qtr_one = (!empty($target_qtr_one)) ? $target_qtr_one : 0,
                    'target_qtr_two' => $target_qtr_two = (!empty($target_qtr_two)) ? $target_qtr_two : 0,
                    'target_qtr_three' => $target_qtr_three = (!empty($target_qtr_three)) ? $target_qtr_three : 0,
                    'target_qtr_four' => $target_qtr_four = (!empty($target_qtr_four)) ? $target_qtr_four : 0,
                    'id_who_added' => $this->session->userdata['user_id'],
                    'date_created' => toDay,
                    'date_last_updated' => toDay,
                );

                //insert the form data into database
                $this->db->insert('tbl_commercial_team_block_targets', $data);

                for ($k = 0; $k <= count($this->input->post('target_loop_key[' . $k . ']')); $k++) {
                    //Insert to write to second Table
                    $target_member_id = $this->input->post('target_member_id[' . $k . ']');
                    $target_Jan = $this->input->post('target_Jan[' . $k . ']');
                    $target_Feb = $this->input->post('target_Feb[' . $k . ']');
                    $target_Mar = $this->input->post('target_Mar[' . $k . ']');
                    $target_Apr = $this->input->post('target_Apr[' . $k . ']');
                    $target_May = $this->input->post('target_May[' . $k . ']');
                    $target_Jun = $this->input->post('target_Jun[' . $k . ']');
                    $target_Jul = $this->input->post('target_Jul[' . $k . ']');
                    $target_Aug = $this->input->post('target_Aug[' . $k . ']');
                    $target_Sep = $this->input->post('target_Sep[' . $k . ']');
                    $target_Oct = $this->input->post('target_Oct[' . $k . ']');
                    $target_Nov = $this->input->post('target_Nov[' . $k . ']');
                    $target_Dec = $this->input->post('target_Dec[' . $k . ']');

                    $data_tbl_2 = array(
                        'staff_id' => $target_member_id,
                        'financial_year_id' => $financial_year_id,
                        'target_Jan' => $target_Jan = (!empty($target_Jan)) ? $target_Jan : 0,
                        'target_Feb' => $target_Feb = (!empty($target_Feb)) ? $target_Feb : 0,
                        'target_Mar' => $target_Mar = (!empty($target_Mar)) ? $target_Mar : 0,
                        'target_Apr' => $target_Apr = (!empty($target_Apr)) ? $target_Apr : 0,
                        'target_May' => $target_May = (!empty($target_May)) ? $target_May : 0,
                        'target_Jun' => $target_Jun = (!empty($target_Jun)) ? $target_Jun : 0,
                        'target_Jul' => $target_Jul = (!empty($target_Jul)) ? $target_Jul : 0,
                        'target_Aug' => $target_Aug = (!empty($target_Aug)) ? $target_Aug : 0,
                        'target_Sep' => $target_Sep = (!empty($target_Sep)) ? $target_Sep : 0,
                        'target_Oct' => $target_Oct = (!empty($target_Oct)) ? $target_Oct : 0,
                        'target_Nov' => $target_Nov = (!empty($target_Nov)) ? $target_Nov : 0,
                        'target_Dec' => $target_Dec = (!empty($target_Dec)) ? $target_Dec : 0,
                        'date_created' => toDay,
                        'date_last_updated' => toDay,
                    );

                    //insert the form data into database
                    $this->db->insert('tbl_commercial_team_targets', $data_tbl_2);


                }

                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Sales Targets successfully added</div>');
                redirect('DataEntryController/salesTargets');


            }

        }


    }

    function closeSale()
    {
        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:Sale Closure',
            'filter_staffId' => $this->input->post("staffId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);
        $addSale = ($this->input->post('closeSale') == "Close Sale") ? $this->input->post('closeSale') : '';

        $filter_staffId = $this->session->userdata['user_id'];
        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();
        $data['data_get_all_closed_sales'] = $this->Sales_model->getAllClosedSales($filter_staffId);
        $data['data_get_all_call_sheets'] = $this->Sales_model->getAllSalesCallSheets($filter_staffId);

        if ($addSale != '') {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/closeSaleCreate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('DataEntry/closeSale_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }
    }

    public function addCloseSale()
    {
        {
            $filter_staffId = $this->session->userdata['user_id'];
            $data['data_get_cat'] = $this->Menu_model->Categories();
            $data['data_get_subCat'] = $this->Menu_model->SubCategories();
            $data['get_all_sales_team'] = $this->Sales_model->getAllSalesTeamStaff();
            $data['data_get_all_closed_sales'] = $this->Sales_model->getAllClosedSales($filter_staffId);
            $data['data_get_all_call_sheets'] = $this->Sales_model->getAllSalesCallSheets($filter_staffId);


            //set validation rules

            $this->form_validation->set_rules('staffId', 'Sales Executive', 'trim|required|callback_check_sale_close_staff');
            $this->form_validation->set_rules('call_sheet_id', 'Call Sheet', 'trim|required');
            $this->form_validation->set_rules('client_full_name', 'Client Full Name', 'trim|required');
            $this->form_validation->set_rules('client_acronym', 'Client Acronym', 'trim');
            $this->form_validation->set_rules('sale_close_date', 'Sale Close Date', 'trim|required');
            $this->form_validation->set_rules('sale_contract_signing_date', 'Sale Contract Signing Date', 'trim|required');
            $this->form_validation->set_rules('sale_close_amount_ugx', 'Sale Amount in UGX', 'trim|required');
            $this->form_validation->set_rules('exec_comment', 'Comment', 'trim');

            if ($this->form_validation->run() == FALSE) {
                //fail validation
                $this->load->view('header');
                $this->load->view('left_nav_menu', $data);
                $this->load->view('DataEntry/closeSaleCreate_view', $data);
                $this->load->view('footer');
                $this->load->view('footer_close_tags');
            } else {
                //pass validation

                $data = array(
                    'exec_id' => $this->input->post('staffId'),
                    'call_sheet_id' => $this->input->post('call_sheet_id'),
                    'client_full_name' => $this->input->post('client_full_name'),
                    'client_acronym' => $this->input->post('client_acronym'),
                    'sale_close_date' => @date('Y-m-d', @strtotime($this->input->post('sale_close_date'))),
                    'sale_contract_signing_date' => @date('Y-m-d', @strtotime($this->input->post('sale_contract_signing_date'))),
                    'sale_close_amount_ugx' => $this->input->post('sale_close_amount_ugx'),
                    'exec_comment' => $this->input->post('exec_comment'),
                );

                //insert the form data into database
                $this->db->insert('tbl_closed_sales', $data);

                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Sale Successfully Closed</div>');
                redirect('DataEntryController/closeSale');
            }

        }


    }

    function check_sale_close_staff($str)
    {


        if (($str !== $this->session->userdata['user_id']) and (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '8') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '10') || ($this->session->userdata['role_id'] == '11')))) {
            $this->form_validation->set_message('staffId', 'The %s field cannot accept closure of a Sale for another Sales Executive');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function alpha_space_only($str)
    {
        if (!preg_match("/^[a-zA-Z ]+$/", $str)) {
            $this->form_validation->set_message('alpha_space_only', 'The %s field must contain only alphabets and space');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function date_check_past($str)
    {

        $dateCompared = @date('Y-m-d', @strtotime($str));
        $endDate = date('Y-m-d', strtotime('-7 days'));

        if (($dateCompared < $endDate) and (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '12')))) {
            $this->form_validation->set_message('date_check_past', 'The %s field can not accept reporting for days greater than 7 in the past');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function date_check_future($str)
    {

        $dateCompared = @date('Y-m-d', @strtotime($str));
        $today = date('Y-m-d');

        if (($dateCompared > $today)) {
            $this->form_validation->set_message('date_check_future', 'The %s field can not accept reporting for a date in the future');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function day_check($str)
    {

        for ($k = 0; $k <= count($this->input->post('loopkey[' . $k . ']')); $k++) {
            $timesheetDate = @date('Y-m-d', @strtotime($this->input->post('Date[0]')));
            $timesheetDay = date('l', strtotime($timesheetDate));
            $mg = "The date you selected  $timesheetDate does not Correspond to  the day under which you chose to report The correct day for this date is $timesheetDay ";

            if (($timesheetDay != $str)) {
                $this->form_validation->set_message('day_check', 'The %s field can not accept reporting for this day.' . $mg . '');
                return FALSE;
            } else {
                return TRUE;
            }

        }


    }

    function hoursSpent_check($str)
    {
        if ($str >= 17) {
            $this->form_validation->set_message('hoursSpent_check', 'The %s field can only have a 16 hours at Maximum');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function combo_check($str)
    {
        if ($str == '-SELECT-') {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function string_check($str)
    {
        if (!preg_match('/^[a-z 0-9 .,`~?<>{}!@#$%^&*\-]+$/i', $str)) {
            $this->form_validation->set_message('string_check', 'The %s field cannot contain special characters');
            return false;
        } else {
            return TRUE;
        }
    }

    function financial_year_check($str)
    {
        /*Financial year should be current year
        Unless you Have special privileges
        */

        $dateCompared = @date('Y', @strtotime($str));

        if (($str < $dateCompared) and (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '13') || ($this->session->userdata['role_id'] == '14')))) {
            $this->form_validation->set_message('financial_year', 'The %s field cannot accept input for a Financial Year in the past');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function date_check_sales_today($str)
    {

        $dateCompared = @date('Y-m-d', @strtotime($str));

        if (($str < $dateCompared) and (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9') || ($this->session->userdata['role_id'] == '13') || ($this->session->userdata['role_id'] == '14')))) {
            $this->form_validation->set_message('date_check_sales_today', 'The %s field can not accept the next follow up date to be today or in the past');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function date_check_sales_past($str)
    {

        $dateCompared = @date('Y-m-d', @strtotime($str));
        $endDate = date('Y-m-d', strtotime('-7 days'));

        if (($dateCompared < $endDate) and (!(($this->session->userdata['role_id'] == '1') || ($this->session->userdata['role_id'] == '4') || ($this->session->userdata['role_id'] == '9')))) {
            $this->form_validation->set_message('date_check_sales_past', 'The %s field can not accept sales Activities for days older than 7 in the past');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

/* End of file DataEntryController.php */
/* Location: ./application/controllers/DataEntryController.php */