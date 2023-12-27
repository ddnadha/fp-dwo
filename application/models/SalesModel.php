<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SalesModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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
