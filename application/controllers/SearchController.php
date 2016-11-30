<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/8/2016
 * Time: 7:38 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class SearchController extends CI_Controller
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
        $this->load->library('pagination');
        $this->load->model('Projectsearch_model');
        $this->load->library("excel");
        $this->load->model('Menu_model');
    }


    public function index()
    {

        //get the posted filter values
        $pageAndFilterParameters = array(
            'page_name' => 'Reports: Project Profile Results'

        );

        $search_term = $this->input->post("project_profile");

        $data['data_get_cat'] = $this->Menu_model->Categories();
        $data['data_get_subCat'] = $this->Menu_model->SubCategories();
        $data['data_get_search_results'] = $this->Projectsearch_model->getProjectProfile($search_term);


            $this->load->view('header');
            $this->load->view('left_nav_menu', $data);
            $this->load->view('Reports/projectProfileSearch_Report_view', $data);
            $this->load->view('footer');
            $this->load->view('footer_close_tags');


    }

}

/* End of file ReportsController.php */
/* Location: ./application/controllers/ReportsController.php */