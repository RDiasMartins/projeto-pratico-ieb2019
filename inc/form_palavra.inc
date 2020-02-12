<article>
    <?php
        $encontrou=false;

        if(!empty($_GET)){
            $codigo=$_GET["codigos"];
            if(file_exists("../xml/vocabulario.xml")){
                $vocabulario=simplexml_load_file("../xml/vocabulario.xml");

                foreach($vocabulario->children() as $vocabulo){
                    if($vocabulo->codigo==$codigo){
                        $encontrou=true;
                        $palavra=$vocabulo->palavra;
                        $dicaGe=$vocabulo->dicaGe;
                        $dicaE1=$vocabulo->dicaE1;
                        $dicaE2=$vocabulo->dicaE2;
                    }
                }
            }
        }
    ?>

    <form name="cadastroPalavra" action="../php/form_cadastro_palavra.php" method="POST">
        <legend>Insira uma palavra:</legend>
        
        <p>
            <label for="text">Código: </label>
            <input type="text" name="codigo" class="form-control" 
            
            <?php
                if($encontrou){
                    echo " value=\"$codigo\" ";
                } else{
                    $novo_codigo = obter_codigo("palavra");
                    echo " value=\"$novo_codigo\" ";
                }
            ?>

            readonly="readonly"/>
        </p>
        <p>
            <label for="text">Palavra:</label>
            <input type="text" name="palavra" class="form-control" 
            
            <?php
                if($encontrou){
                    echo " value=\"$palavra\" ";
                }
            ?>

            />
        </p>
        <p>
            <label>Dica Genérica:</label>
            <input type="text" name="dicaGe" class="form-control" 
            
            <?php
                if($encontrou){
                    echo " value=\"$dicaGe\" ";
                }
            ?>
            
            />
        </p>
        <p>
            <label>Dica Específica 1: </label>
            <input type="text" name="dicaE1" class="form-control" 
            
            <?php
                if($encontrou){
                    echo " value=\"$dicaE1\" ";
                }
            ?>
            
            />
        </p>
        <p>
            <label>Dica Específica 2: </label>
            <input type="text" name="dicaE2" class="form-control" 
            
            <?php
                if($encontrou){
                    echo " value=\"$dicaE2\" ";
                }
            ?>
            
            />
        </p>
        
        <?php
            if($encontrou){
                echo "
                    <input type=\"hidden\" name=\"alterar\"
                        value=\"1\" />
                ";
            }
            else{
                echo "
                    <input type=\"hidden\" name=\"alterar\"
                        value=\"0\" />
                ";
            }
        ?>
        <span id="erroForm" style="color:black;"></span>
        <p>
            <div class="float-right">
                <button type="submit" class="btn btn-secondary" onclick="return validarFormP()"> Salvar </button>
            </div>
            
            <br/>
        </p>
    </form>
</article>