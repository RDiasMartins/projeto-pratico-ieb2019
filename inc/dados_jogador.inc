
<?php
    $email = $_SESSION["Email"];

    $usuarios=simplexml_load_file("../xml/usuarios.xml");
        
        foreach($usuarios->children() as $usuario){
            if($email == $usuario->email){
                $jogos_perdidos=$usuario->jogos_perdidos;
                $jogos_ganhos = $usuario->jogos_ganhos;
                $jogos_jogados = $jogos_perdidos + $jogos_ganhos;

                echo '
                    <br/>
                    <table class="table table-light table-striped table-hover" width="50%">
                        <thead class="thead-dark">
                            <tr>
                                <th>Usuário</th>
                                <th>Pontuação</th>
                                <th>Jogos jogados</th>
                                <th>Jogos ganhos</th>
                                <th>Jogos perdidos</th>
                                <th>Troféu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>'.$usuario->nome.'</td>
                                <td>'.$usuario->pontuacao.'</td>
                                <td>'.$jogos_jogados.'</td>
                                <td>'.$usuario->jogos_ganhos.'</td>
                                <td>'.$usuario->jogos_perdidos.'</td>
                ';
                if($usuario->jogos_ganhos>=5 && $usuario->jogos_ganhos<10){
                    echo"<td> <img src=\"../img/iniciante.png\" height=\"40\" width=\"40\" alt=\"iniciante\"> </td>";
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
                echo'                           
                            </tr>
                        </tbody>
                    </table>
                ';
            }
        }
?>