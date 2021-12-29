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

if ($funcao == 'verificaPisPasep') {
    call_user_func($funcao);
}

if ($funcao == 'verificaCPFDependente') {
    call_user_func($funcao);
}

return;

function grava()
{

    $reposit = new reposit(); //Abre a conexão.

    session_start();
    $codigo = (int)$_POST['id'];
    $ativo = (int)$_POST['ativo'];
    $nomeCompleto = "'" . (string)$_POST['nomeCompleto'] . "'";
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
    $numero = "'" . (string)$_POST['numero'] . "'";
    $complemento = "'" . (string)$_POST['complemento'] . "'";
    $uf = "'" . (string)$_POST['uf'] . "'";
    $bairro = "'" . (string)$_POST['bairro'] . "'";
    $cidade = "'" . (string)$_POST['cidade'] . "'";
    $primeiroEmprego = (int)$_POST['primeiroEmprego'];
    $pisPasep = "'" . (string)$_POST['pisPasep'] . "'";


    $strArrayTelefone = $_POST['jsonTelefoneArray'];
    $arrayTelefone = json_decode($strArrayTelefone, true);

    $xmlTelefone = "";
    $nomeXml = "ArrayOfFuncionarioTelefone";
    $nomeTabela = "funcionarioTelefone";

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
    $nomeXml = "ArrayOfFuncionarioEmail";
    $nomeTabela = "funcionarioEmail";

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
        $mensagem = "Erro na criação do XML de email";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlEmail = "'" . $xmlEmail . "'";


    $strArrayDependente = $_POST['jsonDependenteArray'];
    $arrayDependente = json_decode($strArrayDependente, true);
    $xmlDependente = "";
    $nomeXml = "ArrayOfdependente";
    $nomeTabela = "dependente";
    if (sizeof($arrayDependente) > 0) {
        $xmlDependente = '<?xml version="1.0"?>';
        $xmlDependente = $xmlDependente . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';

        foreach ($arrayDependente as $chave) {
            $xmlDependente = $xmlDependente . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialDependente")) {
                    continue;
                }
                if (($campo === "dataNascimento")) {
                    $dataNascimento = $valor;
                    $dataNascimento = explode("/", $dataNascimento);
                    $dataNascimento =  $dataNascimento[2] . "-" . $dataNascimento[1] . "-" . $dataNascimento[0];
                    $valor = $dataNascimento;
                }
                $xmlDependente = $xmlDependente . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlDependente = $xmlDependente . "</" . $nomeTabela . ">";
        }
        $xmlDependente = $xmlDependente . "</" . $nomeXml . ">";
    } else {
        $xmlDependente = '<?xml version="1.0"?>';
        $xmlDependente = $xmlDependente . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlDependente = $xmlDependente . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlDependente);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Descricao";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlDependente = "'" . $xmlDependente . "'";




    $sql = "dbo.funcionarioAtualiza
            $codigo,
            $ativo,
            $nomeCompleto,
            $estadoCivil,
            $cpf,
            $sexo,
            $dataDeNascimento,
            $rg,
            $xmlTelefone,
            $xmlEmail,
            $xmlDependente,
            $cep,
            $logradouro,
            $numero,
            $complemento,
            $uf,
            $bairro,
            $cidade,
            $primeiroEmprego,
            $pisPasep";

    $result = $reposit->Execprocedure($sql);
    // ahou o erro ? aindao nao
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
            cidade,
            primeiroEmprego,
            pisPasep
           FROM dbo.funcionario WHERE (0 = 0)";

    $sql = $sql . " AND codigo = " . $codigo;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = (int)$row['codigo'];
        $ativo = $row['ativo'];
        $nomeCompleto = (string)$row['nomeCompleto'];
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
        $logradouro = (string)$row['logradouro'];
        $numero = $row['numero'];
        $complemento = (string)$row['complemento'];
        $uf = (string)$row['uf'];
        $bairro = (string)$row['bairro'];
        $cidade = (string)$row['cidade'];
        $primeiroEmprego = $row['primeiroEmprego'];
        $pisPasep = (string)$row['pisPasep'];

        $sql = "SELECT * FROM dbo.funcionarioTelefone WHERE funcionario = $id ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorTelefone = 0;
        $arrayTelefone = array();
        foreach ($result as $row) {
            $telefoneId = $row['codigo'];
            $telefone = $row['telefone'];
            $telefonePrincipal = +$row['principal'];
            $telefoneWhatsapp = +$row['whatsapp'];

            if ($telefonePrincipal === 1) {
                $descricaoTelefonePrincipal = "Sim";
            } else {
                $descricaoTelefonePrincipal = "Não";
            }
            if ($telefoneWhatsapp === 1) {
                $descricaoTelefoneWhatsapp = "Sim";
            } else {
                $descricaoTelefoneWhatsapp = "Não";
            }

            $contadorTelefone = $contadorTelefone + 1;
            $arrayTelefone[] = array(
                "sequencialTelefone" => $contadorTelefone,
                "telefoneId" => $telefoneId,
                "telefone" => $telefone,
                "telefonePrincipal" => $telefonePrincipal,
                "descricaoTelefonePrincipal" => $descricaoTelefonePrincipal,
                "telefoneWhatsapp" => $telefoneWhatsapp,
                "descricaoTelefoneWhatsapp" => $descricaoTelefoneWhatsapp
            );
        }
        $strArrayTelefone = json_encode($arrayTelefone);

        $sql = "SELECT * FROM dbo.funcionarioEmail WHERE funcionario = $id ";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorEmail = 0;
        $arrayEmail = array();
        foreach ($result as $row) {
            $emailId = $row['codigo'];
            $email = $row['email'];
            $emailPrincipal = +$row['principal'];

            if ($emailPrincipal === 1) {
                $descricaoEmailPrincipal = "Sim";
            } else {
                $descricaoEmailPrincipal = "Não";
            }

            $contadorEmail = $contadorEmail + 1;
            $arrayEmail[] = array(
                "sequencialEmail" => $contadorEmail,
                "emailId" => $emailId,
                "email" => $email,
                "emailPrincipal" => $emailPrincipal,
                "descricaoEmailPrincipal" => $descricaoEmailPrincipal,
            );
        }
        $strArrayEmail = json_encode($arrayEmail);

        $sql = "SELECT USU.codigo, USU.nomeDependente, USU.cpfDependente, USU.dataNascimento,USU.tipoDependente
                FROM dbo.dependente USU
                LEFT JOIN dbo.tipoDependente USUG on USU.tipoDependente = USUG.codigo
                WHERE funcionario = $id";
        $reposit = new reposit();
        $result = $reposit->RunQuery($sql);

        $contadorDependente = 0;
        $arrayDependente = array();
        foreach ($result as $row) {
            $dependenteId = $row['codigo'];
            $nomeDependente = $row['nomeDependente'];
            $cpfDependente = $row['cpfDependente'];

            $dataNascimento = $row['dataNascimento'];
            $dataNascimento = explode(" ", $dataNascimento);
            $dataNascimento = explode("-", $dataNascimento[0]);
            $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];

            $tipoDependente = $row['tipoDependente'];

            $contadorDependente = $contadorDependente + 1;
            $arrayDependente[] = array(
                "sequencialDependente" => $contadorDependente,
                "dependenteId" => $dependenteId,
                "nomeDependente" => $nomeDependente,
                "cpfDependente" => $cpfDependente,
                "dataNascimento" => $dataNascimento,
                "tipoDependente" => $tipoDependente,
            );
        }
        $strArrayDependente = json_encode($arrayDependente);


        $out = $id . "^" . $ativo . "^" . $nomeCompleto . "^" . $estadoCivil . "^" . $dataDeNascimento . "^" . $cpf . "^" . $rg . "^" . $sexo .
            "^" . $cep . "^" . $logradouro . "^" . $numero . "^" . $complemento . "^" . $uf . "^" . $bairro . "^" . $cidade . "^" . $primeiroEmprego . "^" . $pisPasep;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out . "#" . $strArrayTelefone . "#" . $strArrayEmail . "#" . $strArrayDependente;
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

function verificaPisPasep()
{
    $pisPasep = "'" . $_POST["pisPasep"] . "'";

    $sql = "SELECT pisPasep FROM dbo.funcionario 
    WHERE pisPasep = " .  $pisPasep;

    $reposit = new reposit();

    $result = $reposit->RunQuery($sql);

    if ($result) {
        echo ('failed#');
        return;
    }
    echo ('sucess#');
    return;
}

function verificaCPFDependente()
{
    $cpfDependente = "'" . $_POST["cpfDependente"] . "'";

    $sql = "SELECT cpfDependente FROM dbo.dependente
    WHERE cpfDependente = " . $cpfDependente;

    $reposit = new reposit();

    $result = $reposit->RunQuery($sql);

    if ($result) {
        echo ('failed#');
        return;
    }
    echo ('sucess#');
    return;
}
