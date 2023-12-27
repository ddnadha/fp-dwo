<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $dt = array();
        
        $dt['totalProduct'] = $this->ProductModel->count();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/dashboard';
            $this->data['param']    = $dt;
            $this->data['js']    = 'dashboard.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function fakta()
    {
        $tahun = $this->input->post('tahun');
        $kuartal = $this->input->post('kuartal');
        $bulan = $this->input->post('bulan');

        // $data1 = $this->SalesModel->totalRevenue($tahun, $kuartal, $bulan);
        // $data2 = $this->PurchaseModel->totalExpanses($tahun, $kuartal, $bulan);

        // $callback = array('sales' => $data1, 'po' => $data2);
        // echo json_encode($callback);
    }
}
