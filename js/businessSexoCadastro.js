function gravarSexoCadastro(id, ativo, descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_SexoCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, ativo: ativo, descricao: descricao, },
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

function verificaDescricao(id, descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_SexoCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaDescricao', id: id, descricao: descricao }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
}

function excluirDescricaoCadastro(id, callback) {
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