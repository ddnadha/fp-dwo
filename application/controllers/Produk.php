<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('ProductModel');
    }

    public function index()
    {
        $dt = array();
        $dt['totalProduk'] = $this->ProductModel->count();
        $dt['data'] = $this->ProductModel->data();

        if ($this->session->userdata('logged_in')) {
            $this->data['view']     = 'page/produk';
            $this->data['param']    = $dt;
            $this->data['js']       = 'produk.js';
            $this->load->view('template/default', $this->data);
        } else {
            redirect('Auth');
        }
    }

    public function topProdukSales()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data = $this->ProductModel->topProductSales($tahun, $bulan);

        $callback = array('product' => $data);

        echo json_encode($callback);
    }

    public function topProductPurchase()
    {
        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        $data = $this->ProductModel->topProductPurchase($tahun, $bulan);

        $callback = array('product' => $data);

        echo json_encode($callback);
    }

    public function categorySales()
    {
        $data = $this->ProductModel->kategori();
        $kategori = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->group = $g->category;
            $obj->total = (float)$g->persen;
            $obj->jumlah = (int) $g->jumlah;
            $drill = array();
            $sub = $this->ProductModel->subKategori($g->category);

            foreach ($sub as $t) {
                $objsub = new stdClass;
                $objsub->name = $t->sub_category;
                $objsub->y = (float)$t->persen;
                $objsub->custom = (int) $t->jumlah;
                array_push($drill, $objsub);
            }

            $obj->drill = $drill;
            array_push($kategori, $obj);
        }
        echo json_encode($kategori);
    }
}
