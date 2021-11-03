function gravarFuncionarioCadastro(id, ativo, nome, estadoCivil, cpf, dataDeNascimento, rg, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: "grava", id: id, ativo: ativo, nome: nome, estadoCivil: estadoCivil, cpf: cpf, dataDeNascimento: dataDeNascimento, rg: rg, },
        success: function(data) {
            callback(data);
        }
    });
}

function recuperaFuncionarioCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'recupera', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });

    return;
}

function excluirFuncionarioCadastro(id, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'excluir', id: id }, //valores enviados ao script      
        success: function(data) {
            callback(data);
        }
    });
}

function verificaCPF(cpf, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaCPF', cpf: cpf }, //valores enviados ao script    
        success: function(data) {
            callback(data);
        }
    });
}

function verificaRG(rg, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaRG', rg: rg }, //valores enviados ao script    
        success: function(data) {
            callback(data);
        }
    });
}