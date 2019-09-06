<?php


if(isset($_COOKIE)){
  if (!isset($_COOKIE['medico'])) {
    echo "<script>window.location.href='index.php';</script>";
  }
}
?>
