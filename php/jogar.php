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
        <title> Jogar - Jogadores </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/estilo.min.css" />
        <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet"/>
    </head>
    <body>
        <div class="container-fluid">
            <?php
                include "../inc/menu_jogadores.inc";
                include "../inc/funcoes.inc";
            ?>
            <center>
            <div class="form-jogar col-sm-4">
                <?php
                    if(file_exists("../xml/vocabulario.xml")){
                        if(filesize("../xml/vocabulario.xml")!=73){
                            $encontrou=false;
                            $encontrouLetra=0;
                            $Acertos=0;

                            echo"<h3> Adivinhe a Palavra Secreta: </h3> <hr>";

                            if(!isset($_SESSION["jogando"])){
                                sortear_palavra($sorteia,$dicaGe,$dicaE1,$dicaE2,$palavra);
                                $_SESSION["DicaGenerica"]=$dicaGe;
                                $_SESSION["DicaE1"]=$dicaE1;
                                $_SESSION["DicaE2"]=$dicaE2;
                                $_SESSION["Palavra"]=mb_strtoupper($palavra);
                                $_SESSION["PalavraJogador"]=mb_strtoupper($palavra);
                                $_SESSION["jogando"]=true;
                                $_SESSION["Dica"]=1;
                                $_SESSION["fimJogoWin"]=0;
                                $_SESSION["fimJogoLose"]=0;
                                $_SESSION["pontuacao"]=100;

                                $_SESSION["letraAcerto"]=array();

                                //Exibição da palavra e criação do vetor de acertos - Quando não jogando

                                for($i=0;$i<strlen($_SESSION["Palavra"]);$i++){
                                    if($_SESSION["Palavra"][$i]==' '){
                                        $_SESSION["letraAcerto"][]=1;
                                    }
                                    else{
                                        $_SESSION["letraAcerto"][]=0;
                                    }
                                }

                            }
                            else{
                                if(!empty($_POST)){
                                    $acao=$_POST["acao"];

                                    if($acao==1){
                                        $letraSelecionada=mb_strtoupper($_POST["letraSelecionada"]);

                                        for($i=0;$i<strlen($_SESSION["Palavra"]);$i++){
                                            if($_SESSION["Palavra"][$i]==$letraSelecionada){
                                                $letra=$letraSelecionada;
                                                $_SESSION["PalavraJogador"][$i]=$letra;
                                                $encontrouLetra=1;
                                                $_SESSION["letraAcerto"][$i]=1;
                                            }
                                        }

                                        if($encontrouLetra!=1){
                                            $_SESSION["pontuacao"]=$_SESSION["pontuacao"]-20;
                                        }


                                        unset($_POST["acao"]);
                                    }
                                    else if($acao==2){
                                        $palavraSelecionada=mb_strtoupper($_POST["palavraSelecionada"]);

                                        if($_SESSION["PalavraJogador"]==$palavraSelecionada){
                                            $_SESSION["fimJogoWin"]=1;

                                            for($i=0;$i<strlen($_SESSION["Palavra"]);$i++){
                                                $_SESSION["letraAcerto"][$i]=1;
                                            }

                                        }
                                        else{
                                            $_SESSION["fimJogoLose"]=1;
                                        }

                                        unset($_POST["acao"]);
                                    }
                                    else if($acao==3){
                                        if($_SESSION["Dica"]<3){
                                            $_SESSION["Dica"]++;
                                            $_SESSION["pontuacao"]=$_SESSION["pontuacao"]-25;
                                        }

                                        unset($_POST["acao"]);
                                    }
                                }


                                //Finaliza o jogo quando a pontuação chega a 0
                                if($_SESSION["pontuacao"]<=0){
                                    $_SESSION["fimJogoLose"]=1;
                                }

                                //Soma a quantidade de letras do acerto
                                for($i=0;$i<strlen($_SESSION["Palavra"]);$i++){
                                    $Acertos+=$_SESSION["letraAcerto"][$i];
                                }

                                //Verifica se o usuário já acertou toda a palavra
                                if($Acertos==strlen($_SESSION["Palavra"])){
                                    $_SESSION["fimJogoWin"]=1;
                                }


                            }

                            //Exibição da Palavra - Quando jogando
                            for($i=0;$i<strlen($_SESSION["Palavra"]);$i++){
                                if($_SESSION["letraAcerto"][$i]==1){
                                    echo'
                                        <input type="text" name="letra"  style="text-align:center" value="'.$_SESSION["Palavra"][$i].'" size="1" maxlength="1" readonly="readonly"/>
                                    ';
                                }
                                else{
                                    echo'
                                        <input type="text" name="letra" value="" size="1" maxlength="1" readonly="readonly"/>
                                    ';
                                }
                            }


                            //Verificação das Dicas

                            if($_SESSION["Dica"]==1){
                                echo'<p> Dica 1: '.$_SESSION["DicaGenerica"].'</p>';
                            }
                            else if($_SESSION["Dica"]==2){
                                echo'<p> Dica 1: '.$_SESSION["DicaGenerica"].'</p>';
                                echo'<p> Dica 2: '.$_SESSION["DicaE1"].'</p>';
                            }
                            else if($_SESSION["Dica"]==3){
                                echo'<p> Dica 1: '.$_SESSION["DicaGenerica"].'</p>';
                                echo'<p> Dica 2: '.$_SESSION["DicaE1"].'</p>';
                                echo'<p> Dica 3: '.$_SESSION["DicaE2"].'</p>';
                            }

                            //Form Letra
                            echo'
                                <form name="letraEnvia" action="jogar.php" method="POST">
                                    <label> Digite uma letra: </label>
                                    <input type="text" name="letraSelecionada" style="text-align:center" size="1" maxlength="1" required="required" />
                                    <input type="hidden" name="acao" value="1"/>
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Enviar</button>
                                </form>
                            ';

                            //Form Palavra Completa
                            echo'
                                <form name="palavraEnvia" action="jogar.php" method="POST">
                                    <label> Digite a palavra completa: </label>
                                    <input type="text" name="palavraSelecionada" style="text-align:center" required="required"/>
                                    <input type="hidden" name="acao" value="2"/>
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Enviar</button>

                                </form>
                            ';


                            //Dica
                            echo'
                                <br/>
                                <form action="jogar.php" method="POST">
                                    <input type="hidden" name="acao" value="3"/>
                                    <button type="submit" class="btn btn-danger btn-sm">Quero uma dica</button>
                                </form>
                            ';
                        ?>
                    </div>
                    <div class="form-jogar col-4">
                        <?php
                            echo'<h3> Pontuação: '.$_SESSION["pontuacao"].' </h3>';
                            if($_SESSION["fimJogoWin"]==1){
                                salvarJogo(1);
                                unset($_SESSION["jogando"]);

                                echo'<h4>Você ganhou!</h4>';
                                echo'<button type="button" onclick="return redirecionaJogar()" class="btn btn-danger btn-sm">Jogar Novamente</button>';
                            }
                            if($_SESSION["fimJogoLose"]==1){
                                salvarJogo(0);
                                unset($_SESSION["jogando"]);

                                echo'<h4>Você perdeu!</h4>';
                                echo'<button type="button" onclick="return redirecionaJogar()" class="btn btn-danger btn-sm">Jogar Novamente</button>';
                            }
                        ?>
                    </div>
                <?php
                        }
                        else{
                            echo'
                                <h2>Não há palavras cadastradas!</h2>
                                <h3>Peça ajuda ao admin.</h3>
                            ';
                        }
                    }
                    else{
                        echo'
                                <h2>Não há palavras cadastradas!</h2>
                                <h3>Peça ajuda ao admin.</h3>
                            ';
                    }

                include "../inc/rodape.inc";
            ?>
            </center>
        </div>
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/validaform.min.js"></script>
        <script src="../js/jogar.js"></script>
    </body>
</html>
