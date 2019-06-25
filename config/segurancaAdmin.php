<?php

if(isset($_COOKIE)){
  if (!isset($_COOKIE['administrador'])) {
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
