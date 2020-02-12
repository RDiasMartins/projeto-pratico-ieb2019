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
        <title>Cadastro de palavras</title>
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
            ?>
			<center>
				<div class="form-generico col-sm-4">
					<?php

						$aux=0;

						if(empty($_POST)){
							include "../inc/form_palavra.inc";

						}
						else{
							if(file_exists("../xml/vocabulario.xml")){
								$vocabulario=simplexml_load_file("../xml/vocabulario.xml");

								foreach($vocabulario->children() as $vocabulo){
									if($_POST["palavra"]==$vocabulo->palavra){
										$aux=1;
										break;
									}
								}
								if($_POST["alterar"]==0){
									if($aux==1){
					?>
						<h4 style="color:black; font-family:Consolas;">Palavra já cadastrada</h1>

						<div class="float-right">
							<a href="form_cadastro_palavra.php" class="btn btn-danger" role="button"> Tentar novamente </a>
						</div>

						<br/>
					<?php
									}
									else{
										gravar_dados_palavra();
									}
								}
								else{
									if($aux==1 && $vocabulo->codigo!=$_POST["codigo"]){
					?>
						<h4 style="color:black; font-family:Consolas;">Palavra já cadastrada</h1>

						<div class="float-right">
							<a href="lista_palavra.php" class="btn btn-danger" role="button"> Tentar novamente </a>
						</div>

						<br/>
					<?php
									}
									else{
										gravar_dados_palavra();
									}
								}
							}
							else{
								gravar_dados_palavra();
							}
						}
						include "../inc/rodape.inc";
					?>
				</div>
			</center>
        </div>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"></script>
    </body>
</html>
