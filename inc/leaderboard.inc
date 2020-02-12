<?php
    $pontuacao=array();
    $codigos=array();
    $posicao=1;
    $usuarios=simplexml_load_file("../xml/usuarios.xml");

    foreach($usuarios->children() as $usuario){
        $pontuacao[]=(int)$usuario->pontuacao;
    }

    rsort($pontuacao);

    echo '
        <br/>
        <table class="table table-light table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>#</td>
                    <th>Usuário</td>
                    <th>Pontuação</td>
                </tr>
            </thead>
            <tbody>
    ';
    for($i=0;$i<sizeof($pontuacao);$i++){
        foreach($usuarios->children() as $usuario){
            if($pontuacao[$i] == $usuario->pontuacao){
                if(validar_codigo($usuario->codigo, $codigos) == true){
                    echo"
                        <tr>
                            <td>$posicao º</td>
                            <td>$usuario->nome</td>
                            <td>$usuario->pontuacao</td>
                        </tr>
                    ";
                    $posicao++;
                    break;
                }

            }
        }

    }
    echo '
            </tbody>
        </table>
    ';
?>
