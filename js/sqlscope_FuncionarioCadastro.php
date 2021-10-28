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

if ($funcao =='verificaCPF'){
    call_user_func($funcao);
}

if ($funcao =='verificaRG'){
    call_user_func($funcao);
}

return;

function grava()
{

    $reposit = new reposit(); //Abre a conexão.

    session_start();
    $codigo = (int)$_POST['id'];
    $nome = "'" . (string)$_POST['nome'] . "'";
    $cpf = "'" . (string) $_POST['cpf'] . "'";
    $dataDeNascimento = $_POST['dataDeNascimento'];
    $ativo = (int)$_POST['ativo'];
    $rg ="'" . (string)$_POST['rg'] . "'";
    $sexo= "'" . (string)$_POST['sexo'] . "'";

    //Converção de data
    $dataDeNascimento = explode("/", $dataDeNascimento);
    $dataDeNascimento = "'" . $dataDeNascimento[2] . "-" . $dataDeNascimento[1] . "-" . $dataDeNascimento[0] . "'";

    $sql = "dbo.funcionario_Atualiza
            $codigo,
            $nome,
            $ativo,
            $dataDeNascimento,
            $cpf,
            $rg,
            $sexo";

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

    $sql = "SELECT codigo, ativo, nomeCompleto, dataDeNascimento, cpf , rg , sexo FROM dbo.funcionario WHERE (0 = 0)";

    $sql = $sql . " AND codigo = " . $codigo;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = (int)$row['codigo'];
        $ativo = $row['ativo'];
        $nome = (string)$row['nomeCompleto'];
        $dataDeNascimento = $row['dataDeNascimento'];
        $sexo = $row ['sexo'];

        //Converção de data
        $dataDeNascimento = explode(" ", $dataDeNascimento);
        $dataDeNascimento = explode("-", $dataDeNascimento[0]);
        $dataDeNascimento = $dataDeNascimento[2] . "/" . $dataDeNascimento[1] . "/" . $dataDeNascimento[0];
        $cpf = $row['cpf'];
        $sexo = $row ['sexo'];


        $out = $id . "^" . $ativo . "^" . $nome . "^" . $dataDeNascimento . "^" . $cpf . "^" . $sexo  ;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out;
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
    WHERE cpf = " .  $cpf ;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    if ($result[0]['cpf'] === $_POST["cpf"]) {
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
    WHERE rg = " .  $rg ;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    if ($result[0]['rg'] === $_POST["rg"]) {
        echo ('failed#');
        return;
    } 
    echo ('sucess#');
        return;

}
