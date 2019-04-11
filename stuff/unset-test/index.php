<?php

require './Panier.php';




$Panier = new Panier();

$article1 = new Article(100, 'toto');
$article2 = new Article(200, 'tata');
$article3 = new Article(300, 'titi');
$article4 = new Article(400, 'tutu');



$Panier->addArticle($article1);
$Panier->addArticle($article2);
$Panier->addArticle($article1);
$Panier->addArticle($article2);
$Panier->addArticle($article2);
$Panier->addArticle($article3);
$Panier->addArticle($article3);
$Panier->addArticle($article2);
$Panier->addArticle($article4);

print_r($Panier->delArticle(500));


consoleLog($Panier->getAll());

?>
