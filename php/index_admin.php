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
        <meta charset="utf-8" />
        <title> Página inicial - Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/estilo.min.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <div class="container-fluid">
            <?php
                include "../inc/menu_admin.inc";
            ?>

            <div class="mensagem col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <h1 style="color:black; font-family: Courier New; text-align:center;">Seja bem-vindo(a)!</h1>
                <h2 class = "text-center" style="color:black;"> <b> Admnistrador. </b> </h2>
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