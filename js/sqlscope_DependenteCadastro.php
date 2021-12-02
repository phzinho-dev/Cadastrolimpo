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
function grava()
{

    $reposit = new reposit(); //Abre a conexão.

    session_start();
    $codigo = (int)$_POST['id'];
    $ativo = (int)$_POST['ativo'];
    $descricao= "'" . (string)$_POST['descricao'] . "'";
    

    $sql = "dbo.tipo_dependente_Atualiza
            $codigo,
            $ativo,
            $descricao";

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

    $sql = "SELECT codigo,ativo,descricao FROM dbo.tipo_dependente WHERE (0 = 0)";

    $sql = $sql . " AND codigo = " . $codigo;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = (int)$row['codigo'];
        $ativo = $row['ativo'];
        $descricao = $row ['descricao'];

        $out = $id ."^" . $ativo. "^" . $descricao  ;

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

    $result = $reposit->update('dbo.tipo_dependente' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}