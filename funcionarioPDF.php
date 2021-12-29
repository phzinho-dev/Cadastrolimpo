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
    $sexo = +$_GET["sexo"];
}


$sql = "SELECT USU.codigo , USU.ativo, USU.nomeCompleto, USU.estadoCivil, USU.dataDeNascimento, USU.cpf,
        USU.rg, USUG.descricao, USU.cep,USU.logradouro,USU.numero,USU.uf,USU.bairro,USU.cidade
FROM dbo.funcionario USU 
INNER JOIN dbo.sexo USUG ON USUG.codigo = USU.sexo
WHERE USU.sexo = $sexo";

$reposit = new reposit();
$result = $reposit->RunQuery($sql);
$contadorFuncionario = 0;
$arrayFuncionario = array();
foreach ($result as $row) {

    $codigo = $row['codigo'];
    $nomeCompleto = $row['nomeCompleto'];
    $estadoCivil =  $row['estadoCivil'];
    $dataDeNascimento = $row['dataDeNascimento'];

    $dataDeNascimento = explode(" ", $dataDeNascimento);
    $dataDeNascimento = explode("-", $dataDeNascimento[0]);
    $dataDeNascimento = $dataDeNascimento[2] . "/" . $dataDeNascimento[1] . "/" . $dataDeNascimento[0];

    $cpf = $row['cpf'];
    $rg = $row['rg'];
    $descricao = $row['descricao'];
    $cep = $row['cep'];
    $logradouro = $row['logradouro'];
    $numero = $row['numero'];
    $uf = $row['uf'];
    $bairro = $row['bairro'];
    $cidade = $row['cidade'];

    $contadorFuncionario = $contadorFuncionario + 1;
    $arrayFuncionario[] = array(
        "sequencialFuncionario" => $contadorFuncionario,
        "nomeCompleto" => $nomeCompleto,
        "estadoCivil" => $estadoCivil,
        "dataDeNascimento" => $dataDeNascimento,
        "cpf" => $cpf,
        "rg" => $rg,
        "descricao" => $descricao,
        "cep" => $cep,
        "logradouro" => $logradouro,
        "numero" => $numero,
        "uf" => $uf,
        "bairro" => $bairro,
        "cidade" => $cidade
    );
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
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
$pdf->AddPage();

//$pdf->SetFont('Arial','',10);
//$pdf->SetLeftMargin(10);
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(193, 5, iconv('UTF-8', 'windows-1252', "PDF De Funcionarios Cadastrados"), 0, 0, "C", 0);
$pdf->Line(5, 33, 205, 33); #Linha na Horizontal
$pdf->Ln(10);

$baseY = 40;
$baseAdd = 40;

$pdf->SetFont('Arial', '', 8);
$contadorFuncionario = -1;
foreach ($arrayFuncionario as $key) {


    $contador ++;
    if((($contador % 7) == 0) && $contador != 0 ) {
        $contador = 0;
        $pdf->AddPage();
        $baseY = 25;
    }
    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', "Funcionario:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $key["nomeCompleto"]), 0, 0, "L", 0);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', "Estado Civil:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', $key["estadoCivil"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(37, 5, iconv('UTF-8', 'windows-1252', "Data De Nascimento:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $key["dataDeNascimento"]), 0, 0, "L", 0);

    $pdf->Ln(4);
    $pdf->Ln(4);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 5, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 5, iconv('UTF-8', 'windows-1252', $key["cpf"]), 0, 0, "L", 0);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(8, 5, iconv('UTF-8', 'windows-1252', "RG:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(78, 5, iconv('UTF-8', 'windows-1252', $key["rg"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(11, 5, iconv('UTF-8', 'windows-1252', "Sexo:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $key["descricao"]), 0, 0, "L", 0);

    $pdf->Ln(4);
    $pdf->Ln(4);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 5, iconv('UTF-8', 'windows-1252', "CEP:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(40, 5, iconv('UTF-8', 'windows-1252', $key["cep"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(23, 5, iconv('UTF-8', 'windows-1252', "Logradouro:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(63, 5, iconv('UTF-8', 'windows-1252', $key["logradouro"]), 0, 0, "L", 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(16, 5, iconv('UTF-8', 'windows-1252', "Numero:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $key["numero"]), 0, 0, "L", 0);

    $pdf->Ln(4);
    $pdf->Ln(4);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(8, 5, iconv('UTF-8', 'windows-1252', "UF:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(42, 5, iconv('UTF-8', 'windows-1252', $key["uf"]), 0, 0, "L", 0);
  
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(13, 5, iconv('UTF-8', 'windows-1252', "Bairro:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(73, 5, iconv('UTF-8', 'windows-1252', $key["bairro"]), 0, 0, "L", 0);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "Cidade:"), 0, 0, "L", 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', $key["cidade"]), 0, 0, "L", 0);
    
    $pdf->Ln(4);
    $pdf->Ln(4);

    $pdf->Line(5,$linha + $baseY + 35, 205,$linha + $baseY + 35); #Linha na Horizontal
    $pdf->SetX(5);
    $pdf->SetY(30 + $baseY);
    $pdf->Ln(7);
    
    $baseY = $baseY + $baseAdd;
}
$pdf->Ln(8);

$pdf->Output();
