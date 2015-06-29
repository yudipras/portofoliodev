<?php if(!defined('BASEPATH')) exit('Hacking Attempt : Keluar dari sistem..!!');
class Model_beranda extends CI_Model
{
    public function pim1()
    {
        $query = $this->db->query("SELECT * FROM r_diklat a INNER JOIN pegawai_aktif__ b ON a.NIP = b.NIP WHERE a.diklat LIKE \"%diklatpim 1%\" ");
        return $query->num_rows();

    }

    public function pim2()
    {
        $query = $this->db->query("SELECT * FROM r_diklat a INNER JOIN pegawai_aktif__ b ON a.NIP = b.NIP WHERE a.diklat LIKE \"%diklatpim 2%\" ");
        return $query->num_rows();

    }

    public function pim3()
    {
        $query = $this->db->query("SELECT * FROM r_diklat a INNER JOIN pegawai_aktif__ b ON a.NIP = b.NIP WHERE a.diklat LIKE \"%diklatpim 3%\" ");
        return $query->num_rows();

    }

    public function pim4()
    {
        $query = $this->db->query("SELECT * FROM r_diklat a INNER JOIN pegawai_aktif__ b ON a.NIP = b.NIP WHERE a.diklat LIKE \"%diklatpim 4%\" ");
        return $query->num_rows();

    }

}
