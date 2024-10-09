<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/add_user.js"></script>
<section id="registar">
    <div class="container paddingtop marginbottom">
        <div class="row">
            <div class="col-md-4 formcenter">
                <h2 class="titulo marginbottom">Adicionar Utilizador</h2>
                    <div id="errordiv" class="alert alert-danger">
                        <strong id="error" ></strong>
                    </div>
<!--                <form action="" method="post" id="registration_form">-->
                    <div class="form-group">
                        <input type="text" class="form-control inputcp" placeholder="Utilizador" name="username" id="username" />
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control inputcp" placeholder="Email" name="email" id="email" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control inputcp" placeholder="Nome" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputcp" placeholder="Palavra-Passe" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control inputcp" placeholder="Confirmar Palavra-Passe" name="confirmpwd" id="confirmpwd" />
                    </div>
                    <div class="form-group">
                        <select class="custom-select inputcp" id="estatuto" name="estatuto">
                            <option value="2">Administrador</option>
                            <option value="1">Colaborador</option>
                            <option value="0">Utilizador</option>
                        </select>
                    </div>
                    <button name="submit" class="btn-lg btn-primary btncp registar" style="width: 300px">
                        <span class="fa fa-user-plus"></span> Adicionar Utilizador
                    </button>
<!--                </form>-->
            </div>
        </div>
    </div>
</section>