<?php
    $success = filter_input(INPUT_GET, 'success', FILTER_DEFAULT);
?>
<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/login.js"></script>
<section id="login">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-4 formcenter">
                <h2 class="titulo">Already registed?</h2>
                <h3 class="texto">If you already created an account, please log in.</h3>
                <?php
                    if (!empty($success))
                    {?>
                    <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo $success; ?></strong>
                </div><?php
                    }
                ?>
                    <div id="errordiv" class="alert alert-danger">
                    <strong id="error"></strong>
                </div>
<!--                <form action="" id="login_form" method="post">-->
                    <div class="form-group">
                        <input type="email" class="form-control inputcp" placeholder="EMAIL" name="email" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputcp" placeholder="PASSWORD" name="password" id="password" />
                    </div>
                    <button name="button" class="btn-lg btn-primary login btncp" onclick="formhash();"><span class="fa fa-sign-in-alt"></span> Log In</button>
<!--                </form>-->
            </div>
        </div>
    </div>
</section>