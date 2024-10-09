<?php
    include_once 'db_connect.php';

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    
    $delete = $mysqli->query("DELETE FROM shipping WHERE id_shipping = $id");
    $delete2 = $mysqli->query("DELETE FROM addresses WHERE country = $id");
    
    $output = json_encode(array('success' => true));
    header("Content-Type: application/json", true);
    die($output);
