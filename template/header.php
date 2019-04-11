<?php require_once './controllers/connect.php' ?>
<?php require_once './helpers/helpers.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    <?=  getColumnName() !== null ? "BD-Shop | " . getColumnName() : "BD-Shop"?>
  </title>
  <link href="https://fonts.googleapis.com/css?family=Oleo+Script:700" rel="stylesheet">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/main.js" async></script>
</head>
<body>
  <header class="header">
    <div class="container-header">
      <h1 class="page-title"><a href="./">Comics Shop</a></h1>
      <nav class="nav-wrap-account">
        <?php if (isset($_SESSION['user_id'])): ?>
          <a class="link-account" href="">Mon <br> Compte</a>
          <div>Profil</div>
          <div>Panel Admin</div>
          <div>Déconnexion</div>
        <?php else: ?>
          <a class="link-account" href="connexion.php">Connexion</a>
          <a class="link-account" href="inscription.php">Inscription</a>
        <?php endif ?>
        <a
          class="basket-wrap <?= $_SERVER['PHP_SELF'] === '/mon-panier.php' ? 'active' : null ?>"
          href="mon-panier.php"
        >
          <svg class="basket-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1000 1000"><g><path d="M975.9,267.3l-98.7,303.2v28.2c0,14.1-14.1,28.2-28.2,28.2H341.4l21.2,84.6H849c14.1,0,28.2,14.1,28.2,28.2v28.2c0,14.1-14.1,28.2-28.2,28.2H341.4c-7.1,0-14.1-7.1-21.1-14.1c-14.1,0-21.2-7.1-21.2-21.1L129.9,133.4H38.2c-14.1,0-28.2-14.1-28.2-28.2V77c0-14.1,14.1-28.2,28.2-28.2h133.9c14.1,0,28.2,14.1,28.2,28.2l0,0l28.2,105.8h733.2c14.1,0,28.2,14.1,28.2,28.2v28.2C990,253.2,983,260.3,975.9,267.3L975.9,267.3z M834.9,429.5h-84.6l-7,105.8h56.4L834.9,429.5L834.9,429.5z M609.3,542.3h56.4l7.1-112.8h-63.5V542.3L609.3,542.3z M369.6,267.3H249.7l21.2,84.6h105.8L369.6,267.3L369.6,267.3z M383.7,429.5H292l28.2,105.8h70.5L383.7,429.5L383.7,429.5z M524.7,267.3h-77.5l7,84.6h70.5V267.3L524.7,267.3z M524.7,429.5h-63.5l7.1,105.8h56.4V429.5L524.7,429.5z M609.3,351.9h70.5l7.1-84.6h-77.5V351.9L609.3,351.9z M771.4,267.3l-7.1,84.6H856h7.1l28.2-84.6H771.4L771.4,267.3z M404.8,810.2c35.3,0,70.5,28.2,70.5,70.5c0,42.3-28.2,70.5-70.5,70.5c-42.3,0-70.5-28.2-70.5-70.5C334.3,838.4,369.6,810.2,404.8,810.2L404.8,810.2z M757.3,810.2c35.2,0,70.5,28.2,70.5,70.5c0,42.3-28.2,70.5-70.5,70.5c-42.3,0-70.5-28.2-70.5-70.5C686.8,838.4,722.1,810.2,757.3,810.2L757.3,810.2z"/></g></svg>
          <?php if ($_SESSION['basket'] !== []): ?>
            <span class="basket-number"><?= sumBasket($_SESSION['basket']) ?></span>
          <?php endif ?>
        </a>
      </nav>
    </div>
  </header>
  <?php require_once 'nav.php' ?>
  
