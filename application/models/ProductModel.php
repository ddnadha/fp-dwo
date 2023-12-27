<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(product_id) as jumlah from product')->row()->jumlah;
    }

    function data()
    {
        return $this->db->query('select * from product')->result();
    }

    function topProductSales($tahun, $bulan)
    {
        $sql = "";
        if ($tahun != 'all' && $bulan == 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.order_quantity) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where dt.`year` =$tahun group by fs.product_id order by sum(fs.order_quantity) desc limit 5";
        } else  if ($tahun == 'all' && $bulan != 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.order_quantity) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where dt.`month` ='$bulan'  group by fs.product_id order by sum(fs.order_quantity) desc limit 5";
        } else  if ($tahun != 'all' && $bulan != 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.order_quantity) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where (dt.`year` =$tahun and dt.`month`='$bulan') group by fs.product_id order by sum(fs.order_quantity) desc limit 5";
        } else {
            $sql = "select dp.product_name as ProductName ,sum(fs.order_quantity) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id group by fs.product_id order by sum(fs.order_quantity) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }

    function topProductPurchase($tahun, $bulan)
    {
        $sql = "";
        if ($tahun != 'all' && $bulan == 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.total_due) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where dt.`year` =$tahun group by fs.product_id order by sum(fs.total_due) desc limit 5";
        } else  if ($tahun == 'all' && $bulan != 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.total_due) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where dt.`month` ='$bulan'  group by fs.product_id order by sum(fs.total_due) desc limit 5";
        } else  if ($tahun != 'all' && $bulan != 'all') {
            $sql = "select dp.product_name as ProductName ,sum(fs.total_due) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id join time dt on fs.time_id =dt.time_id where (dt.`year` =$tahun and dt.`month`='$bulan') group by fs.product_id order by sum(fs.total_due) desc limit 5";
        } else {
            $sql = "select dp.product_name as ProductName ,sum(fs.total_due) as terjual from fact_sales fs join product dp on fs.product_id =dp.product_id group by fs.product_id order by sum(fs.total_due) desc limit 5";
        }
        return $this->db->query($sql)->result();
    }

    
    function kategori()
    {
        $sql = "select dp.category,count(*) as jumlah,round(((count(dp.product_id)*100)/s.total )) as persen from product dp cross join (select count(*) as total from product) s group by dp.category";
        return $this->db->query($sql)->result();
    }

    function subKategori($kat)
    {
        $sql = "select dp.sub_category, count(*) as jumlah, round(((count(dp.product_id)*100)/s.total )) as persen from product dp cross join (select count(*) as total from product p where p.category='$kat') s  where dp.category='$kat' group by dp.sub_category; ";

        return $this->db->query($sql)->result();
    }
}
