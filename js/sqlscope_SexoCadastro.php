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
if ($funcao == 'verificaSexo') {
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
    $descricaoSexo = "'" . (string)$_POST['descricaoSexo'] . "'" ;
    

    $sql = "dbo.sexo_atualiza
            $codigo,
            $ativo,
            $descricaoSexo";

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

    $sql = "SELECT codigo,ativo,descricaoSexo FROM dbo.sexo WHERE (0 = 0)";

    $sql = $sql . " AND codigo = " . $codigo;

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";

    if ($row = $result[0]) {

        $id = (int)$row['codigo'];
        $ativo = $row['ativo'];
        $descricaoSexo = $row ['descricaoSexo'];

        $out = $id ."^" . $ativo. "^" . $descricaoSexo  ;

        if ($out == "") {
            echo "failed#";
        }
        if ($out != '') {
            echo "sucess#" . $out;
        }
        return;
    }
}
function verificaSexo()
{
    $descricaoSexo = "'" . $_POST["descricaoSexo"] . "'";

    $sql = "SELECT descricaoSexo FROM dbo.sexo
    WHERE descricaoSexo = " .  $descricaoSexo;

    $reposit = new reposit();

    $result = $reposit->RunQuery($sql);

    if ($result) {
        echo ('failed#');
        return;
    }
    echo ('sucess#');
    return;
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

    $result = $reposit->update('dbo.sexo' . '|' . 'ativo = 0' . '|' . 'codigo = ' . $id);

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}