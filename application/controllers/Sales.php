<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('SalesModel');
    }

    public function index()
    {
        $dt = array();
        $dt['revenue'] = $this->SalesModel->totalRevenue();
        $dt['total'] = $this->SalesModel->count();


        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/sales';
            $this->data['param']    = $dt;
            $this->data['js']    = 'sales.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }
}
