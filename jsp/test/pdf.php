<?php
/**
 * Created by PhpStorm.
 * User: 子健
 * Date: 2016-3-22
 * Time: 11:05
 */
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
var_dump(1231231);
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();