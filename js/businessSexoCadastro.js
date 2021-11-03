function gravarSexoCadastro(id, ativo, sexo, callback) {
    $.ajax({
        url: 'js/sqlscope_sexoCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, ativo: ativo, sexo: sexo, },
        success: function(data) {
            callback(data);
        }
    });
}

function recuperaSexoCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_sexoCadastro.php', //caminho do arquivo a ser executado
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
        url: 'js/sqlscope_sexoCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
}