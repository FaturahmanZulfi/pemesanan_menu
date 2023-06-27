<?php

$koneksi = mysqli_connect('localhost','root','','pemesanan_menu2');

function select($table, $field = '*', $where = ''){
    global $koneksi;
    $sql = "SELECT $field FROM $table $where";
    $exe = $koneksi->query($sql);
    return $exe->fetch_all(MYSQLI_ASSOC);
}

function insert($table, $value){
    global $koneksi;
    $sql = "INSERT INTO $table VALUE $value";
    $exe = $koneksi->query($sql);
    if (!$exe) {
        return mysqli_error($koneksi);
    }else{
        return true;
    }
}

function update($table, $set, $where){
    global $koneksi;
    $sql = "UPDATE $table SET $set $where";
    $exe = $koneksi->query($sql);
    if (!$exe) {
        return mysqli_error($koneksi);
    }else{
        return true;
    }
}

function delete($table, $where){
    global $koneksi;
    $sql = "DELETE FROM $table $where";
    $exe = $koneksi->query($sql);
    if (!$exe) {
        return mysqli_error($koneksi);
    }else{
        return true;
    }
}

?>