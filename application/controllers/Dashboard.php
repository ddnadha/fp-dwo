<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('StoreModel');
        $this->load->model('ShipmentModel');
        $this->load->model('SalesModel');
    }

    public function index()
    {
        $dt = array();
        
        $dt['totalProduct'] = $this->ProductModel->count();
        $dt['totalShipment'] = $this->ShipmentModel->count();
        $dt['totalStore'] = $this->StoreModel->count();
        $dt['totalSales'] = $this->SalesModel->count();

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
        $bulan = $this->input->post('bulan');

        $data1 = $this->SalesModel->totalRevenue($tahun, $bulan);
        $data2 = $this->SalesModel->avgRevenue($tahun, $bulan);

        $callback = array('sales' => $data1, 'po' => $data2);
        echo json_encode($callback);
    }
}
