function alterarUsuario(codigo, nome, email, senha){
    
    document.getElementById('codigo').value=codigo;
    document.getElementById('nome').value=nome;
    document.getElementById('email').value=email;
    document.getElementById('senhaNova').value=senhaNova;
    
    document.getElementById('alterar').value=1;
    $('#NovoUsuario').modal();
}