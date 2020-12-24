<?php
  require_once 's.php';
  $pdo = new PDO($sql_param_1, $sql_param_2, $sql_param_3);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
