<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
        <title> Validação de cadastro </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/estilo.min.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <?php
            include "../inc/funcoes.inc";
            
            $aux=0;
            $aux2=0;
            $alterar=$_POST["alterar"];

            if(file_exists("../xml/usuarios.xml")){
                $usuarios=simplexml_load_file("../xml/usuarios.xml");

                foreach($usuarios->children() as $usuario){
                    if($_POST["email"]==$usuario->email && $alterar!=1){
                        $aux=1;
                        break;
                    }
                    if($_POST["email"]==$usuario->email && $alterar==1){
                        $aux2=1;
                        break;
                    }
                }

                if($aux2==1){
                    echo'
                        <div class="mensagem col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                            <h1 style="color:black; font-family:Consolas; text-align:center;">E-mail em uso!</h1>
                            <h2 class = "text-center" style="color:black;"> <b>Altere para outro E-mail </b> </h2>
                            
                            <div class="float-right">
                                <a href="lista_usuarios.php" class="btn btn-danger" role="button"> Voltar </a>
                            </div>
                
                            <br/>
                        </div>
                    ';
                }
                else if($aux==1){
                    echo'
                        <div class="mensagem col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                            <h1 style="color:black; font-family:Consolas; text-align:center;">E-mail em uso!</h1>
                            <h2 class = "text-center" style="color:black;"> <b>Cadastre-se novamente </b> </h2>
                            
                            <div class="float-right">
                                <a href="login.php" class="btn btn-danger" role="button"> Voltar </a>
                            </div>

                            <br/>
                        </div>
                    ';
                }
                else{
                    gravar_dados_usuarios();
                    header("Location: login.php");
                }
            }
            else{
                gravar_dados_usuarios();
                header("Location: login.php");
            }
        ?>
       
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validaform.min.js"></script>
    </body>
</html>