<?php
    include_once 'db_connect.php';
    include_once 'functions.php';
    
    sec_session_start();
    
    $oldpassword = filter_input(INPUT_POST, 'oldp', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    
    if (passwordChange($oldpassword, $mysqli) == true) {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

        // Create salted password 
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database
        if ($update_stmt = $mysqli->prepare("UPDATE members SET password=?, salt=? WHERE id =?")) {
            $update_stmt->bind_param('sss', $password, $random_salt, $_SESSION['user_id']);
            // Execute the prepared query.
            if (!$update_stmt->execute()) {                
                $output = json_encode(array('success' => false, 'type' => 'email', 'text' => 'Ocorreu um erro na alteracao da palavra-passe!'));
                header("Content-Type: application/json", true);
                die($output);
            }
        }
        //keep session alive
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
        $output = json_encode(array('success' => true, 'type' => 'email', 'text' => 'aaa'));
        header("Content-Type: application/json", true);
        die($output);
    } else {
        // Login failed 
        $output = json_encode(array('success' => false, 'type' => 'login', 'text' => 'A palavra-passe actual esta incorrecta!'));
        header("Content-Type: application/json", true);
        die($output);
    }