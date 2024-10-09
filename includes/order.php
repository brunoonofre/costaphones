<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
    $encomenda = filter_input(INPUT_POST, 'encomenda', FILTER_DEFAULT);
    $street = filter_input(INPUT_POST, 'street', FILTER_DEFAULT);
    $state = filter_input(INPUT_POST, 'state', FILTER_DEFAULT);
    $city = filter_input(INPUT_POST, 'city', FILTER_DEFAULT);
    $country = filter_input(INPUT_POST, 'country', FILTER_DEFAULT);
    $zip = filter_input(INPUT_POST, 'zip', FILTER_DEFAULT);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_DEFAULT);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_DEFAULT);
    $shipcost = filter_input(INPUT_POST, 'shipcost', FILTER_DEFAULT);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
    $data = date("Y-m-d H:i:s"); 
    
    $delete = $mysqli->query("DELETE FROM cart WHERE id_user = $userid");
    $submit = $mysqli->query("INSERT INTO orders (id_user, encomenda, street, city, state, country, zip, phone, preco, shipcost, estado, data) VALUES ('$userid','$encomenda','$street','$city','$state','$country','$zip','$phone','$preco','$shipcost','$estado','$data')"); 
    
    if($submit){
        $output = json_encode(array('success' => true, 'text' => 'Encomenda realizada com sucesso'));
        header("Content-Type: application/json", true);
        die($output);
    }else{
        $output = json_encode(array('success' => false, 'text' => 'Erro na insercao dos dados | Error : ('. $mysqli->errno .') '. $mysqli->error));
        header("Content-Type: application/json", true);
        die($output);
    }
?>