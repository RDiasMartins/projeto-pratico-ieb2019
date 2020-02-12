<?php
    function obter_codigo($tipo){
        if(!file_exists("../xml/sequencia_codigos.xml")){
            $xml=
"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<codigos>
    <usuario>1</usuario>
    <palavra>1</palavra>
</codigos>";
            file_put_contents("../xml/sequencia_codigos.xml", $xml);
            return 1;
        }
        else{
            $codigo=simplexml_load_file("../xml/sequencia_codigos.xml");

            if($tipo=="usuario"){
                return $codigo->usuario;
            }
            if($tipo=="palavra"){
                return $codigo->palavra;
            }
        }
    }

    function atualizar_codigo($tipo){
        $codigos=simplexml_load_file("../xml/sequencia_codigos.xml");

        if($tipo=='usuario'){
            $codigos->usuario++;
        }
        if($tipo=='palavra'){
            $codigos->palavra++;
        }

        file_put_contents("../xml/sequencia_codigos.xml", $codigos -> asXML());
    }

    function gravar_dados_usuarios(){
        $codigo=$_POST["codigo"];
        $nome=$_POST["nome"];
        $email=$_POST["email"];
        $senha=$_POST["senha"];
        $pontuacao=0;
        $jogos_ganhos=0;
        $jogos_perdidos=0;
        $trofeus='Nenhum';
        $alterar=$_POST["alterar"];

        if(!file_exists("../xml/usuarios.xml")){
            $xml=
"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<usuarios>
    <usuario>
        <codigo>$codigo</codigo>
        <nome>$nome</nome>
        <email>$email</email>
        <senha>$senha</senha>
        <pontuacao>$pontuacao</pontuacao>
        <jogos_ganhos>$jogos_ganhos</jogos_ganhos>
        <jogos_perdidos>$jogos_perdidos</jogos_perdidos>
        <trofeus>$trofeus</trofeus>
    </usuario>
</usuarios>";

            file_put_contents("../xml/usuarios.xml", $xml);

            atualizar_codigo('usuario');
        }
        else{
            $usuarios=simplexml_load_file("../xml/usuarios.xml");

            if($alterar==0){
                $usuario=$usuarios->addChild("usuario");

                $usuario->addChild('codigo', $codigo);
                $usuario->addChild('nome', $nome);
                $usuario->addChild('email', $email);
                $usuario->addChild('senha', $senha);
                $usuario->addChild('pontuacao', $pontuacao);
                $usuario->addChild('jogos_ganhos', $jogos_ganhos);
                $usuario->addChild('jogos_perdidos', $jogos_perdidos);
                $usuario->addChild('trofeus', $trofeus);

                atualizar_codigo('usuario');
            }
            else{
                foreach($usuarios->children() as $usuario){
                    if($usuario->codigo==$codigo){
                        $usuario->nome=$nome;
                        $usuario->email=$email;
                        $usuario->senha=$senha;

                    }
                }

                file_put_contents("../xml/usuarios.xml", $usuarios->asXML());
            }

            file_put_contents("../xml/usuarios.xml", $usuarios->asXML());
        }

    }

    function gravar_dados_palavra(){
        $codigo=$_POST["codigo"];
        $palavra=$_POST["palavra"];
        $dicaGe=$_POST["dicaGe"];
        $dicaE1=$_POST["dicaE1"];
        $dicaE2=$_POST["dicaE2"];
        $alterar=$_POST["alterar"];

        if(!file_exists("../xml/vocabulario.xml")){
            $xml =
"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<vocabulario>
    <vocabulo>
        <codigo>$codigo</codigo>
        <palavra>$palavra</palavra>
        <dicaGe>$dicaGe</dicaGe>
        <dicaE1>$dicaE1</dicaE1>
        <dicaE2>$dicaE2</dicaE2>
    </vocabulo>
</vocabulario>";

        file_put_contents("../xml/vocabulario.xml", $xml);
        atualizar_codigo('palavra');

        } else{
            $vocabulario=simplexml_load_file("../xml/vocabulario.xml");

            if($alterar==0){
                $vocabulo=$vocabulario->addChild("vocabulo");

                $vocabulo->addChild('codigo', $codigo);
                $vocabulo->addChild('palavra', $palavra);
                $vocabulo->addChild('dicaGe', $dicaGe);
                $vocabulo->addChild('dicaE1', $dicaE1);
                $vocabulo->addChild('dicaE2', $dicaE2);

                atualizar_codigo('palavra');
            }
            if($alterar==1){
                foreach($vocabulario->children() as $vocabulo){
                    if($vocabulo->codigo==$codigo){
                        $vocabulo->palavra=$palavra;
                        $vocabulo->dicaGe=$dicaGe;
                        $vocabulo->dicaE1=$dicaE1;
                        $vocabulo->dicaE2=$dicaE2;
                    }
                }
            }

            file_put_contents("../xml/vocabulario.xml", $vocabulario->asXML());
        }

        echo "<article>
                <h4>Palavra cadastrada com sucesso.</h4>
            </article>
            ";
    }

    function lista_palavra(){
        $vocabulario=simplexml_load_file("../xml/vocabulario.xml");

        foreach($vocabulario->children() as $vocabulo){

            echo "
                <tr>
                    <td>$vocabulo->codigo</td>
                    <td>$vocabulo->palavra</td>
                    <td>$vocabulo->dicaGe</td>
                    <td>$vocabulo->dicaE1</td>
                    <td>$vocabulo->dicaE2</td>
                    <td><a href=\"../php/form_cadastro_palavra.php?codigos=$vocabulo->codigo\">Alterar</a></td>
                    <td><a href=\"../php/remover_palavra.php?codigos=$vocabulo->codigo\" onclick=\"return confirmarExclusaoP()\">Excluir</td>
                </tr>
            ";
        }
    }

    function lista_usuarios(){
        $usuarios=simplexml_load_file("../xml/usuarios.xml");

        foreach($usuarios->children() as $usuario){

            echo"
                <tr>
                    <td>$usuario->codigo</td>
                    <td>$usuario->nome</td>
                    <td>$usuario->email</td>
                    <td>$usuario->senha</td>
                    <td>$usuario->pontuacao</td>
                    <td>$usuario->jogos_ganhos</td>
                    <td>$usuario->jogos_perdidos</td>
            ";
            if($usuario->jogos_ganhos>=5 && $usuario->jogos_ganhos<10){
                echo"<td> <img src=\"../img/iniciante.png\" height=\"45\" width=\"40\" alt=\"iniciante\"> </td>";
            }
            else if($usuario->jogos_ganhos>=10 && $usuario->jogos_ganhos<20){
                echo"<td> <img src=\"../img/intermediario.png\" height=\"45\" width=\"40\" alt=\"intermediario\"> </td>";
            }
            else if($usuario->jogos_ganhos>=20){
                echo"<td> <img src=\"../img/avançado.png\" height=\"45\" width=\"40\" alt=\"avançado\"> </td>";
            }
            else if($usuario->jogos_ganhos<5){
                echo"<td>$usuario->trofeus</td>";
            }
            echo"
                    <td><button class=\"btn btn-link\" onclick=\"alterarUsuario($usuario->codigo,'$usuario->nome','$usuario->email','$usuario->senha')\">Alterar</button></td>
                    <td><a href=\"../php/remover_usuario.php?codigos=$usuario->codigo\" class=\"btn btn-link\" role=\"button\" onclick=\"return confirmarExclusao()\">Excluir</td>
                </tr>
            ";
        }
    }

    function validar_codigo($codigo, &$array){
        $encontrou = false;

        for($i=0; $i<sizeof($array); $i++){
            if($array[$i] == $codigo){
                $encontrou = true;
            }
        }

        if($encontrou == true){
            return false;
        }

        $array[] = $codigo;
        return true;
    }

    function sortear_palavra(&$sorteia,&$dicaGe,&$dicaE1,&$dicaE2,&$palavra){
        unset($_POST);
        $codigoPalavra=array();

        $vocabulario=simplexml_load_file("../xml/vocabulario.xml");

        foreach($vocabulario->children() as $vocabulo){
            $codigoPalavra[]=(int)$vocabulo->codigo;
        }

        rsort($codigoPalavra);

        $max=$codigoPalavra[0];

        $encontrou = false;
        do{
            $sorteia=rand(1, $max);
            foreach($vocabulario->children() as $vocabulo){
                if($vocabulo->codigo == $sorteia){
                    $dicaGe=(string)$vocabulo->dicaGe;
                    $dicaE1=(string)$vocabulo->dicaE1;
                    $dicaE2=(string)$vocabulo->dicaE2;
                    $palavra=(string)$vocabulo->palavra;
                    $encontrou = true;
                }
            }
        }while(!$encontrou);
    }

    function salvarJogo($aux){
        $usuarios=simplexml_load_file("../xml/usuarios.xml");
        $Email=$_SESSION["Email"];

        foreach($usuarios->children() as $usuario){
            if($Email==$usuario->email){
                if($aux==1){
                    $usuario->jogos_ganhos++;
                    $usuario->pontuacao+=$_SESSION["pontuacao"];
                }
                if($aux==0){
                    $usuario->jogos_perdidos++;
                }
            }
        }

        file_put_contents("../xml/usuarios.xml", $usuarios->asXML());
    }
?>
