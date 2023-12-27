<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
            $this->data['view']     = 'page/store';
            $this->data['param']    = $dt;
            $this->data['js']       = 'store.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }
}
