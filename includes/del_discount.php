<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();

    $id_prod = filter_input(INPUT_POST, 'id_prod', FILTER_SANITIZE_STRING);
    
    $delete = $mysqli->query("DELETE FROM discount WHERE id_produto = $id_prod");
    
    $output = json_encode(array('success' => true));
    header("Content-Type: application/json", true);
    die($output);
    
?>