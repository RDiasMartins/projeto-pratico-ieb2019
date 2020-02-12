<?php
    $codigo=$_GET["codigos"];

    $vocabulario=simplexml_load_file("../xml/vocabulario.xml");

    foreach($vocabulario->children() as $vocabulo){
        if($vocabulo->codigo==$codigo){
            unset($vocabulo[0]);
            break;
        }
    }

    file_put_contents("../xml/vocabulario.xml", $vocabulario->asXML());
    header("Location: lista_palavra.php");
?>
