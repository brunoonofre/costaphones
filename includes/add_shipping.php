<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    $country = filter_input(INPUT_POST, 'country', FILTER_DEFAULT);
    $shipcost = filter_input(INPUT_POST, 'shipcost', FILTER_DEFAULT);
    
    $submit = $mysqli->query("INSERT INTO shipping (country, shipcost) VALUES ('$country','$shipcost')"); 
    
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