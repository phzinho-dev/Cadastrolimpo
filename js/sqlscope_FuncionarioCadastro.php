<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'grava') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}

if ($funcao == 'verificaCPF') {
    call_user_func($funcao);
}

if ($funcao == 'verificaRG') {
    call_user_func($funcao);
}

return;

function grava()
{

    $reposit = new reposit(); //Abre a conexão.

    session_start();
    $codigo = (int)$_POST['id'];
    $ativo = (int)$_POST['ativo'];
    $nome = "'" . (string)$_POST['nome'] . "'";
    $estadoCivil = "'" . (string)$_POST['estadoCivil'] . "'";
    $cpf = "'" . (string) $_POST['cpf'] . "'";
    $rg = "'" . (string)$_POST['rg'] . "'";
    $dataDeNascimento = $_POST['dataDeNascimento'];
    //Converção de data
    $dataDeNascimento = explode("/", $dataDeNascimento);
    $dataDeNascimento = "'" . $dataDeNascimento[2] . "-" . $dataDeNascimento[1] . "-" . $dataDeNascimento[0] . "'";

    $sexo = (int)$_POST['sexo'];

    $cep = "'" . (string)$_POST['cep'] . "'";
    $logradouro = "'" . (string)$_POST['logradouro'] . "'";
    $numero = "'" . (string)$_POST['numero'] . "'" ;
    $complemento = "'" . (string)$_POST['complemento'] . "'" ;
    $uf = "'" . (string)$_POST['uf'] . "'" ; 
    $bairro = "'" . (string)$_POST['bairro']. "'" ;
    $cidade = "'" . (string)$_POST['cidade']. "'" ;

    $strArrayTelefone = $_POST['jsonTelefoneArray'];
    $arrayTelefone = json_decode($strArrayTelefone, true);

    $xmlTelefone = "";
    $nomeXml = "ArrayOfFuncionarioTelefone";
    $nomeTabela = "funcionario_telefone";

    if (sizeof($arrayTelefone) > 0) {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';

        foreach ($arrayTelefone as $chave) {
            $xmlTelefone = $xmlTelefone . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialTelefone")) {
                    continue;
                }
                $xmlTelefone = $xmlTelefone . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlTelefone = $xmlTelefone . "</" . $nomeTabela . ">";
        }
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    } else {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlTelefone);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlTelefone = "'" . $xmlTelefone . "'";

    $strArrayEmail = $_POST['jsonEmailArray'];
    $arrayEmail = json_decode($strArrayEmail, true);
    $xmlEmail = "";
    $nomeXml = "ArrayOfFuncionario_email";
    $nomeTabela = "funcionario_email";
    if (sizeof($arrayEmail) > 0) {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';

        foreach ($arrayEmail as $chave) {
            $xmlEmail = $xmlEmail . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialEmail")) {
                    continue;
                }
                $xmlEmail = $xmlEmail . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlEmail = $xmlEmail . "</" . $nomeTabela . ">";
        }
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    } else {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlEmail);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Email";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlEmail = "'" . $xmlEmail . "'";


    

    $sql = "dbo.funcionario_Atualiza
            $codigo,
            $ativo,
            $nome,
            $estadoCivil,
            $cpf,
            $sexo,
            $dataDeNascimento,
            $rg,

            $xmlTelefone,
            $xmlEmail,

            $cep,
            $logradouro,
            $numero,
            $complemento,
            $uf,
            $bairro,
            $cidade";

    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';
    if ($result < 1) {
        $ret = 'failed#';
    }
    echo $ret;
    return;
}

function recupera()
{

    $codigo = $_POST["id"];

    $sql = "SELECT 
     codigo, 
     ativo, 
     nomeCompleto, 
     estadoCivil, 
     dataDeNascimento, 
     cpf , 
     rg, 
     sexo,
     cep, 
     logradouro,
     numero, 
     complemento,
     uf,
     bairro,
     cidade
    
      FROM dbo.funcionario WHERE (0 = 0)";

    $sql = $sql . " AND codigo = " . $codigo;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = (int)$row['codigo'];
        $ativo = $row['ativo'];
        $nome = (string)$row['nomeCompleto'];
        $estadoCivil = (string)$row['estadoCivil'];
        $dataDeNascimento = $row['dataDeNascimento'];

        //Converção de data
        $dataDeNascimento = explode(" ", $dataDeNascimento);
        $dataDeNascimento = explode("-", $dataDeNascimento[0]);
        $dataDeNascimento = $dataDeNascimento[2] . "/" . $dataDeNascimento[1] . "/" . $dataDeNascimento[0];
        $cpf = $row['cpf'];
        $rg = $row['rg'];
        $sexo = $row['sexo'];

        $cep = $row['cep'];
        $logradouro =(string)$row['logradouro'];
        $numero = $row['numero'];
        $complemento = (string)$row['complemento'];
        $uf = (string)$row['uf'];
        $bairro = (string)$row['bairro'];
        $cidade = (string)$row['cidade'];

        $sql = "SELECT * FROM dbo.funcionario_telefone WHERE funcionario = $id " ;
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorTelefone = 0;
        $arrayTelefone = array();
        foreach ($result as $row) {
            $telefoneId = $row['codigo'];
            $telefone = $row['telefone'];
            $principal = +$row['principal'];
            $whatsapp = +$row['whatsapp'];

            if ($principal === 1) {
                $descricaoPrincipal = "Sim";
            } else {
                $descricaoPrincipal = "Não";
            }
            if ($whatsapp === 1) {
                $descricaoWhatsapp = "Sim";
            } else {
                $descricaoWhatsapp = "Não";
            }

            $contadorTelefone = $contadorTelefone + 1;
            $arrayTelefone[] = array(
                "sequencialTelefone" => $contadorTelefone,
                "telefoneId" => $telefoneId,
                "telefone" => $telefone,
                "principal" => $principal,
                "descricaoTelefonePrincipal" => $descricaoPrincipal,
                "whatsapp" => $whatsapp,
                "descricaoTelefoneWhatsapp" => $descricaoWhatsapp
            );
        }
        $strArrayTelefone = json_encode($arrayTelefone);

        $sql = "SELECT * FROM dbo.funcionario_email WHERE funcionario = $id " ;
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorEmail = 0;
        $arrayEmail = array();
        foreach ($result as $row) {
            $emailId = $row['codigo'];
            $email = $row['email'];
            $principal = +$row['principal'];

            if ($principal === 1) {
                $descricaoPrincipal = "Sim";
            } else {
                $descricaoPrincipal = "Não";
            }

            $contadorEmail = $contadorEmail + 1;
            $arrayEmail[] = array(
                "sequencialEmail" => $contadorEmail,
                "emailId" => $emailId,
                "email" => $email,
                "principal" => $principal,
                "funcionario" => $id,
                "descricaoEmailPrincipal" => $descricaoPrincipal,
            );
        }
        $strArrayEmail = json_encode($arrayEmail);
        

        $out = $id . "^" . $ativo . "^" . $nome . "^" . $estadoCivil . "^" . $dataDeNascimento . "^" . $cpf . "^" . $rg . "^" . $sexo . 
            "^" . $cep . "^" . $logradouro . "^" . $numero. "^" . $complemento . "^" . $uf . "^" . $bairro . "^" . $cidade;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . "#" . $strArrayTelefone . "#" . $strArrayEmail  ;
        }
        return;
    }
}

function excluir()
{

    $reposit = new reposit();

    $id = $_POST["id"];

    if ((empty($_POST['id']) || (!isset($_POST['id'])) || (is_null($_POST['id'])))) {
        $mensagem = "Selecione um lancamento";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    $result = $reposit->update('dbo.funcionario' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}

function verificaCPF()
{
    $cpf = "'" . $_POST["cpf"] . "'";

    $sql = "SELECT cpf FROM dbo.funcionario 
    WHERE cpf = " .  $cpf;

    $reposit = new reposit();

    $result = $reposit->RunQuery($sql);

    if ($result) {
        echo ('failed#');
        return;
    }
    echo ('sucess#');
    return;
}
function verificaRG()
{
    $rg = "'" . $_POST["rg"] . "'";

    $sql = "SELECT rg FROM dbo.funcionario 
    WHERE rg = " .  $rg;

    $reposit = new reposit();

    $result = $reposit->RunQuery($sql);

    if ($result[0]["rg"] === $_POST["rg"]) {
        echo ('failed#');
        return;
    }
    echo ('sucess#');
    return;
}
