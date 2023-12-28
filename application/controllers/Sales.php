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
        
        $byStore = $this->sales->SalesByStore(isset($_GET['category']) ? $_GET['category'] : null);
        $this->data['view']     = 'page/sales';
        $this->data['param']    = [
            'category'  => $byCategory, 
            'region'    => $byRegion, 
            'shipment'  => $byShipment,
            'store'     => $byStore,
        ];
        $this->data['js']       = 'sales.js';
        $this->load->view('template/default', $this->data);
    }
}
