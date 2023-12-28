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
}
