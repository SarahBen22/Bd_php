<?php
session_start();

if (isset($_POST["login"]) && $_POST["login"] === "admin") {
  $_SESSION["memberName"] = $_POST["login"];
  header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tp Session</title>
</head>
<body>
  <form method="POST">
    <label for="login">Login : </label>
    <input type="text" name="login" id="login">
  </form>

<?php
  if (isset($_POST["login"])) {
    echo "<p>Essaye encore</p>";
  }
?>

</body>
</html>
