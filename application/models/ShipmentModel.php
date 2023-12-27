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
}
