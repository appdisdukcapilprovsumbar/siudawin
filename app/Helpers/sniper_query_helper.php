<?php

function get_row($table,$where,$output){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)->where($where)->limit(1)->get()->getRow($output);
    }
}

function get_multiple($table,$where,$output){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)->where($where)->get()->getResult($output);
    }
}

function get_multiple_data($table,$where){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)->where($where)->get()->getResult();
    }
}

function update_row($table,$data,$where){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)->where($where)->update($data);
    }
}

function get_count($table,$where){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)->where($where)->countAllResults();
    }
}

function get_bulan_ini($table,$where,$tahun,$bulan){
    $db = \Config\Database::connect();
    if (empty($table)) {
        die('Table not selected'); 
    }else{
        return $db->table($table)
                  ->where($where)
                  ->where('MONTH(tgl_akad_nikah)',$bulan)
                  ->where('YEAR(tgl_akad_nikah)',$tahun)
                  ->countAllResults();
    }
}

function get_bulan_sejak_januari($table,$where,$tahun,$bulan){
    $db = \Config\Database::connect();
    
    $awalTahun = 01;
    $sekarang = $bulan;
    
    if (empty($table)) {
        die('Table not selected');
    }else{
        return $db->table($table)
                  ->where($where)
                  ->where('MONTH(tgl_akad_nikah) >=', $awalTahun)
                  ->where('MONTH(tgl_akad_nikah) <=', $sekarang)
                  ->where('YEAR(tgl_akad_nikah)',$tahun)
                  ->countAllResults();
    }
}
