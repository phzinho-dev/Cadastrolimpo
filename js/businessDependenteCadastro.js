function gravarDependenteCadastro(id, ativo, descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_DependenteCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, ativo: ativo, descricao: descricao, },
        success: function(data) {
            callback(data);
        }
    });
}

function recuperaDependenteCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_DependenteCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });

    return;
}

function verificaDependente(id, descricao, callback) {
    $.ajax({
        url: 'js/sqlscope_DependenteCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaDependente', id: id, descricao: descricao }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
    return;
}

function excluirDependenteCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_DependenteCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
}