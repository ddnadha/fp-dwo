<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class StoreModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(store_id) as jumlah from store')->row()->jumlah;
    }

    function data()
    {
        return $this->db->query('select * from store')->result();
    }

    function region()
    {
        $sql = "select dp.country_region_name,count(*) as jumlah,round(((count(dp.store_id)*100)/s.total )) as persen from store dp cross join (select count(*) as total from store) s group by dp.country_region_name";
        return $this->db->query($sql)->result();
    }

    function territory($reg)
    {
        $sql = "select dp.territory_name, count(*) as jumlah, round(((count(dp.store_id)*100)/s.total )) as persen from store dp cross join (select count(*) as total from store p where p.country_region_name='$reg') s  where dp.country_region_name='$reg' group by dp.territory_name";

        return $this->db->query($sql)->result();
    }

    function topStore($tahun, $bulan)
    {
        $sql = "";
        if ($tahun != 'all' && $bulan == 'all') {
            $sql = "SELECT s.store_name as name, COUNT(s.store_name) as total FROM fact_sales fs JOIN store s ON fs.store_id = s.store_id JOIN time t on fs.time_id = t.time_id WHERE fs.store_id IS NOT NULL AND t.year=$tahun GROUP BY s.store_name ORDER BY total DESC LIMIT 5";
        } else  if ($tahun == 'all' && $bulan != 'all') {
            $sql = "SELECT s.store_name as name, COUNT(s.store_name) as total FROM fact_sales fs JOIN store s ON fs.store_id = s.store_id JOIN time t on fs.time_id = t.time_id WHERE fs.store_id IS NOT NULL AND t.month='$bulan' GROUP BY s.store_name ORDER BY total DESC LIMIT 5";
        } else  if ($tahun != 'all' && $bulan != 'all') {
            $sql = "SELECT s.store_name as name, COUNT(s.store_name) as total FROM fact_sales fs JOIN store s ON fs.store_id = s.store_id JOIN time t on fs.time_id = t.time_id WHERE fs.store_id IS NOT NULL AND t.year=$tahun AND t.month='$bulan' GROUP BY s.store_name ORDER BY total DESC LIMIT 5";
        } else {
            $sql = "SELECT s.store_name AS name, COUNT(s.store_name) AS total FROM fact_sales fs JOIN store s ON fs.store_id = s.store_id WHERE fs.store_id IS NOT NULL GROUP BY s.store_name ORDER BY total DESC LIMIT 5";
        }
        return $this->db->query($sql)->result();
    }
}
