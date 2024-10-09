<?php
    header("Content-Type: text/html; charset=utf-8",true);
    include_once 'includes/db_connect.php';
    include_once 'includes/functions.php';
    sec_session_start();
    
    if(isset($_GET['pag'])){
        $pag = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
    }else {
        $pag='';
    }

    if (login_check($mysqli) == true){
        $log = "in";
    }else{
        $log = "out";
    }
    
    $noauth = "<h2>Não tem autorização para aceder a esta pagina!</h2>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Costa Phones</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    </head>
    <body>
        <?php
            //Navbar
            if ($log == "in"){
                include_once 'navbar2.php';
            } else {
                include_once 'navbar.php';
            }
            
            //Page content
            switch($pag){
                default: 
                    include 'home.php';
	            break;
                case '':
                    include 'home.php';
                    break;
                case 'login':
                    include 'login.php';
                    break;
                case 'register':
                    include 'register.php';
                    break;
                case 'about':
                    include 'aboutus.php';
                    break;
                case 'phones':
                    include 'phones.php';
                    break;
                case 'phoneview':
                    include 'prod_view.php';
                    break;
                case 'contact':
                    include 'contact.php';
                    break;
                case 'cart':
                    if($log == 'in'){
                        include 'cart.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'user':
                    if($log == 'in'){
                        include 'user.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'edituser':
                    if($log == 'in'){
                        include 'edit_user.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'editpw':
                    if($log == 'in'){
                        include 'edit_pw.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'addprod':
                    if($log == 'in' && $cat >= 1){
                            include 'add_produto.php';
                    }else{
                            echo $noauth;
                    }
                    break;
                case 'editprod':
                    if($log == 'in' && $cat >= 1){
                            include 'edit_produto.php';
                    }else{
                            echo $noauth;
                    }
                    break;
                case 'guser':
                    if($log == 'in' && $cat == 2){
                            include 'ges_user.php';
                    }else{
                            echo $noauth;
                    }
                    break;
                case 'adduser':
                    if($log == 'in' && $cat == 2){
                            include 'add_user.php';
                    }else{
                            echo $noauth;
                    }
                    break;
                case 'order':
                    if($log == 'in'){
                        include 'order.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'orderlist':
                    if($log == 'in'){
                        include 'order_list.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'orderview':
                    if($log == 'in'){
                        include 'order_view.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'addaddress':
                    if($log == 'in'){
                        include 'add_address.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'editaddress':
                    if($log == 'in'){
                        include 'edit_address.php';
                    }else{
                        echo $noauth;
                    }
                    break;
                case 'shipping':
                    if($log == 'in' && $cat >= 1){
                            include 'shipping.php';
                    }else{
                            echo $noauth;
                    }
                    break;
                case 'addshipping':
                    if($log == 'in' && $cat >= 1){
                        include 'add_shipping.php';
                    }else{
                            echo $noauth;
                    }
                    break;
            }

        include 'footer.php';
      
      ?>
        
        <script type="text/javascript">
            var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || 
            {widgetcode:"1e1e925b87d424fbaf9ab9ac167ff92bd34ca28c48666c35b1dd657f1a40eb68134669e048bf282ef2a99bfe63c97fbd", values:{},ready:function(){}};
            var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
            s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
        </script>

  </body>

</html>
