function gravarSexoCadastro(id, sexo, ativo, callback) {
    $.ajax({
        url: 'js/sqlscope_SexoCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, sexo: sexo, ativo: ativo, },
        success: function(data) {
            callback(data);
        }
    });
}

function recuperaSexoCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_SexoCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });

    return;
}

function excluirSexoCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_SexoCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
}