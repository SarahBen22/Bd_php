<?php
session_start();
$monTableau['lundi']="des frites";
$monTableau['mardi']="des haricots";
$monTableau['mercredi']="langue de boeuf";

$_SESSION['toto'] = $monTableau;

?>

<a href='test4.php'>Autre page</a>