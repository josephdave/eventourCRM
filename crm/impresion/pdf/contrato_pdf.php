<?php
//error_reporting(0);
$url="http://eventoursport.travel/crm/";
$plan = $_REQUEST['plan'];
$firma =$_REQUEST['firma'];
require_once("../../control/control.php");
$control = new Control();
$cartaa=$_REQUEST['carta_aceptacion'];
if(isset($firma)){
	$cliente = $control->datosViajero($firma);
}

if($cliente['id_grupo'] == 141){
		$cartaa=1;
}
//============================================================+
// File name   : example_021.php
// Begin       : 2008-03-04
// Last Update : 2010-08-08
//
// Description : Example 021 for TCPDF class
//               WriteHTML text flow
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               Manor Coach House, Church Hill
//               Aldershot, Hants, GU12 4RQ
//               UK
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML text flow.
 * @author Nicola Asuni
 * @since 2008-03-04
 */

require_once('../config/lang/eng.php');
require_once('../tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Eventour');
$pdf->SetTitle('Eventour Sport');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();
// create some HTML content
if($cartaa==1){
//$handle =fopen($url.'programas/grupo_print.php?plan='.$cliente['id_grupo'].'&accion=print&firma='.$firma, "r");
	
	$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url.'programas/grupo_print.php');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'plan='.$cliente['id_grupo'].'&accion=print&firma='.$firma);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);

}else{
	
//$handle =fopen($url.'programas/grupo-print.php?plan='.$plan.'&accion=print&firma='.$firma, "r");
	
	$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url.'programas/grupo-print.php');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'plan='.$plan.'&accion=print&firma='.$firma);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
curl_close($ch);
}
//'.$nit.'&mes='.$mes.'&anio='.$anio.'&contrato='.$contrato , "r");
//pull down the contents of that page
//$contents = stream_get_contents($handle);
//close the connection
//fclose($handle);





//var_dump($html);

//$html = $contents;

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
//$pdf->lastPage();


$svgString=$cliente['firma'];
$pos=$pdf->GetY();

//var_dump($svgString);



if($svgString != ""){

	$dataPieces = explode(',',$svgString);
$encodedImg = $dataPieces[1];
$decodedImg = base64_decode($encodedImg);
	
$pdf->ImageSVG('@'.$decodedImg, $x=10, $y=$pos, $w=60, $h=60, $link='', $align='', $palign='', $border=0, $fitonpage=false);
	
	

	
	
		$html=" <strong>FIRMA RESPONSABLE <br>
</strong><br/>".$cliente['facturacion_nombre']."<br/>".$cliente['facturacion_nodocumento'];
$pdf->writeHTML($html, true, 0, true, 0);

	
}

// ---------------------------------------------------------

//Close and output PDF document
if(isset($_REQUEST['descarga'])){
	if($_REQUEST['descarga']=='i'){
$pdf->Output('Eventour.pdf', 'I');	
	}

	if($_REQUEST['descarga']=='f'){
$pdf->Output('contratos_firmados/contrato_'.$firma.'.pdf', 'F');	
//$pdf->Output('Eventour.pdf', 'I');	
		
	}
	if($_REQUEST['descarga']=='fi'){
$pdf->Output('contratos_firmados/contrato_'.$firma.'.pdf', 'F');	
$pdf->Output('Eventour.pdf', 'I');	
	}else{
$pdf->Output('Eventour.pdf', 'D');	
		
	}
}else{
$pdf->Output('Eventour.pdf', 'D');
}

//============================================================+
// END OF FILE                                                
//============================================================+
