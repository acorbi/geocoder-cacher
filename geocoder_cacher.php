<?php

  ini_set('display_errors', 1);
  require_once('config.php');

  header('Access-Control-Allow-Origin: *');

  /** Get parameter */
  $location = $_GET['location'];

  /** Before doing any request to the Mapquest API, look for cached url */
  $filename = "cached/".$location;

  /** If user's profile img was already chached, return it inmediatelly */
  if (file_exists($filename)){

    echo file_get_contents($filename);

  }else{

    $parameters = explode("_", $location);

    $url = 'http://open.mapquestapi.com/geocoding/v1/address?key='.$settings["mapquest_api_key"].'&country='.$parameters[0].'&city='.$parameters[1];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $json = curl_exec($ch);
    $obj = json_decode($json);
    $gps_coordinates = $obj->results[0]->locations[0]->latLng->lat.",".$obj->results[0]->locations[0]->latLng->lng;
    curl_close($ch);

    if ($gps_coordinates == ","){

      header('HTTP/1.1 400 Bad Request');

    }else{
      file_put_contents($filename,$gps_coordinates);

      header("Content-type: text/plain; charset=utf-8");
      echo $gps_coordinates;
    }

  }

?>
