 <div class="login-form col-sm-6 offset-sm-3 col-md-4 offset-md-4">
            <header>
                <h1 style="color:black; font-family:Consolas; text-align:center;">Palavra Secreta</h1>
                <h2 class = "text-center" style="color:black;">Entre com o seu <b>e-mail</b> e <b>senha</b></h2>
            </header>
            <form action="../php/validar_login.php" method="POST">
                <div class = "form-group">
                    <div class = "input-group">
                        <div class = "input-group-addon">
                            <i class = "material-icons" style="color:black;">email</i> &nbsp;
                        </div>
                        <input type = "email" name = "EmailLogin"
                        class = "form-control" placeholder = "E-mail"/>
                    </div>
                </div>
                <div class = "form-group">
                    <div class = "input-group">
                        <div class = "input-group-addon">
                            <i class = "material-icons" style="color:black;">lock</i> &nbsp;
                        </div>
                        <input type = "password" name = "SenhaLogin" class = "form-control"
                        id = "senha"  placeholder = "Senha"/>
                    </div>
                </div>
                <footer>
                    <div class = "float-right">
                        <span id="erroLogin" style="color:black;"></span>
                        <button type = "submit" class ="btn btn-primary">
                            Entrar 
                        </button>
                    </div>
                </footer>
            </form>
            
            <button class = "btn btn-secondary  btn-cadastrar" data-toggle = "modal" data-target = "#NovoUsuario">
                Cadastrar
            </button>
        </div>