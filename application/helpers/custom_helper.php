<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  function cnv($cnv)
  {
    $roman = array(
                    "I"   => 1,
                    "II"  => 2,
                    "III" => 3,
                    "IV"  => 4
                  );
    $alphabet = array(
                    "a" => 1,
                    "b" => 2,
                    "c" => 3,
                    "d" => 4,
                    "e" => 5,
                  );
    $pecah = explode("/",$cnv);
    $nmb1=$roman[$pecah[0]];
    $nmb2=$alphabet[$pecah[1]];
    $nmb3=$nmb1.$nmb2;
    return $nmb3;
  }

  function cnvdateindo($date){
    $array_bulan = (1=>"Januari","Febuari","Maret","April","Mei","Juni","Juli",
                    "Agustus","September","Oktober","November","Desember");
    $datesplit = explode("-",$date);
    $tanggal = $datesplit[2];
    $bulan = $array_bulan[$datesplit[1]];
    $tahun = $datesplit[0];

    $dateindo = $tanggal."-".$bulan."-".$tahun;
    return $dateindo;
  }

  function npersen($n,$prsn){
    $x = $n*$prsn/100;
    return $x;
  }
