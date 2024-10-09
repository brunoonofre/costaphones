<?php 
	header("Content-Type: text/html; charset=utf-8",true);
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();


	if (isset($_POST['id_prod'], $_POST['id_user'], $_POST['quantidade'])) {
		$id_prod = filter_input(INPUT_POST, 'id_prod', FILTER_DEFAULT);
		$id_user = filter_input(INPUT_POST, 'id_user', FILTER_DEFAULT);
		$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_DEFAULT);
                $cor = filter_input(INPUT_POST, 'cor', FILTER_DEFAULT);

		$check = $mysqli->query("SELECT * FROM cart WHERE id_produto = $id_prod AND id_user = $id_user");

		$rowcheck = $check->fetch_array();
		$quantold = ($rowcheck['quantidade'])*1;

		if($check->num_rows > 0){

			$quantnew = $quantold + $quantidade;

			$update = $mysqli->query("UPDATE cart SET quantidade = $quantnew WHERE id_produto = $id_prod AND id_user = $id_user");

			if($update){
		        $output = json_encode(array('success' => 'true'));
		        header("Content-Type: application/json", true);
		        die($output);
		    }else{
		        $output = json_encode(array('success' => false, 'text' => 'Erro na conexão com o servidor, volte a tentar!'));
		        header("Content-Type: application/json", true);
		        die($output);
		    }

		}else{

			$submit = $mysqli->query("INSERT INTO cart (id_produto, id_user, quantidade, cor) VALUES ('$id_prod','$id_user','$quantidade','$cor')");

			if($submit){
		        $output = json_encode(array('success' => 'true2'));
		        header("Content-Type: application/json", true);
		        die($output);
		    }else{
		        $output = json_encode(array('success' => false, 'text' => 'Erro na conexão com o servidor, volte a tentar!'));
		        header("Content-Type: application/json", true);
		        die($output);
		    }

		}

	}else{
            $output = json_encode(array('success' => false, 'text' => 'Os dados nao foram enviados!'));
	    header("Content-Type: application/json", true);
	    die($output);
	}
?>