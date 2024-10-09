<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    
    
    $userid = filter_input(INPUT_POST, 'userid', FILTER_SANITIZE_STRING);
    
    //verify user permissions
    $sqluser = $mysqli->query("SELECT id, username, email, name, category FROM members WHERE id = ".$userid);
    $rowuser = $sqluser->fetch_array();
    
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = 'O email inserido nao e valido!';
    }

    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $category = filter_input(INPUT_POST, 'estatuto', FILTER_SANITIZE_STRING);
    
    if ($username != $rowuser['username']){
        // check existing username
        $prep_stmt2 = "SELECT id FROM members WHERE username = ? LIMIT 1";
        $stmt2 = $mysqli->prepare($prep_stmt2);

        if ($stmt2) {
            $stmt2->bind_param('s', $username);
            $stmt2->execute();
            $stmt2->store_result();

            if ($stmt2->num_rows == 1) {
                // A user with this username already exists
                $error_msg = "Nome de utilizador em uso!";
                //                        $stmt2->close();
            }
            $stmt2->close();
        } else {
            $error_msg = "Erro na base de dados!";
            $stmt2->close();
        }
    }
    
    if ($email != $rowuser['email']){
        $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
        $stmt = $mysqli->prepare($prep_stmt);

        // check existing email  
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // A user with this email address already exists
                $error_msg = "Ja existe um utilizador com este email!";
//                                $stmt->close();
            }
            $stmt->close();
        } else {
            $error_msg = "Erro na base de dados!";
            $stmt->close();
        } 
    }
    
    if (empty($error_msg)){
        
        if($category == ''){
            $sql = "UPDATE members SET username='".$username."', email='".$email."', name='".$name."' WHERE id='".$userid."'";
        }else{
            $sql = "UPDATE members SET username='".$username."', email='".$email."', name='".$name."', category='".$category."' WHERE id='".$userid."'";
        }
        $edit = $mysqli->query($sql);
        
        if($edit){
            $output = json_encode(array('success' => true, 'text' => 'Dados actualizados com sucesso!'));
            header("Content-Type: application/json", true);
            die($output);
        }else{
            $output = json_encode(array('success' => false, 'text' => 'Erro na actualização dos dados! | Error : ('. $mysqli->errno .') '. $mysqli->error));
            header("Content-Type: application/json", true);
            die($output);
        }
    
    }else{
        $output = json_encode(array('success' => false, 'type' => 'login', 'text' => $error_msg));
        header("Content-Type: application/json", true);
        die($output);
    }