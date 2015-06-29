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
