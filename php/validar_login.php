<?php
    session_start ();

    if(isset($_SESSION['admin'])){
        header("location: index_admin.php");
    }

    if(isset($_SESSION['player'])){
        header("location: index_jogadores.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
        <title> Validação de login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/login.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <?php
             include "../inc/funcoes.inc";
                $_SESSION["Email"] = $_POST["EmailLogin"];
                $_SESSION["Senha"] = $_POST["SenhaLogin"];

                $EmailLogar = $_SESSION["Email"];
                $SenhaLogar = $_SESSION["Senha"];
                $admin = "admin";
                $aux=0;

                if(($EmailLogar==$admin) && ($SenhaLogar==$admin)){
                    $_SESSION['admin']=true;
                    header("Location: index_admin.php");
                }else{
                    if(file_exists("../xml/usuarios.xml")){
                        $usuarios=simplexml_load_file("../xml/usuarios.xml");
        
                        foreach($usuarios->children() as $usuario){
                            if(($EmailLogar==$usuario->email)&&($SenhaLogar==$usuario->senha)){
                                $aux=1;
                                break;
                            }
                        }
        
                        if($aux==1){
                                $_SESSION['player']=true;
                                header("Location:index_jogadores.php");
                        }else{
        ?>
                            <script>
                                window.location.href="login.php";
                                window.alert("Usuário inválido!");
                            </script>
        <?php
                        }
                    }else{
        ?>
                         <script>
                                window.location.href="login.php";
                                window.alert("Não há usuários cadastrados!");
                        </script>
        <?php
                    }
                }
        ?>

        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"> </script>
    </body>
</html>