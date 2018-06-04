<?php

function getMyDate($dateTime1) {
  date_default_timezone_set("Africa/Lagos");
  $date1 = new DateTime($dateTime1); //starts
  $date2 = new DateTime(); //ends

  $diff = $date1->diff($date2);

  $myDateStatus = serializeDate($diff);
  return $myDateStatus;
}

function serializeDate($diff) {
  $years = $diff->y;
  $result = "";

  if ($years > 0) {
    if ($years == 1) {
      $result = "One year ago";
    } else {
      $result = "$years years ago";
    }
  } else {
    $months = $diff->m;
    if ($months > 0) {
      if ($months == 1) {
        $result = "One month ago";
      } else {
        $result = "$months months ago";
      }
    } else {
      $days = $diff->d;
      if ($days > 0) {
        if ($days == 1) {
          $result = "One day ago";
        } else {
          $result = "$days days ago";
        }
      } else {
        $hours = $diff->h;
        if ($hours > 0) {
          if ($hours == 1) {
            $result = "One hour ago";
          } else {
            $result = "$hours hours ago";
          }
        } else {
          $minutes = $diff->i;
          if ($minutes > 0) {
            if ($minutes == 1) {
              $result = "One minute ago";
            } else {
              $result = "$minutes minutes ago";
            }
          } else {
            $seconds = $diff->s;
            if ($seconds == 1) {
              $result = "One second ago";
            } else {
              $result = "$seconds seconds ago";
            }
          }
        }
      }
    }
  }
  return $result;
}