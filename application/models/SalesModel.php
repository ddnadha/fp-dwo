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
}
