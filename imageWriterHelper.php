<?php

include_once "helper/php/autoload_helper.php";
date_default_timezone_set("Africa/Lagos");
$result1 = $taskImage->getImageProperties($campaignFile->getId());
if ($result1 != 'empty') {
  foreach ($result1 as $row) {
    $id = $row["id"];
    $imagePath = $row["image_path"];
    $latitude = $row["latitude"];
    $longitude = $row["longitude"];
    $modifiedStatus = $row["image_modified_status"];
    $imageActualDate = $row["image_actual_date"];
    $date = $row["ddate"];
    
    
     if ($modifiedStatus != 1 && !empty($imageActualDate)) {
      $exif_data = extractImageData("image/$imagePath");
      
      $resDetail = computeImageAndGetTextBottomPosition($exif_data);

      $actualDateTime = date('Y-m-d H:i:s', $exif_data['FileDateTime']);
      $inputArray = [
          'image' => "image/$imagePath",
          'img_destination_path' => "image/$imagePath",
          'text' => ['top' => "@postertracker.com", 'bottom' => date('d-M-Y | h:m:s', strtotime($imageActualDate)) . ' | ' . $campaignFile->getTown()],
          'img_quality' => 85,
          'bottom_position' => ['x' => $resDetail['bottom_x'], 'y' => $resDetail['bottom_y']],
      ];
      writeToImage($inputArray);
      $taskImage->updateTaskImage($id, array('image_modified_status' => 1, 'image_actual_date' => $imageActualDate));
    }
//    if ($modifiedStatus != 1) {
//      //extract the dateTime by which the image was taken
//      $exif_data = extractImageData("image/$imagePath");
//
//      $resDetail = computeImageAndGetTextBottomPosition($exif_data);
//
//      $actualDateTime = date('Y-m-d H:i:s', $exif_data['FileDateTime']);
//      $inputArray = [
//          'image' => "image/$imagePath",
//          'img_destination_path' => "image/$imagePath",
//          'text' => ['top' => "@postertracker.com", 'bottom' => date('d-M-Y | h:m:s', strtotime($actualDateTime)) . ' | ' . $campaignFile->getTown()],
//          'img_quality' => 85,
//          'bottom_position' => ['x' => $resDetail['bottom_x'], 'y' => $resDetail['bottom_y']],
//      ];
//      writeToImage($inputArray);
//
//      $taskImage->updateTaskImage($id, array('image_modified_status' => 1, 'image_actual_date' => $actualDateTime));
//    }
   
  }
}

function computeImageAndGetTextBottomPosition($exif_data = array()) {
  $imageHeight = $exif_data['COMPUTED']['Height'];
  $imageWidth = $exif_data['COMPUTED']['Width'];
  $bottom_x = "";
  $bottom_y = "";

  if ($imageWidth >= 601 && $imageWidth <= 850) {
    $bottom_x = 250;
    $bottom_y = $imageHeight - 20;
  }

  if ($imageWidth >= 300 && $imageWidth <= 600) {
    $bottom_x = 5;
    $bottom_y = $imageHeight - 20;
  }
  
  return array("bottom_x"=>$bottom_x,"bottom_y"=>$bottom_y);
}
