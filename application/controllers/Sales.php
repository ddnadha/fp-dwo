<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("SalesModel", "sales");
    }

    public function index(){
        $byCategory = $this->sales->SalesByCategory(isset($_GET['year']) ? $_GET['year'] : null);
        foreach ($byCategory as $category){
            $category->{'subcategory'} = $this->sales->SalesBySubcategory($category->category, isset($_GET['year']) ? $_GET['year'] : null);
        }

        $byRegion = $this->sales->SalesByRegion(isset($_GET['year']) ? $_GET['year'] : null);
        foreach ($byRegion as $region){
            $region->{'territory'} = $this->sales->SalesByTerritory($region->country_region_name, isset($_GET['year']) ? $_GET['year'] : null);
        }

        $byShipment = $this->sales->SalesByShipment();

        $revenue = $this->sales->totalRevenue();
        $total = $this->sales->count();
        $dataSales = $this->sales->data();
        
        $byStore = $this->sales->SalesByStore(isset($_GET['category']) ? $_GET['category'] : null);
        $this->data['view']     = 'page/sales';
        $this->data['param']    = [
            'category'  => $byCategory, 
            'region'    => $byRegion, 
            'shipment'  => $byShipment,
            'store'     => $byStore,
            'revenue'   => $revenue,
            'total'     => $total,
            'dataSales' => $dataSales,
        ];
        $this->data['js']       = 'sales.js';
        $this->load->view('template/default', $this->data);
    }

    public function salesRev()
    {
        $data = $this->sales->salesTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->revenue;
            $drill = array();
            $bulan = $this->sales->salesBulan($g->Year);

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

        $data = $this->sales->salesTrendTahun();
        $tahun = array();

        foreach ($data as $g) {
            $obj = new stdClass;
            $obj->tahun = $g->Year;
            $obj->total = (int)$g->trend;
            $drill = array();
            $bulan = $this->sales->salesTrendBulan($g->Year);

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
