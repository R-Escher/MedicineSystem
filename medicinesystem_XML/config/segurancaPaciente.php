<?php


if(isset($_COOKIE)){
  if (!isset($_COOKIE['paciente'])) {
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
