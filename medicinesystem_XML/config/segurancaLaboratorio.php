<?php


if(isset($_COOKIE)){
  if (!isset($_COOKIE['laboratorio'])) {
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
