<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('StoreModel');
    }

    public function index()
    {
        $dt = array();
        $dt['totalStore'] = $this->StoreModel->count();
        $dt['data'] = $this->StoreModel->data();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']     = 'page/store';
            $this->data['param']    = $dt;
            $this->data['js']       = 'store.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function regionSales()
    {
        $data = $this->StoreModel->region();
        $region = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->group = $g->country_region_name;
            $obj->total = (float)$g->persen;
            $obj->jumlah = (int) $g->jumlah;
            $drill = array();
            $ter = $this->StoreModel->territory($g->country_region_name);

            foreach ($ter as $t) {
                $objsub = new stdClass;
                $objsub->name = $t->territory_name;
                $objsub->y = (float)$t->persen;
                $objsub->custom = (int) $t->jumlah;
                array_push($drill, $objsub);
            }

            $obj->drill = $drill;
            array_push($region, $obj);
        }
        echo json_encode($region);
    }
}
