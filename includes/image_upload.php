<?php
    
    
    $target_dir = "../img/phones/";
//    chmod($target_dir, 0755);
    $target_file = $target_dir . basename($_FILES['image_data']['name']);
    
    //check post via ajax
    if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
      
        //verify file exists and is not empty
        if (!isset($_FILES['image_data']) || !is_uploaded_file($_FILES['image_data']['tmp_name'])){
            $output = json_encode(array('success' => 'false', 'text' => 'A imagem nao foi inserida!'));
            die($output);
        }
        
        //get imagem size info from valid image file
        $image_size_info = getimagesize($_FILES['image_data']['tmp_name']);
        
        if ($image_size_info){
            $image_type = $image_size_info['mime'];            
        }else{
            $output = json_encode(array('success' => 'false', 'text' => 'Ficheiro de imagem invalido!'));
            die($output);
        }
        
        if (move_uploaded_file($_FILES['image_data']['tmp_name'], $target_file)) {
            $output = json_encode(array('success' => 'true', 'text' => 'A imagem foi carregada com sucesso!'));
            die($output);
        } else {
            $output = json_encode(array('success' => 'false', 'text' => 'Occorreu um erro no carregamento da imagem!'));
            die($output);
        }
        
    }