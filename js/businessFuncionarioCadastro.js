function gravarFuncionarioCadastro(id, ativo, nomeCompleto, estadoCivil, cpf, rg, dataDeNascimento, sexo, cep, logradouro, numero, uf, bairro, cidade, primeiroEmprego, pisPasep, jsonTelefoneArray, jsonEmailArray, jsonDependenteArray, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php',
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: {
            funcao: "grava",
            id: id,
            ativo: ativo,
            nomeCompleto: nomeCompleto,
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
            primeiroEmprego: primeiroEmprego,
            pisPasep: pisPasep,

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

function verificaPisPasep(pisPasep, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaPisPasep', pisPasep: pisPasep }, //valores enviados ao script    
        success: function(data) {
            callback(data);
        }
    });
}

function verificaCPFDependente(cpfDependente, callback) {
    $.ajax({
        url: 'js/sqlscope_FuncionarioCadastro.php', //caminho do arquivo a ser executado
        dataType: 'html', //tipo do retorno
        type: 'post', //metodo de envio
        data: { funcao: 'verificaCPFDependente', cpfDependente: cpfDependente }, //valores enviados ao script    
        success: function(data) {
            callback(data);
        }
    });
}