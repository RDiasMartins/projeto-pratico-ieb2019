<?php
    session_start();
    
    if(isset($_SESSION['player'])){
        header("Location: index_jogadores.php");
    }
    else if(!isset($_SESSION['admin'])){
        header("Location: login.php");
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Lista de Usuários - Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/estilo.min.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <div class="container-fluid">
            <?php
                include "../inc/menu_admin.inc";
                include "../inc/funcoes.inc";
                include "../inc/modal_cadastro.inc";
                
                if(file_exists("../xml/usuarios.xml")){
                    echo"<br/>";
                    include "../inc/tabela_usuarios.inc";
                
                } else{
            ?>

                <div class="mensagem col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                    <h2 style="color:black; font-family:Consolas; text-align:center;">Não há usuários cadastrados.</h2>
                </div>

            <?php
                }

                include "../inc/rodape.inc";
            ?>
            <script src="../js/jquery-3.2.1.min.js"></script>
            <script src="../js/popper.min.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/validaform.min.js"></script>
            <script src="../js/alterar.js"></script>
        </div>
    </body>
</html>