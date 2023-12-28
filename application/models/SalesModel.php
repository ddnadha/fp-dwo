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

    function count()
    {
        return $this->db->query('select count(*) as total from fact_sales')->row()->total;
    }

    function totalRevenue($tahun = 'all', $kuarter = 'all', $bulan = 'all')
    {
        $sql = "";
        if ($tahun != 'all' && $bulan == 'all') {
            $sql = "select sum(total_due) as total from fact_sales join time on fact_sales.time_id =time.time_id where time.`Year` =$tahun";
        } else  if ($tahun == 'all' && $bulan != 'all') {
            $sql = "select sum(total_due) as total from fact_sales join time on fact_sales.time_id =time.time_id where time.`Month` ='$bulan'";
        } else  if ($tahun != 'all' && $bulan != 'all') {
            $sql = "select sum(total_due) as total from fact_sales join time on fact_sales.time_id =time.time_id where (time.Year=$tahun and time.Month='$bulan')";
        } else {
            $sql = "select sum(total_due) as total from fact_sales";
        }
        return $this->db->query($sql)->row()->total;
    }

    function salesTahun()
    {
        $sql = "select dt.`Year` ,sum(fs.total_due) as revenue from fact_sales fs join time dt ON fs.time_id =dt.time_id group by dt.`Year` ";

        return $this->db->query($sql)->result();
    }

    function salesBulan($tahun)
    {
        $sql = "select dt.`Month`,sum(fs.total_due) as revenue  from fact_sales fs join time dt ON fs.time_id =dt.time_id where dt.`Year` =$tahun group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }

    function salesTrendTahun()
    {
        $sql = "select dt.`Year` ,count(distinct  fs.fact_sales_id) as trend from fact_sales fs join time dt ON fs.time_id =dt.time_id group by dt.`Year` ";

        return $this->db->query($sql)->result();
    }

    function salesTrendBulan($tahun)
    {
        $sql = "select dt.`Month`,count(distinct  fs.fact_sales_id) as trend  from fact_sales fs join time dt ON fs.time_id =dt.time_id where dt.`Year` =$tahun group by dt.`Month` ";
        return $this->db->query($sql)->result();
    }

    function data()
    {
        return $this->db->query('select DISTINCT(fact_sales_id), sum(order_quantity) as quantity, sum(total_due) as total from fact_sales GROUP BY fact_sales_id')->result();
    }

    function avgRevenue()
    {
        return $this->db->query('select avg(total_due) as rata from fact_sales')->row()->rata;
    }
}
