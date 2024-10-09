<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $shipcost = filter_input(INPUT_POST, 'shipcost', FILTER_DEFAULT);
        
    $edit = $mysqli->query("UPDATE shipping SET shipcost = '$shipcost' WHERE id_shipping = $id");
    
    if($edit){
        $output = json_encode(array('success' => true, 'text' => 'Dados editados com sucesso!'));
        header("Content-Type: application/json", true);
        die($output);
    }else{
        $output = json_encode(array('success' => false, 'text' => 'Erro na ediÃ§Ã£o de dados! | Error : ('. $mysqli->errno .') '. $mysqli->error));
        header("Content-Type: application/json", true);
        die($output);
    }
?>