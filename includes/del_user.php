<?php
    include_once 'db_connect.php';

    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
    
    $delete = $mysqli->query("DELETE FROM members WHERE id = $userid");
    $delete2 = $mysqli->query("DELETE FROM cart WHERE id_user = $userid");

    
    $output = json_encode(array('success' => true));
    header("Content-Type: application/json", true);
    die($output);
