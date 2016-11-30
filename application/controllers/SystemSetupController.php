<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/8/2016
 * Time: 7:38 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SystemSetupController extends CI_Controller
{
    /*Start Staff members setup*/
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->library('email');
        /*$this->config->load('custom_config');*/
        $this->load->library('pagination');
        $this->load->model('Project_model');
        $this->load->library("excel");
        $this->load->model('Setups_model');
        $this->load->model('Menu_model');
    }

    public function staffMembers()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Data Entry:Add Staff Members',
            'filter_staffId' => $this->input->post("staffId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);


        $filter_staffId = $this->session->userdata['filter_staffId'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['country'] = $this->Setups_model->get_country();
        $data['designation'] = $this->Setups_model->get_designation();
        $data['gender'] = $this->Setups_model->get_gender();
        $data['ugroup'] = $this->Setups_model->get_staffGroups();
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($filter_staffId);


        if ($this->input->post("addUsers") == 'Add Users') {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('SystemSetup/staffMembersCreate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('SystemSetup/staffMembers_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');

        }


    }

    public function deleteStaffMember()
    {

        //get the posted staffId
        $id = $this->uri->segment(3);
        if (!empty($id)) {

            $this->load->model('Setups_model');
            $this->Setups_model->deleteStaffMember($id);
            redirect('SystemSetupController/staffMembers');
        }


    }

    public function addStaffMembers()
    {
        {
            $data['data_get_cat'] = $this->Menu_model->Categories();
            $data['data_get_subCat'] = $this->Menu_model->SubCategories();
            $data['country'] = $this->Setups_model->get_country();
            $data['designation'] = $this->Setups_model->get_designation();
            $data['gender'] = $this->Setups_model->get_gender();
            $data['ugroup'] = $this->Setups_model->get_staffGroups();

            //set validation rules

            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|callback_alpha_only_space');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|callback_alpha_only_space');
            $this->form_validation->set_rules('pusername', 'Preffered Username', 'trim|required|callback_alpha_only_space');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[rpass]|min_length[8]|alpha_numeric');
            $this->form_validation->set_rules('rpass', 'Repeat Password', 'trim|required|min_length[8]|alpha_numeric');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('dob', 'Birthday', 'required');
            $this->form_validation->set_rules('country', 'Country', 'callback_combo_check');
            $this->form_validation->set_rules('gender', 'Gender', 'callback_combo_check');
            $this->form_validation->set_rules('designation', 'Designation', 'callback_combo_check');
            $this->form_validation->set_rules('ugroup', 'User Group', 'callback_combo_check');


            if ($this->form_validation->run() == FALSE) {
                //fail validation
                $this->load->view('header');
                $this->load->view('left_nav_menu', $data);
                $this->load->view('SystemSetup/staffMembersCreate_view', $data);
                $this->load->view('footer');
                $this->load->view('footer_close_tags');
            } else {
                //pass validation
                $s = substr(str_shuffle(str_repeat(defaultRandomStringArray, 6)), 0, 6);
                $data = array(
                    'country' => $this->input->post('country'),
                    'district' => '102',
                    'staffStatus' => 'Active',
                    'groupCode' => $this->input->post('ugroup'),
                    'designation' => $this->input->post('designation'),
                    'userName' => $this->input->post('pusername'),
                    'fullNames' => (($this->input->post('fname')) . '  ' . ($this->input->post('lname'))),
                    'password' => md5($this->input->post('pass')),
                    'EncryptionHint' => $s . $this->input->post('pass'),
                    'EnteredBy' => $this->session->userdata['user_name'],
                    'EntryDate' => toDay,
                    'email' => $this->input->post('email'),
                    'dob' => @date('Y-m-d', @strtotime($this->input->post('dob'))),
                    'gender' => $this->input->post('gender'),
                    'updatedby' => $this->session->userdata['user_name'],
                );

                //insert the form data into database
                $this->db->insert('tbl_staff', $data);

                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">New ORS User details added to Database!!!</div>');
                redirect('SystemSetupController/staffMembers');
            }

        }


    }

    public function editStaffMember($staffId)
    {
        $data['staffId'] = $staffId;

        //fetch data from country,designation,gender and user_group tables
        $data['country'] = $this->Setups_model->get_country();
        $data['designation'] = $this->Setups_model->get_designation();
        $data['gender'] = $this->Setups_model->get_gender();
        $data['ugroup'] = $this->Setups_model->get_staffGroups();

        //fetch staff record for the given given the staffId
        $data['staff_record'] = $this->Setups_model->get_staff_record($staffId);

        //set validation rules
        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('pusername', 'Preffered Username', 'trim|required|callback_alpha_only_space');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|matches[rpass]|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('rpass', 'Repeat Password', 'trim|required|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dob', 'Birthday', 'required');
        $this->form_validation->set_rules('country', 'Country', 'callback_combo_check');
        $this->form_validation->set_rules('gender', 'Gender', 'callback_combo_check');
        $this->form_validation->set_rules('designation', 'Designation', 'callback_combo_check');
        $this->form_validation->set_rules('ugroup', 'User Group', 'callback_combo_check');


        if ($this->form_validation->run() == FALSE) {
            //fail validation
            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('SystemSetup/staffMembersUpdate_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');
        } else {
            //pass validation
            $s = substr(str_shuffle(str_repeat(defaultRandomStringArray, 6)), 0, 6);
            $data = array(
                'country' => $this->input->post('country'),
                'district' => '102',
                'staffStatus' => 'Active',
                'groupCode' => $this->input->post('ugroup'),
                'designation' => $this->input->post('designation'),
                'userName' => $this->input->post('pusername'),
                'fullNames' => $this->input->post('fname') . ' ' . $this->input->post('lname'),
                'password' => md5($this->input->post('pass')),
                'EncryptionHint' => $s . $this->input->post('pass'),
                'EnteredBy' => $this->session->userdata['user_name'],
                'EntryDate' => toDay,
                'email' => $this->input->post('email'),
                'dob' => @date('Y-m-d', @strtotime($this->input->post('dob'))),
                'gender' => $this->input->post('gender'),
                'updatedby' => $this->session->userdata['user_name'],
            );

            //update employee record
            $this->db->where('tbl_staffId', $staffId);
            $this->db->update('tbl_staff', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Staff Record is Successfully Updated!</div>');
            redirect('SystemSetupController/staffMembers/' . $staffId);
        }
    }

    /*End Staff members setup*/
    public function send_email()
    {

        //get the posted staffId
        $id = $this->uri->segment(3);
        $data['staff_record'] = $this->Project_model->getAllStaff($id);
        foreach ($data['staff_record'] as $rowStaff) {


            $fname = $rowStaff->fullNames;
            $username = $rowStaff->userName;
            $password = $rowStaff->EncryptionHint;
            $emailAdress = $rowStaff->email;
        }


        $message = "<p style='font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        font-size: 14px;
        font-style: normal;
        font-variant: normal;
        font-weight: 500;
        line-height: 26.4px;'>";
        $message .= "Dear  <strong>" . $fname . "</strong>,<br/>
        Greetings from ORS Team.Your Logon Credentials are:<br/>
        Username:<strong>" . $username . "</strong><br/>
        Password:<strong>" . substr($password, 6, 300) . "</strong><br/><br/>";

        $message .= "Visit  http://www.dcareug.com/ors to log into the system.<br/>
        Please address any queries and/or feedback to:<br/>
        1.ors@dcareug.com<br/>
        2.support@dcareug.com<br/><br/>

        You are requested to change your password as soon as you log into the system.<br/><br/>

        Yours Sincerely;<br/>
        <strong>ORS TEAM</strong><br/>
        Data Care (U) LTD<br/>
        Plot 2A, Kyambogo Drive, off Martyrs Way<br/>
        Ntinda , Kampala Uganda | www.dcareug.com<br/>
        Office:   +256-312-512-246<br/></p>";


        $this->email->from('ors@dcareug.com', 'ORS Administrator');
        $this->email->to($emailAdress);
        $this->email->cc('rmutesi@dcareug.com');
        $this->email->bcc('aasiimwe@dcareug.com');
        $this->email->subject('ORS Credentials');
        $this->email->message($message);
        /*$this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/1_Farmers Trained.png'); // attach file
        $this->email->attach(''.$_SERVER["DOCUMENT_ROOT"].'/assets/images/email_graphs/2_Hectares Under Production.png');
        */
        /*$this->email->send();*/


        if (!$this->email->send()) {
            //display failure message
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">' . $this->email->print_debugger() . '</div>');
            redirect('SystemSetupController/staffMembers');

        } else {
            $this->email->send();

            $data = array(
                'emailStatus' => 'Sent',
            );

            //update Staff record
            $this->db->where('tbl_staffId', $id);
            $this->db->update('tbl_staff', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Email Sent Successfully</div>');
            redirect('SystemSetupController/staffMembers');
        }

    }

    //custom validation function for dropdown input
    public function combo_check($str)
    {
        if ($str == '-SELECT-') {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //custom validation function to accept only alpha and space input
    public function alpha_only_space($str)
    {
        if (!preg_match("/^([-a-z ])+$/i", $str)) {
            $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }

    public function systemLogins()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'System Setup:View System Logins',
            'filter_staffId' => $this->input->post("staffId"),

        );
        $this->session->set_userdata($pageAndFilterParameters);


        $filter_staffId = $this->session->userdata['filter_staffId'];

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['country'] = $this->Setups_model->get_country();
        $data['designation'] = $this->Setups_model->get_designation();
        $data['gender'] = $this->Setups_model->get_gender();
        $data['ugroup'] = $this->Setups_model->get_staffGroups();


        $config = array();
        $config["base_url"] = base_url() . '/index.php/SystemSetupController/systemLogins';
        $config["total_rows"] = $this->Setups_model->record_count_login_records($filter_staffId);
        $config['per_page'] = "500";
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
        $data['data_get_all_logs'] = $this->Setups_model->get_login_records($filter_staffId, $config['per_page'], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['data_get_all_staff'] = $this->Project_model->getAllStaff($filter_staffId);
        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('SystemSetup/systemLogins_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }

    public function staffPermissions()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'System Setups:Grant/Revoke permissions',
            'permission_role_id' => $this->input->post("ugroup"),

        );
        $this->session->set_userdata($pageAndFilterParameters);


        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['country'] = $this->Setups_model->get_country();
        $data['designation'] = $this->Setups_model->get_designation();
        $data['gender'] = $this->Setups_model->get_gender();
        $data['ugroup'] = $this->Setups_model->get_staffGroups();
        $data['data_get_menu_items'] = $this->Project_model->permissionsModel();
        $data['data_get_current_permits'] = $this->Project_model->currentPermissions($this->input->post("ugroup"));


        if ($this->input->post('btn_saveRoles') == 'Save Roles') {
            $currentRoleId =$this->input->post("role_id");

            //Delete all permissions for $currentRoleId
            $this -> db -> where('role_id', $currentRoleId);
            $this -> db -> delete('tbl_permisions');

            if(count($this->input->post("loopkey"))>0){
                for($x=0;$x<count($this->input->post("item_id"));$x++){
                    //Insert permission in $itemId for $currentRoleId
                    $itemId = $this->input->post('item_id[' . $x . ']');
                    $data = array(
                        'tbl_permisionsId' => null,
                        'role_id' => $currentRoleId,
                        'MenuItem' => $itemId,
                        'EntryDate' => date('Y-m-d H:i:s'),
                        'EnteredBy' => $this->session->userdata['user_name'],
                    );


                    //insert the form data into database
                    if (!$this->db->insert('tbl_permisions', $data)) {
                        //display failure message
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to save role(s)!!</div>');
                        redirect('SystemSetupController/staffPermissions');

                    } else {
                        //display success message
                        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Roles successfully Saved </div>');
                        redirect('SystemSetupController/staffPermissions');
                    }
                }
            }

        }


        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('SystemSetup/permissions_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');


    }



}

/* End of file SystemSetupController.php */
/* Location: ./application/controllers/SystemSetupController.php */