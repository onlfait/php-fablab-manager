<?php
function pfm_get_events() {
  global $PFM;
  $query = "SELECT * FROM pfm_events ORDER BY HeureDebut";
  return mysqli_query($PFM['db']['link'], $query);
}
