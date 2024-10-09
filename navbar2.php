<?php
    
    $results = $mysqli->query("SELECT * FROM members WHERE id = ".$_SESSION['user_id']);
    $rowuser = $results->fetch_array();

    $userid = $_SESSION['user_id'];
    $name_user = $rowuser['name'];
    $username = $rowuser['username'];
    $useremail = $rowuser['email'];
    $cat = $rowuser['category']*1;

    $cart = $mysqli->query("SELECT SUM(c.quantidade) as quantidade, SUM(p.preco*c.quantidade) as preco 
    	FROM cart c 
    	INNER JOIN produtos p 
    	ON p.id_produto=c.id_produto 
    	WHERE id_user = $userid");
	$rowcart = $cart->fetch_array();

	$quantidade = $rowcart['quantidade'];
	$preco = $rowcart['preco'];
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container quicksand">
    <a class="navbar-brand" href="/costaphones/"><img src="img/logo.png" height="50" alt="Costa Phones"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if($pag == ''){echo 'active';} ?>">
          <a class="nav-link" href="/costaphones">Home
              <?php if($pag == ''){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="nav-item <?php if($pag == 'about'){echo 'active';} ?>">
          <a class="nav-link" href="about">About Us
              <?php if($pag == 'about'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="nav-item <?php if($pag == 'phones'){echo 'active';} ?>">
          <a class="nav-link" href="phones">iPhones
              <?php if($pag == 'phones'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="nav-item <?php if($pag == 'contact'){echo 'active';} ?>">
          <a class="nav-link" href="contact">Contacts
              <?php if($pag == 'contact'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="nav-item <?php if($pag == 'cart'){echo 'active';} ?>">
          <a class="nav-link" href="cart"> 
              <span class="fa fa-shopping-cart"></span> <?php if($preco != ''){echo '€';}?><span id="carttotal"><?php echo $preco; ?></span>
              <?php if($pag == 'cart'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span> <?php echo $name_user; ?></a>
            <ul class="dropdown-menu">
                <li class="nav-item <?php if($pag == 'user'){echo 'active';} ?>"><a class="nav-link" href="user"><span class="fa fa-user"></span> Profile</a></li>
                <li class="nav-item <?php if($pag == 'orderlist'){echo 'active';} ?>"><a class="nav-link" href="orderlist"><span class="fa fa-truck"></span> Orders</a></li>
                <?php if($cat == 2){ ?>
                <li class="nav-item <?php if($pag == 'guser'){echo 'active';} ?>"><a class="nav-link" href="guser"><span class="fa fa-users"></span> Gestão de Utilizadores</a></li>
                <li class="nav-item <?php if($pag == 'shipping'){echo 'active';} ?>"><a class="nav-link" href="shipping"><span class="fa fa-ship"></span>  Shipping Locations</a></li>
                <?php }else if($cat == 1){ ?>
                <li class="nav-item <?php if($pag == 'stock'){echo 'active';} ?>"><a class="nav-link" href="stock"><span class="fa fa-cut"></span> Stock</a></li>
                <?php } ?>
                <li><a class="nav-link" href="includes/logout.php"><span class="fa fa-sign-out-alt"></span> Log Out</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>