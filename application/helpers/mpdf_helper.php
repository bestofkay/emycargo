<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once("mpdf60/mpdf.php");
/*function pdf_create($html, $filename='', $stream = TRUE, $encrypt=TRUE, $userpass="", $ownerpass="", $permsArray=array()) 
{
    require_once("mpdf60/config.php");

    $dompdf = new DOMPDF();
	 
    $dompdf->load_html($html);
    $dompdf->render();
    if ($encrypt) $dompdf->get_canvas()->get_cpdf()->setEncryption($userpass, $ownerpass, $permsArray);
    //$dompdf->stream($filename.".pdf");
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
}*/
