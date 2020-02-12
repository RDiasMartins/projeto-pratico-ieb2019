<?php
    session_start();

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
        <title> Página de login </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/login.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <?php
            include "../inc/funcoes.inc";
        ?>

        <?php
            include "../inc/form_login.inc";
        ?>

        <?php
            include "../inc/modal_cadastro.inc";
        ?>
        
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"></script>
    </body>
</html>
