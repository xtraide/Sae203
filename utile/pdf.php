<?php 
$mpdf=new \Mpdf\Mpdf(); $mpdf->WriteHTML($html);
    $file='files/'.time().'.pdf';
    $mpdf->output($file,'I');