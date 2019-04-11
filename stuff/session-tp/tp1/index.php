<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tp Session</title>
</head>
<body>
<?php
  if (!isset($_SESSION["memberName"])) {
    echo "<a class='button' href='connexion.php'>Login</a>";
  } else {
    echo "<a class='button' href='deconnexion.php'>Disconnect</a>";
  }

  echo "<pre>";
  var_dump($_SESSION);
  echo "</pre>";
?>
</body>
</html>
