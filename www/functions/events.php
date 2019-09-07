<?php
// get all events
// TODO limit to last X events
function pfm_get_events() {
  global $PFM;

  $query = "SELECT * FROM pfm_events ORDER BY HeureDebut";

  return mysqli_query($PFM['db']['link'], $query);
}

// get event info by info id
// TODO reduce/optimize query number
function pfm_get_event_info($id, $type) {
  global $PFM;

  $results = [];
  $query   = "SELECT * FROM Liaison WHERE IDEvent = '$id' AND $type IS NOT NULL";
  $result  = mysqli_query($PFM['db']['link'], $query);

  while ($row = mysqli_fetch_object($result)) {
    array_push($results, $row);
  }

  mysqli_free_result($result);
  return $results;
}

// fetch an event if any,
// call pfm_get_events() before and pass the result
function pfm_fetch_event($events) {
  $event = mysqli_fetch_object($events);

  // no more events
  if (! $event) {
    return null;
  }

  // get infos
  $results = pfm_get_event_info($event->id, 'Ateliers');
  $event->Ateliers = $results[0]->Ateliers;

  $results = pfm_get_event_info($event->id, 'Sujets');
  $event->Sujets = $results;

  $results = pfm_get_event_info($event->id, 'Outils');
  $event->Outils = $results;

  return $event;
}
