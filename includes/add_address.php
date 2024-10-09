<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_DEFAULT);
    $city = filter_input(INPUT_POST, 'city', FILTER_DEFAULT);
    $state = filter_input(INPUT_POST, 'state', FILTER_DEFAULT);
    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
    $zip = filter_input(INPUT_POST, 'zip', FILTER_DEFAULT);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_DEFAULT);
    
    $submit = $mysqli->query("INSERT INTO addresses (id_user, street, country, city, state, zip, phone) VALUES ('$id','$street','$country','$city','$state','$zip','$phone')"); 
    
    if($submit){
        $output = json_encode(array('success' => true, 'text' => 'Your address is registed!'));
        header("Content-Type: application/json", true);
        die($output);
    }else{
        $output = json_encode(array('success' => false, 'text' => 'Erro na insercao dos dados | Error : ('. $mysqli->errno .') '. $mysqli->error));
        header("Content-Type: application/json", true);
        die($output);
    }
?>