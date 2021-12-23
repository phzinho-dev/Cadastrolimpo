<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');

if ((empty($_GET["codigo"])) || (!isset($_GET["codigo"])) || (is_null($_GET["codigo"]))) {
    $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
    echo "failed#" . $mensagem . ' ';
    return;
} else {
    $id = +$_GET["codigo"];
}

$sql = "SELECT codigo,nomeCompleto,cpf
FROM dbo.funcionario WHERE (0=0) AND codigo =" . $id;

$reposit = new reposit();
$result = $reposit->RunQuery($sql);
$out = "";
$row = $result[0];
if ($row) {

    $codigo = $row['codigo'];
    $nomeCompleto = $row['nomeCompleto'];
    $cpf = $row['cpf'];

    // //----------------------Montando o array do EMAIL


    $reposit = "";
    $result = "";
    $sql = "SELECT F.codigo, E.email, E.funcionario, E.principal AS 'emailPrincipal'FROM dbo.funcionario F
    LEFT JOIN dbo.funcionario_email E ON F.codigo = E.funcionario WHERE F.codigo = " . $id;
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $contadorEmail = 0;
    $arrayEmail = array();
    foreach ($result as $row) {

        $email = $row['email'];
        if ($email == 0) {
            $email = "Não Cadastrado";
        } else {
            $email = $email;
        }

        $funcionario = $row['funcionario'];
        $emailPrincipal = $row['emailPrincipal'];
        if ($emailPrincipal == 1) {
            $emailPrincipal = "Sim";
        } else {
            $emailPrincipal = "Não";
        }

        $contadorEmail = $contadorEmail + 1;
        $arrayEmail[] = array(
            "sequencialEmail" => $contadorEmail,
            "email" => $email,
            "email_Principal" => $emailPrincipal
        );
    }

    $strArrayEmail = json_encode($arrayEmail);


    $reposit = "";
    $result = "";
    $sql = "SELECT F.codigo, T.telefone, T.funcionario, T.principal AS 'telefonePrincipal', T.whatsapp FROM dbo.funcionario F
    LEFT JOIN dbo.funcionario_telefone T ON F.codigo = T.funcionario WHERE F.codigo = " . $id;
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $contadorTelefone = 0;
    $arrayTelefone = array();
    foreach ($result as $row) {

        $telefone = $row['telefone'];
        
        $funcionario = $row['funcionario'];
        $telefonePrincipal = $row['telefonePrincipal'];
        if ($telefonePrincipal == 1) {
            $telefonePrincipal = "Sim";
        } else {
            $telefonePrincipal = "Não";
        }

        $whatsapp = $row['whatsapp'];
        if ($whatsapp == 1) {
            $whatsapp = "Sim";
        } else {
            $whatsapp = "Não";
        }

        $contadorTelefone = $contadorTelefone + 1;
        $arrayTelefone[] = array(
            "sequencialTelefone" => $contadorTelefone,
            "telefone" => $telefone,
            "telefonePrincipal" => $telefonePrincipal,
            "whatsapp" => $whatsapp
        );
    }

    $strArrayTelefone = json_encode($arrayTelefone);
}
require_once('fpdf/fpdf.php');

class PDF extends FPDF
{

    function Header()
    {
        global $codigo;

        //        if ($nomeLogoRelatorio != "")
        //        $this->SetFont('Arial', '', 8); #Seta a Fonte
        //        $dataAux = new DateTime();
        //        $dataAux->setTimezone(new DateTimeZone("GMT-3"));
        //        $dataAtualizada = $dataAux->format('d/m/Y H:i:s');
        //        $this->Cell(288, 0, $dataAtualizada, 0, 0, 'R', 0); #Título do Relatório
        $this->Cell(116, 1, "", 0, 1, 'C', 0); #Título do Relatório
        $this->Image('img/logoNTLnova.png', -3, 5, 60, 20); #logo da empresa
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Cell(20, 5, 'Pagina ' . $this->pageno()); #Imprime o Número das Página
        $this->Ln(11); #Quebra de Linhas
        $this->Ln(8);
    }
    function Footer()
    {
        $this->SetY(202);
    }
}

$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();

//$pdf->SetFont('Arial','',10);
//$pdf->SetLeftMargin(10);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "PDF Contatos do Funcionario"), 0, 0, "C", 0);
$pdf->Ln(10);
$pdf->Line(5, 30, 205, 30); #Linha na Horizontal
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(193, 3, iconv('UTF-8', 'windows-1252', "Funcionario: $nomeCompleto "), 0, 0, "L", 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "CPF: $cpf"), 0, 0, "L", 0);

$pdf->Ln(5);
$pdf->Ln(5);


$pdf->SetFillColor(234, 234, 234);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(5);

$pdf->SetX(60);


$pdf->Cell(55, 10, iconv('UTF-8', 'windows-1252', "Email"), 1, 0, "C", true);
$pdf->Cell(35, 10, iconv('UTF-8', 'windows-1252', "Principal"), 1, 0, "C", true);

$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$contador = 0;
foreach ($arrayEmail as $key) {

    $contador = $contador + 1;
    $sequencialEmail = $key["sequencialEmail"];
    $email = $key["email"];

    $emailPrincipal = $key["email_Principal"];
    $emailPrincipal = iconv('UTF-8', 'windows-1252', $emailPrincipal);

    $pdf->SetX(60);
    $pdf->SetWidths(array(55, 35, 45, 20, 20, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->Row(array($email, $emailPrincipal));
}

$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln(5);

$pdf->SetX(60);

$pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', 'Telefone'), 1, 0, "C", true);
$pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "Principal"), 1, 0, "C", true);
$pdf->Cell(25, 10, iconv('UTF-8', 'windows-1252', "whatsapp"), 1, 0, "C", true);

$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$contador = 0;
foreach ($arrayTelefone as $key) {

    $contador = $contador + 1;
    $sequencialTelefone = $key["sequencialTelefone"];
    $telefone = $key["telefone"];

    $telefonePrincipal = $key["telefonePrincipal"];
    $telefonePrincipal = iconv('UTF-8', 'windows-1252', $telefonePrincipal);

    $whatsapp = $key["whatsapp"];
    $whatsapp = iconv('UTF-8', 'windows-1252', $whatsapp);

    $pdf->SetX(60);
    $pdf->SetWidths(array(45, 20, 25, 20, 20, 33, 10, 20, 20, 20, 20, 20, 30));
    $pdf->Row(array($telefone,$telefonePrincipal,$whatsapp));
}

$pdf->Ln(8);


$pdf->Output();
