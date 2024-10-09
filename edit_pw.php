<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/edit_pw.js"></script> 
<section id="edit">
    <div class="container paddingtop paddingbottom">
        <div class="row row-centered">
            <div class="col-md-4 formcenter">
                <h2 class="titulo marginbottom">Alterar Palavra-Passe</h2>
                <div id="successdiv" class="alert alert-success">
                    <strong id="success"></strong>
                </div>
                <div id="errordiv" class="alert alert-danger">
                    <strong id="error"></strong>
                </div>
                <!--<form action="index.php?pag=edituser&nav=8&alterar=1" method="post" id="edit_form">-->
                <div class="form-group">
                    <input type="password" class="form-control inputcp" placeholder="Palava-passe actual" name="oldpassword" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control inputcp" placeholder="Nova Palavra-passe" name="password" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control inputcp" placeholder="Confirmar Palavra-passe" name="confirmpwd" value="" />
                </div>
                <button id="edituserbtn" name="submit" class="edit btn-lg btn-primary btncp"><span class="fa fa-key"></span> Editar</button>
            </div>
        </div>
    </div>
</section>