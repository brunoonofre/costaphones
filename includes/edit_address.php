<?php
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
        
    $edit = $mysqli->query("UPDATE addresses SET street = '".$street."', city = '".$city."', state = '".$state."', country = '".$country."', zip = '".$zip."', phone = '".$phone."' WHERE id_user = $id");
    
    if($edit){
        $output = json_encode(array('success' => true, 'text' => 'Dados editados com sucesso!'));
        header("Content-Type: application/json", true);
        die($output);
    }else{
        $output = json_encode(array('success' => false, 'text' => 'Erro na edição de dados! | Error : ('. $mysqli->errno .') '. $mysqli->error));
        header("Content-Type: application/json", true);
        die($output);
    }
?>