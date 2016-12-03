<?php
/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 9/25/2015
 * Time: 11:55 AM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class EppMainController extends CI_Controller
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

        $this->load->library('pagination');
    }


    public function index()
    {
        $pageName = array('page_name' => 'Home Page');
        $this->session->set_userdata($pageName);

        $data = '';

        $this->load->view('header');
        $this->load->view('left_nav_menu', $data);
        $this->load->view('EppMain/eppMain_view', $data);
        $this->load->view('footer');
        $this->load->view('footer_close_tags');

    }




}

/* End of file welcome.php */
/* Location: ./application/controllers/EppMainController.php */