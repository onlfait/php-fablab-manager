<?php
function pfm_db_connect() {
  global $PFM;

  extract($PFM['db']);

  $link = mysqli_connect($host, $user, $pass, $name)
    or die('Connection failed: ' . mysqli_connect_error());

  mysqli_query($link, 'SET NAMES UTF8');

  $PFM['db']['link'] = $link;
}

function pfm_db_disconnect() {
  global $PFM;
  mysqli_close($PFM['db']['link']);
  $PFM['db']['link'] = null;
}
