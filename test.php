<?php

include_once "helper/php/autoload_helper.php";

// $source_img = 'img/3.jpg';
// $destination_img = 'img/destination.jpg';

// $imagePath = compress($source_img, $destination_img);
$extractedImage = extractImageData("img/20180425083453110000.jpeg");
echo "<pre>";
print_r($extractedImage);
$imageHeight = $extractedImage['COMPUTED']['Height'];

$imageWidth = $extractedImage['COMPUTED']['Width'];



//to position a text at the right bottom
// 1st get the height and width of the image
// 2ndly whatever the height is subtract 5 from it and assign the value to imageBottomPosition y
// 3rdly whatever the width is substract 5 from it,  
//
$bottom_x = "";
$bottom_y = "";

if($imageWidth >= 601 && $imageWidth <= 850){
	$bottom_x = 300;
	$bottom_y = $imageHeight - 20;
}

if($imageWidth >= 300 && $imageWidth <= 600){
	$bottom_x = 5;
	$bottom_y = $imageHeight - 20;
} 
$inputArray = [
  'image' => "img/20180425083453110000.jpeg",
  'img_destination_path' => "img/20180425083453110000.jpeg",
  'text' => ['top'=>"@Poster Tracker",'bottom'=>"TMKG | 12th May, 2018 | Lagos"],
  'bottom_position' => ['x'=>$bottom_x,'y'=>$bottom_y],
 ];

//  // $inputArray = [
//  //  'image' => "img/3.jpg",
//  //  'img_destination_path' => "img/destination5.jpg",
//  //  'text' => ['top'=>"@Poster Tracker",'bottom'=>"TMKG | 12th May, 2018 | Lagos"],
//  //  'text_size' => 3,
//  //  'img_quality' = 75,
//  //  'top_position' => ['x'=>"9",'y'=>"10"],
//  //  'bottom_position' => ['x'=>"230",'y'=>"300"],
//  //  'color' => ['r'=>180,'g'=>230,'b'=>100],
//  // ];
$imagePath = writeToImage($inputArray);


echo "<pre>";
echo json_encode(extractImageData($imagePath),JSON_PRETTY_PRINT);
// print_r(date('Y-m-d H:i:s',$exif_data['FileDateTime']));