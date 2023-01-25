<?php


include('../lib/phpqrcode/qrlib.php');
QRcode::png($_GET["data"],false,'H',7,4,false);

?>
