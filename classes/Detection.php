<?php

class Detection{
	  	
public function performDetection($data1,$data2){
	
	
$curl = curl_init();
//
//$IMAGE1_PATH ="images/dc.jpg";
//$IMAGE2_PATH ="images/dhiren.jpg";
//
//
//$img1 = file_get_contents($IMAGE1_PATH); 
//$img2 = file_get_contents($IMAGE2_PATH);
//// Encode the image string data into base64 
//$data1 = base64_encode($img1);
//$data2 = base64_encode($img2);

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://106.51.58.118:5000/compare_faces?face_det=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('img_1' => $data1,'img_2' => $data2),
  CURLOPT_HTTPHEADER => array(
    "user_id: b729df38456dafa674dd",
    "user_key: e5043e9a62571b1aff77"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} 

 }

}
?>