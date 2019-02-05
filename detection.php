<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://106.51.58.118:5000/compare_faces?face_det=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('img_1' => 'https://cdn.dnaindia.com/sites/default/files/styles/full/public/2018/03/08/658858-577200-katrina-kaif-052217.jpg','img_2' => 'https://cdn.somethinghaute.com/wp-content/uploads/2018/07/katrina-kaif.jpg'),
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
	$str=json_decode($response,true);
	echo $str['confidence'];
//  echo $response;
} ?>