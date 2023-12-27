<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shipment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('ShipmentModel');
    }

    public function index()
    {
        $dt = array();
        $dt['totalShipment'] = $this->ShipmentModel->count();
        $dt['data'] = $this->ShipmentModel->data();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']     = 'page/shipment';
            $this->data['param']    = $dt;
            $this->data['js']       = 'shipment.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function topShipment()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data = $this->ShipmentModel->topShipment($tahun, $bulan);

        $callback = array('product' => $data);

        echo json_encode($callback);
    }
}
