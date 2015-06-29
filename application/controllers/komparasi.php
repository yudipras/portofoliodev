<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komparasi extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('model_pegawai');
    $this->load->model('model_hitung');
    $this->load->model('model_komparasi');
    $this->load->database();
  }

  public function index()
  {
    $this->load->view("komparasi");
  }

  public function autocomp()
  {
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      $autocomp = $this->model_komparasi->get_autocomp($q);
      echo json_encode($autocomp);
    }
  }

  public function add_compare()
  {

    $nip = $this->input->get('term');
    $dcompare[0] = $this->model_pegawai->fotopeg($nip);
    $dcompare[1] = $nip;
    $nama_pegawai = $this->model_pegawai->nama_pegawai($nip);
    $dcompare[2] = $nama_pegawai->nama;

    $n_pendidikan = $this->model_hitung->pendidikan($nip);
    $n_diklat_pim = $this->model_hitung->diklat_pim($nip);
    $n_golongan = $this->model_hitung->golongan($nip);
    $n_masa_kerja = $this->model_hitung->masa_kerja($nip);
    $n_total = $n_pendidikan + $n_diklat_pim + $n_golongan + $n_masa_kerja;

    $dcompare[3] = $n_total;
    $dcompare[4] = $n_pendidikan;
    $dcompare[5] = $n_diklat_pim;
		$dcompare[6] = $n_golongan;
		$dcompare[7] = $n_masa_kerja;

    $r_jabatan = $this->model_komparasi->r_jabatan($nip);
    foreach ($r_jabatan as $keyjab) {
      $kode_jab = $keyjab->kode_jab;
      $kode_seksi = $keyjab->kode_seksi;
      $kode_subdir = $keyjab->kode_subdir;
      $kode_dir = $keyjab->kode_dir;
      $tmt = $keyjab->tmt;

      $jabatan = $this->model_komparasi->jabatan($kode_jab);
      if (!empty($kode_dir)) {
        $unit_kerja = $this->model_komparasi->unit_kerja($kode_dir,$kode_subdir,$kode_seksi);        # code...
      }
      else {
        $unit_kerja = $keyjab->unit_lama;
      }
      if (!empty($jabatan)) {
        $d_r_jabatan[0] = "<b>".$jabatan."</b> (".$tmt.")";
      }
      else {
        $d_r_jabatan[0] = "";
      }
      $d_r_jabatan[1] = "<p>".$unit_kerja."</p>";
      $array_r_jabatan[] = $d_r_jabatan;
    }
    $dcompare[8] = $array_r_jabatan;

    $r_golongan = $this->model_komparasi->r_golongan($nip);
    foreach ($r_golongan as $keygol) {
      $d_r_golongan[0] = "<b>-</b> ".$keygol->gol." (".$keygol->tmt.")<br>";
      $array_r_golongan[] = $d_r_golongan;
    }
    $dcompare[9] = $array_r_golongan;

    $r_pendidikan = $this->model_komparasi->r_pendidikan($nip);
    foreach ($r_pendidikan as $keypend) {
      $d_r_pendidikan[0] = "<b>-</b> ".$keypend->nama_pend." (".$keypend->tahun_lulus.")";
      if(!empty($keypend->nama_studi)) {
        $d_r_pendidikan[1] = "&nbsp;&nbsp;".$keypend->nama_studi."<br>";
      }
      else {
        $d_r_pendidikan[1] = "";
      }
      $array_r_pendidikan[] = $d_r_pendidikan;
    }
    $dcompare[10] = $array_r_pendidikan;

    $r_diklat = $this->model_komparasi->r_diklat($nip);
    if (!empty($r_diklat)) {
      foreach ($r_diklat as $keydiklat) {
        $d_r_diklat[0] = "<b>-</b> ".$keydiklat->diklat." (".$keydiklat->tahun_diklat.")<br>";
        //$d_r_diklat[2] = $keydiklat->angkatan;
        $array_r_diklat[] = $d_r_diklat;
      }
    }
    else {
      $array_r_diklat[] = "";
    }

    $dcompare[11] = $array_r_diklat;

    $r_kursus = $this->model_komparasi->r_kursus($nip);
    if (!empty($r_kursus)) {
      foreach ($r_kursus as $keykursus) {
        $d_r_kursus[0] = "<b>-</b> ".$keykursus->kursus." (".$keykursus->thn_kursus.")<br>";
        $array_r_kursus[] = $d_r_kursus;
      }
    }
    else {
      $array_r_kursus[] = "";
    }

    $dcompare[12] = $array_r_kursus;

    $r_tanda_jasa = $this->model_komparasi->r_tanda_jasa($nip);
    if (!empty($r_tanda_jasa)) {
      foreach ($r_tanda_jasa as $keyjasa) {
        $d_r_tanda_jasa[0] = "- ".$keyjasa->tanda_jasa." (".$keyjasa->tahun_perolehan.")<br>";
        $array_r_tanda_jasa[] = $d_r_tanda_jasa;
      }
    }
    else {
      $array_r_tanda_jasa[] = "";
    }
    $dcompare[13] = $array_r_tanda_jasa;

    $this->output->set_output(json_encode($dcompare));
    //echo json_encode($dcompare);
  }

}
