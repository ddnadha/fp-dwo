<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function SalesByCategory($year = null){
        $this->db->select("product.category, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        if($year != null){
            $this->db->join('time', 'fact_sales.time_id = time.time_id', 'inner');
            $this->db->where('time.year',  $year);
        }
        $this->db->group_by('product.category');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }

    public function SalesBySubcategory($category, $year = null){
        $this->db->select("product.sub_category, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        if($year != null){
            $this->db->join('time', 'fact_sales.time_id = time.time_id', 'inner');
            $this->db->where('time.year',  $year);
        }
        $this->db->where("product.category", $category);
        $this->db->group_by('product.sub_category');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }

    public function SalesByRegion($year = null){
        $this->db->select("store.country_region_name, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        $this->db->join('store', 'store.store_id = fact_sales.store_id', 'inner');
        if($year != null){
            $this->db->join('time', 'fact_sales.time_id = time.time_id', 'inner');
            $this->db->where('time.year',  $year);
        }
        $this->db->group_by('store.country_region_name');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }

    public function SalesByTerritory($region, $year = null){
        $this->db->select("store.territory_name, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        $this->db->join('store', 'store.store_id = fact_sales.store_id', 'inner');
        if($year != null){
            $this->db->join('time', 'fact_sales.time_id = time.time_id', 'inner');
            $this->db->where('time.year',  $year);
        }
        $this->db->where("store.country_region_name", $region);
        $this->db->group_by('store.territory_name');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }

    public function SalesByStore($category = null){
        $this->db->select("store.store_name, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        $this->db->join('store', 'store.store_id = fact_sales.store_id', 'inner');
        
        if($category != null) {
            $this->db->where("product.category", $category);
        }
        $this->db->group_by('store.store_name');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }

    public function SalesByShipment($year = null){
        $this->db->select("shipment.shipment_name, product.category, SUM(fact_sales.order_quantity) as qty, SUM(fact_sales.total_due) as total");
        $this->db->from('fact_sales');
        $this->db->join('product', 'product.product_id = fact_sales.product_id', 'inner');
        $this->db->join('shipment', 'shipment.shipment_id = fact_sales.shipment_id', 'inner');
        if($year != null){
            $this->db->join('time', 'fact_sales.time_id = time.time_id', 'inner');
            $this->db->where('time.year',  $year);
        }
        $this->db->group_by('shipment.shipment_name, product.category');
        $this->db->order_by('qty', 'desc');
        return $this->db->get()->result();
    }
}
