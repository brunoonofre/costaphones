<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    
    $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
    $cores = filter_input(INPUT_POST, 'cores', FILTER_DEFAULT);
    $fotocores = filter_input(INPUT_POST, 'fotocores', FILTER_DEFAULT);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_DEFAULT);
    $foto = filter_input(INPUT_POST, 'foto', FILTER_DEFAULT);
    
    $submit = $mysqli->query("INSERT INTO produtos (nome, descricao, cores, fotocores, preco, imagem) VALUES ('$nome','$descricao','$cores','$fotocores','$preco','$foto')"); 
    
    if($submit){
        $output = json_encode(array('success' => true, 'text' => 'Produto registado com sucesso!'));
        header("Content-Type: application/json", true);
        die($output);
    }else{
        $output = json_encode(array('success' => false, 'text' => 'Erro na insercao dos dados | Error : ('. $mysqli->errno .') '. $mysqli->error));
        header("Content-Type: application/json", true);
        die($output);
    }
?>