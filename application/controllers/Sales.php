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
        $dt['data'] = $this->SalesModel->data();


        if ($this->session->userdata('logged_in')) {
            $this->data['view']    = 'page/sales';
            $this->data['param']    = $dt;
            $this->data['js']    = 'sales.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function salesRev()
    {
        $data = $this->SalesModel->salesTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->revenue;
            $drill = array();
            $bulan = $this->SalesModel->salesBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->revenue]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }

    public function salesTrend()
    {

        $data = $this->SalesModel->salesTrendTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->trend;
            $drill = array();
            $bulan = $this->SalesModel->salesTrendBulan($g->Year);

            foreach ($bulan as $t) {
                $month_name = date("F", mktime(0, 0, 0, (int) $t->Month, 10));

                array_push($drill, [$month_name, (int)$t->trend]);
            }

            $obj->drill = $drill;
            array_push($tahun, $obj);
        }
        echo json_encode($tahun);
    }
}
