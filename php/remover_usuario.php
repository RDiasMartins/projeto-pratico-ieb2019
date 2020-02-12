<?php
    $codigo=$_GET["codigos"];

    $usuarios=simplexml_load_file("../xml/usuarios.xml");

    foreach($usuarios->children() as $usuario){
        if($usuario->codigo==$codigo){
            unset($usuario[0]);
            break;
        }
    }

    file_put_contents("../xml/usuarios.xml", $usuarios->asXML());
    header("Location: lista_usuarios.php");
?>
