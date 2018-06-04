<?php
function truncateString($string, $length) {
  $stringValue = "";
  //if string value is >= to length then call truncate function
  if (is_numeric($length)) {
    if (strlen($string) > $length) {
      $stringValue = substr($string, 0, $length) . "...";
    } else {//else display the way it is
      $stringValue = $string;
    }
  } else {
    $stringValue = $string;
  }

  return $stringValue;

}

function randomString($lenght) {
    $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $name = "";
    for ($i = 0; $i < $lenght; $i++) {
      $name .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $name;
  }