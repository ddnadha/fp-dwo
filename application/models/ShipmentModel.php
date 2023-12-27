<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ShipmentModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function count()
    {
        return $this->db->query('select count(shipment_id) as jumlah from shipment')->row()->jumlah;
    }

    function data()
    {
        return $this->db->query('select * from shipment')->result();
    }

    function topShipment($tahun, $bulan)
    {
        $sql = "";
        if ($tahun != 'all' && $bulan == 'all') {
            $sql = "SELECT s.shipment_name as name, COUNT(s.shipment_name) as total FROM fact_sales fs JOIN shipment s ON fs.shipment_id = s.shipment_id JOIN time t on fs.time_id = t.time_id WHERE t.year=$tahun GROUP BY s.shipment_name ORDER BY total DESC LIMIT 5";
        } else  if ($tahun == 'all' && $bulan != 'all') {
            $sql = "SELECT s.shipment_name as name, COUNT(s.shipment_name) as total FROM fact_sales fs JOIN shipment s ON fs.shipment_id = s.shipment_id JOIN time t on fs.time_id = t.time_id WHERE t.month='$bulan' GROUP BY s.shipment_name ORDER BY total DESC LIMIT 5";
        } else  if ($tahun != 'all' && $bulan != 'all') {
            $sql = "SELECT s.shipment_name as name, COUNT(s.shipment_name) as total FROM fact_sales fs JOIN shipment s ON fs.shipment_id = s.shipment_id JOIN time t on fs.time_id = t.time_id WHERE t.year=$tahun AND t.month='$bulan' GROUP BY s.shipment_name ORDER BY total DESC LIMIT 5";
        } else {
            $sql = "SELECT s.shipment_name AS name, COUNT(s.shipment_name) AS total FROM fact_sales fs JOIN shipment s ON fs.shipment_id = s.shipment_id GROUP BY s.shipment_name ORDER BY total DESC LIMIT 5";
        }
        return $this->db->query($sql)->result();
    }
}
