<?php
session_start();

session_destroy();

header('location:test4.php',FALSE);
?>