<?phpheader("Content-Type: text/html; charset=utf-8",true);include_once 'db_connect.php';include_once 'functions.php';sec_session_start(); if (isset($_POST['email'], $_POST['p'])) {     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);    $password = filter_input(INPUT_POST, 'p', FILTER_DEFAULT); // The hashed password.        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {        // EMAIL INVALIDO        $output = json_encode(array('success' => false, 'type' => 'email', 'text' => 'Email Invalido!'));        header("Content-Type: application/json", true);        die($output);    }     if (login($email, $password, $mysqli) == true) {        // Login success         $output = json_encode(array('success' => true, 'text' => 'blablabla!'));        header("Content-Type: application/json", true);        die($output);    } else {        // Login failed         $output = json_encode(array('success' => false, 'type' => 'login', 'text' => 'Dados de Login Invalidos!'));        header("Content-Type: application/json", true);        die($output);    }} else {    // The correct POST variables were not sent to this page.     $output = json_encode(array('success' => false, 'type' => 'login', 'text' => 'Os dados nao foram enviados!'));    header("Content-Type: application/json", true);    die($output);} ?>