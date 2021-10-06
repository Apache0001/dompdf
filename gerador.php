<?php 
require __DIR__."/vendor/autoload.php";
//pega o conteúdo do arquivo table.php
$content = file_get_contents('http://localhost/dompdf/table.php');
//salva em teste.html o conteudo do table.php
file_put_contents("teste.html", $content);

use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
//pega o conteúdo do arquivo teste.html
$html = file_get_contents('teste.html');

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Pedidos');