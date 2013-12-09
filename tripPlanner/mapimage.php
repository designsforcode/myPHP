<?php

if(!isset($_GET['states'])){
   header("HTTP/1.0 404 Not Found");
   exit();
}

// load data
$stateStr = preg_replace("/[^A-Z,]*/","",$_GET['states']);
$url = "http://russet.wccnet.edu/~jbjarvis/CPS276/api/locations.php?apikey=fred&states=".$stateStr;
$data = @json_decode(file_get_contents($url),true);

if(!$data['distance']){
   header("HTTP/1.0 404 Not Found");
   exit();
}

// draw image
$img = @imagecreatefromjpeg("us_map.jpg");
// draw from start to end
$c = count($data['path']);
if($c > 1){
   $lineColor = imagecolorallocate($img, 200, 5, 5);
   imagesetthickness ( $img , 5 );
   $x = $data['path'][0]['x'];
   $y = $data['path'][0]['y'];
   for($i = 1; $i < $c; $i++){
      $x2 = $data['path'][$i]['x'];
      $y2 = $data['path'][$i]['y'];
      imageline($img,$x , $y , $x2 , $y2 ,$lineColor );
      $x=$x2; $y=$y2;
   }    
}
header('Content-Type: image/jpeg');

imagejpeg($img,null,75);
imagedestroy($img);
