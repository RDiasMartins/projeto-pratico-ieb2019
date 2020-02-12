<?php
    session_start();

    if(isset($_SESSION['admin'])){
        header("location: index_admin.php");
    }
    else if(!isset($_SESSION['player'])){
        header("location: login.php");
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Perfil - Jogadores </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/estilo.min.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <div class="container-fluid">
            <?php
                include "../inc/menu_jogadores.inc";
            ?>
            <div>
                <?php
                    include "../inc/dados_jogador.inc";
                ?>
            </div>
            <?php
                include "../inc/rodape.inc";
            ?>
        </div>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"></script>
    </body>
</html>