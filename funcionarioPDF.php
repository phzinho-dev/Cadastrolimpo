<?php

include "repositorio.php";

//initilize the page
require_once("inc/init.php");
//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

require('./fpdf/mc_table.php');

if ((empty($_GET["sexo"])) || (!isset($_GET["sexo"])) || (is_null($_GET["sexo"]))) {
    $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
    echo "failed#" . $mensagem . ' ';
    return;
} else {
    $sexo= +$_GET["sexo"];
}

$sql = "SELECT USU.codigo , USU.ativo, USU.nomeCompleto, USU.estadoCivil, USU.dataDeNascimento, USU.cpf,
        USU.rg, USUG.descricao, USU.cep,USU.logradouro,USU.numero,USU.uf,USU.bairro,USU.cidade
FROM dbo.funcionario USU 
INNER JOIN dbo.sexo USUG ON USUG.codigo = USU.sexo
WHERE USU.sexo = 17";

$reposit = new reposit();
$result = $reposit->RunQuery($sql);
$out = "";
$row = $result[0];
if ($row) {
    
    $codigo = $row['codigo'];
    $nomeCompleto = $row['nomeCompleto'];
    $estadoCivil =  $row ['estadoCivil'];
    $dataDeNascimento = $row ['dataDeNascimento'];
    $cpf = $row ['cpf'];
    $rg = $row ['rg'];
    $sexo = $row ['descricao'];
    $cep = $row ['cep'];
    $logradouro = $row ['logradouro'];
    $numero = $row['numero'];
    $uf = $row ['uf'];
    $bairro = $row ['bairro'];
    $cidade = $row ['cidade'];

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
        $this->Image('img/images.jpg', 10, 5, 30, 20); #logo da empresa
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Cell(20, 5, 'Pagina ' . $this->pageno()); #Imprime o Número das Páginas

        $this->Ln(11); #Quebra de Linhas
        $this->Ln(8);
    }

    function Footer()
    {

        $this->SetY(202);
    }
}

$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();

//$pdf->SetFont('Arial','',10);
//$pdf->SetLeftMargin(10);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "PDF De Funcionarios Cadastrados"), 0, 0, "C", 0);
$pdf->Ln(10);
$pdf->Line(5, 30, 205, 30); #Linha na Horizontal
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', "Funcionario :"), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "$nomeCompleto"), 0, 0, "L", 0);
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', "Estado Civil :"), 0, 0, "L", 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "$estadoCivil"), 0, 0, "L", 0);
$pdf->Ln(4);


$pdf->Output();