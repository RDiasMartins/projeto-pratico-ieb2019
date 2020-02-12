<div class = "modal" tabindex = "-1" role = "dialog" id="NovoUsuario">
    <div class = "modal-dialog">
        <div class = "modal-content">
            <div class = "modal-header">
                <h5 class = "modal-title">Novo Usuário</h5>
                <button class = "button" class = "close"
                    data-dismiss = "modal" aria-label = "Close">
                    <span aria-hidden = "true">&times;</span>
                </button>
            </div>  
            <form name="modalC" action = "validar_cadastro.php" method = "POST">
                <div class = "modal-body">
                    <div class="row">                                
                        <div class="form-group col-2">
                            <label for="text">Código</label>

                            <input type="text" name="codigo" id="codigo" class="form-control" 
                            <?php
                                    $novo_codigo = obter_codigo("usuario");
                                    echo " value=\"$novo_codigo\" ";
                            ?>
                            readonly="readonly"/>
                        </div>
                        <div class="form-group col-10">
                            <label for="nome">Nome completo</label>
                            <input type="text" name="nome" id="nome" class="form-control" onfocusout="validaNome()"/>
                            <span id="erroNome" style="color:black;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="control-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" onfocusout="validaEmail()"/>
                            <span id="erroEmail" style="color:black;"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-12">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="senhaNova" class="form-control password" onfocusout="validaSenha()"/>
                            <span id="erroSenha" style="color:black;"></span>

                        </div>
                        <div class="form-group col-sm-6 col-12">
                            <label for="senhaConfirmacao">Confirmação de senha</label>
                            <input type="password" name="senhaConfirmacao" id="senhaConfirmacao" class="form-control password" onfocusout="validaSenha2()"/>
                            <span id="erroSenha2" style="color:black;"></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="alterar" id="alterar" value="0" />
                <div class = "modal-footer">
                    <button type="reset" class="btn btn-outline-danger">Limpar</button>
                    <button type="submit" onclick="return validarFormModal()" class="btn btn-outline-primary">Cadastrar</button> 
                </div>
            </form>
        </div>
    </div>
</div>