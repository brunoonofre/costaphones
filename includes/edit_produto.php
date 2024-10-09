<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    sec_session_start();
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
    $cores = filter_input(INPUT_POST, 'cores', FILTER_DEFAULT);
    $fotocores = filter_input(INPUT_POST, 'fotocores', FILTER_DEFAULT);
    $preco = filter_input(INPUT_POST, 'preco', FILTER_DEFAULT);
    $foto = filter_input(INPUT_POST, 'foto', FILTER_DEFAULT);
        
    $edit = $mysqli->query("UPDATE produtos SET nome = '".$nome."', descricao = '".$descricao."', cores = '".$cores."', fotocores = '".$fotocores."', preco = '".$preco."', imagem = '".$foto."' WHERE id_produto = $id");
    
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