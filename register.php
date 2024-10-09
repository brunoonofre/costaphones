<!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/registo.js"></script>
<section id="registar">
    <div class="container paddingtop">
        <div class="row">
            <div class="col-md-4 formcenter">
                <h2 class="titulo">Register</h2>
                <h3 class="texto">Insert your data and create a new account.</h3>
                    <div id="errordiv" class="alert alert-danger">
                        <strong id="error" ></strong>
                    </div>
<!--                <form action="" method="post" id="registration_form">-->
                    <div class="form-group">
                        <input type="text" class="form-control inputcp" placeholder="USER" name="user" id="user" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control inputcp" placeholder="EMAIL" name="email" id="email" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control inputcp" placeholder="NAME" name="nome" id="nome" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputcp" placeholder="PASSWORD" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputcp" placeholder="CONFIRM PASSWORD" name="confirmpw" id="confirmpw" />
                    </div>
<!--                     <div id="cap" class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LeKjAkTAAAAAKl-UjdS06qcZD__LSNG9HGTyywo"></div>
                    </div>
                   <div class="checkbox">
                        <label>
                            <input type="checkbox" value="" disabled>
                            <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                            Subscreve a nossa newsletter (Brevemente)
                        </label>
                    </div>-->
                    <button name="button" class="btn-lg btn-primary registar btncp"
                            onClick=""><span class="fa fa-user-plus"></span> Sign Up</button>
<!--                </form>-->
            </div>
        </div>
    </div>
</section>