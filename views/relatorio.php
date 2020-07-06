<?php
require_once($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/fpdf182/fpdf.php');
require_once($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
require_once($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/perfisDAO.php');

$myuser = new usuarios();
$userDAO = new usuariosDAO($myuser);
$arrUsuarios = $myuser->findAll();

$perf = new perfis();
$perfDAO = new perfisDAO($perf);
$arrPerfis = $perfDAO->load();


ini_set("session.auto_start", 0);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetTitle('LISTA DE USUÁRIOS',true);
$pdf->Cell(190,25,'LISTA DE USUARIOS',0,1,'C');

//HEADER DO RELATORIO
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,15,"Nro.",1,0,'C');
$pdf->Cell(70,15,"Nome",1,0,'C');
$pdf->Cell(65,15,"E-mail",1,0,'C');
$pdf->Cell(40,15,"Perfil",1,1,'C');

//CORPO DO RELATORIO
$i = 1;
foreach($arrUsuarios as $usuario){
    //AJUSTE PERFIL
    foreach($arrPerfis as $perfil){        
        if($usuario->id_perfil == $perfil->getId()){
            $nomePerfil = $perfil->getNome();
        }
    }
    //ZEBRA
    if($i % 2 == 1){
        $pdf->SetFillColor(211,211,211);
    }
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(15,8,$i,1,0,'C',true);
    $pdf->Cell(70,8,$usuario->nome,1,0,'C',true);
    $pdf->Cell(65,8,$usuario->email,1,0,'C',true);
    $pdf->Cell(40,8,$nomePerfil,1,1,'C',true);
    $pdf->SetFillColor(255,255,255);
    $i++;
}

//FOOTER


//IMPRESSAO DO RELATORIO
$pdf->Output("I","Relatorio.pdf",true);
?>