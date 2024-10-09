<?php
    $cat = 0;
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
        <li class="nav-item <?php if($pag == 'login'){echo 'active';} ?>">
          <a class="nav-link" href="login"><span class="fa fa-sm fa-sign-in-alt"></span> Login
              <?php if($pag == 'login'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
        <li class="nav-item <?php if($pag == 'register'){echo 'active';} ?>">
          <a class="nav-link" href="register"><span class="fa fa-xs fa-user-plus"></span> Sign Up
              <?php if($pag == 'register'){echo '<span class="sr-only">(current)</span>';} ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>