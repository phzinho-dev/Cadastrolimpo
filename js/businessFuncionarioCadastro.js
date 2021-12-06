function gravarFuncionarioCadastro(id, ativo, nome, estadoCivil, cpf, rg, dataDeNascimento, sexo, cep, logradouro, numero, uf, bairro, cidade, jsonTelefoneArray, jsonEmailArray, jsonDependenteArray, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {
            funcao: "grava",
            id: id,
            ativo: ativo,
            nome: nome,
            estadoCivil: estadoCivil,
            cpf: cpf,
            rg: rg,
            dataDeNascimento: dataDeNascimento,
            sexo: sexo,
            cep: cep,
            logradouro: logradouro,
            numero: numero,
            uf: uf,
            bairro: bairro,
            cidade: cidade,
            jsonTelefoneArray: jsonTelefoneArray,
            jsonEmailArray: jsonEmailArray,
            jsonDependenteArray: jsonDependenteArray
        },
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

function verificaCPFDependente(cpf, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaCPFDependente', cpf: cpf }, //valores enviados ao script    
        success: function(data) {
            callback(data);
        }
    });
}