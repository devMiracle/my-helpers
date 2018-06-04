<?php

function addImage($urlPath, $imageArray) {
//    print_r($imageArray);
  $imageArrExt = ["image/png", "image/jpeg"];

  $imageName = $imageArray['name'];
  $imageTempName = $imageArray['tmp_name'];
//  $imageSize = $imageArray['size'];
  $imageType = $imageArray['type'];
  $imageError = $imageArray['error'];
  if ($imageError == 0) {
    if (in_array($imageType, $imageArrExt)) {
      $now = DateTime::createFromFormat('U.u', microtime(true));
      $imageName = $now->format('YmdHisu');
      $path = "$urlPath/$imageName.jpeg";
      if(moveImage($path, $imageTempName)){
        return "$imageName.jpeg";
      }else{
        return "";
      }
    }
  }
}

/**
 * 
 * @param type $path
 * @param type $imageTempName
 * @return boolean
 */
function moveImage($path, $imageTempName) {
  $status = false;
  if(move_uploaded_file($imageTempName, $path)){
    $status = true;
  }
  return $status;
}

/**
 * @param type $source
 * @param type $imgDestinationPath
 * @param type $quality
 * @return string
 */
function compress($source, $imgDestinationPath, $quality="75") {

    $info = getimagesize($source);
    
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $imgDestinationPath, $quality);

    return $imgDestinationPath;
}

/**
 * @param type $imagePath
 * @return array
 */
function extractImageData($imagePath){
  return exif_read_data($imagePath);
}

/*
* @param inputArray
* inputArray = [
*   'image' => "",
*   'img_destination_path' => "",
*   'img_quality' => "75",
*   'color' => ['r'=>180,'g'=>230,'b'=>100],
*   'text' => ['top'=>"",'bottom'=>""],
*   'text_size' => "",
*   'top_position' => ['x'=>"",'y'=>""],
*   'bottom_position' => ['x'=>"",'y'=>""],
* ];
*  
*/

// function writeToImage($image,$destinationPath,$topText="",$buttomText="",$fontSize){
function writeToImage($imageArray = array()){  
  if(!array_key_exists('text_size',$imageArray)){
        $imageArray['text_size'] = 3;
    }
    if(!array_key_exists('img_quality',$imageArray)){
        $imageArray['img_quality'] = 75;
    }
    if(!array_key_exists('top_position',$imageArray)){
        $imageArray['top_position']['x'] = 2;
        $imageArray['top_position']['y'] = 2;
    }
    
    if(!array_key_exists('bottom_position',$imageArray)){
        $imageArray['bottom_position']['x'] = 350;//for 612 width
        $imageArray['bottom_position']['y'] = 320;//for 344 height
    }
    if(!array_key_exists('color',$imageArray)){
        $imageArray['color']['r'] = 180;
        $imageArray['color']['g'] = 230;
        $imageArray['color']['b'] = 100;
    }


    $image = imagecreatefromjpeg($imageArray['image']);
    $color = imagecolorallocate($image,  $imageArray['color']['r'], $imageArray['color']['g'], $imageArray['color']['b']);
   
    imagestring($image, $imageArray['text_size'], $imageArray['top_position']['x'], $imageArray['top_position']['y'], $imageArray['text']['top'], $color);
    imagestring($image, $imageArray['text_size'], $imageArray['bottom_position']['x'], $imageArray['bottom_position']['y'], $imageArray['text']['bottom'], $color);

    imagejpeg($image,$imageArray['img_destination_path'], $imageArray['img_quality']);
    return $imageArray['img_destination_path'];
  
}