<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    
    $delete = $mysqli->query("DELETE FROM orders WHERE id_order = $id");
    
    $output = json_encode(array('success' => true));
    header("Content-Type: application/json", true);
    die($output);
?>