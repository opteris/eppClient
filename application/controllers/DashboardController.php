<?php
/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 9/25/2015
 * Time: 11:55 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class DashboardController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->model('Monthlystaffreporting_model');
        $this->load->model('Annualloe_model');
        $this->load->model('Mostprofitableprojects_model');
        $this->load->model('Menu_model');

        $this->load->model('Dashindicatordetails_model');
        $this->load->model('Dashindicatorone_model');
        $this->load->model('Dashindicatortwo_model');
        $this->load->model('Dashindicatorthree_model');
        $this->load->model('Dashindicatorfour_model');

        $this->load->library('pagination');
    }


    public function index()
    {
        $pageName=array('page_name' => 'Dashboard');
        $this->session->set_userdata($pageName);

        /*start to fetch indicator details*/


        $data['get_all_monthly_effort_in_hours'] = $this->Monthlystaffreporting_model->getAllMonthlyEffortInHours();
        $data['get_highest_monthly_single_user_loe'] = $this->Monthlystaffreporting_model->highestMonthlySingleUserLoe();
        foreach ($data['get_highest_monthly_single_user_loe'] as $row) {
            $xtra_sessiondata = array('highest_user' => $row->fullNames );
            $this->session->set_userdata($xtra_sessiondata);
        }
        $highestName=$this->session->userdata['highest_user'];
        $data['get_all_users_loe_without_highest'] = $this->Monthlystaffreporting_model->allUsersLoeWithoutHighest($highestName);
        $data['get_loe_foreach_month'] = $this->Annualloe_model->getLOEForeachMonth();
        $data['get_five_profitable_projects'] = $this->Mostprofitableprojects_model->getFiveProfitableProjects();
        $data['get_five_costly_projects'] = $this->Mostprofitableprojects_model->getFiveCostlyProjects();

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('Dashboard/dashboardImported_view', $data);
        $this->load->view('footer');
        $this->load->view('dashboard_graph_data');
        $this->load->view('footer_close_tags');

    }

    public function salesDashboard()
    {
        $pageName=array('page_name' => 'Sales Dashboard');
        $this->session->set_userdata($pageName);

        /*start to fetch indicator details*/
        $data['get_all_monthly_effort_in_hours'] = $this->Monthlystaffreporting_model->getAllMonthlyEffortInHours();
        $data['get_highest_monthly_single_user_loe'] = $this->Monthlystaffreporting_model->highestMonthlySingleUserLoe();
        foreach ($data['get_highest_monthly_single_user_loe'] as $row) {
            $xtra_sessiondata = array('highest_user' => $row->fullNames );
            $this->session->set_userdata($xtra_sessiondata);
        }
        $highestName=$this->session->userdata['highest_user'];
        $data['get_all_users_loe_without_highest'] = $this->Monthlystaffreporting_model->allUsersLoeWithoutHighest($highestName);
        $data['get_loe_foreach_month'] = $this->Annualloe_model->getLOEForeachMonth();
        $data['get_five_profitable_projects'] = $this->Mostprofitableprojects_model->getFiveProfitableProjects();
        $data['get_five_costly_projects'] = $this->Mostprofitableprojects_model->getFiveCostlyProjects();


        /*start to fetch indicator details*/
        $data['data_get_i1_Details'] = $this->Dashindicatordetails_model->getIndicatorDetails(1);
        $data['data_get_i1_DS'] = $this->Dashindicatordetails_model->getIndicatorDataSourceLinks(1);
        $data['data_get_i1_RP'] = $this->Dashindicatordetails_model->getIndicatorReportLinks(1);
        $data['data_get_i2_Details'] = $this->Dashindicatordetails_model->getIndicatorDetails(2);
        $data['data_get_i2_DS'] = $this->Dashindicatordetails_model->getIndicatorDataSourceLinks(2);
        $data['data_get_i2_RP'] = $this->Dashindicatordetails_model->getIndicatorReportLinks(2);
        $data['data_get_i3_Details'] = $this->Dashindicatordetails_model->getIndicatorDetails(3);
        $data['data_get_i3_DS'] = $this->Dashindicatordetails_model->getIndicatorDataSourceLinks(3);
        $data['data_get_i3_RP'] = $this->Dashindicatordetails_model->getIndicatorReportLinks(3);
        $data['data_get_i4_Details'] = $this->Dashindicatordetails_model->getIndicatorDetails(4);
        $data['data_get_i4_DS'] = $this->Dashindicatordetails_model->getIndicatorDataSourceLinks(4);
        $data['data_get_i4_RP'] = $this->Dashindicatordetails_model->getIndicatorReportLinks(4);


        $data['data_get_i1_Traders'] = $this->Dashindicatorone_model->getIndicator1traders();
        $data['data_get_i1_Exporters'] = $this->Dashindicatorone_model->getIndicator1exporters();
        $data['data_get_i2_Partnerships'] = $this->Dashindicatortwo_model->getIndicator2valuePartnerships();
        $data['data_get_i3_VolumesPurchased'] = $this->Dashindicatorthree_model->getIndicator3volumesPurchased();
        $data['data_get_i4_VolumesSold'] = $this->Dashindicatorfour_model->getIndicator4volumesSold();

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('Dashboard/dashboardSales_view', $data);
        $this->load->view('footer');
        $this->load->view('dashboard_graph_data');
        $this->load->view('footer_close_tags');

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/DashboardController.php */