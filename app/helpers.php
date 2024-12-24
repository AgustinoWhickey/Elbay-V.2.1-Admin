<?php

function api_data_post($url, $params){

    $data_string = json_encode($params);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result;
 }

 function api_data_put($url, $params){

   $data_string = json_encode($params);

   $curl = curl_init($url);

   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
   );

   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
   curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 

   $result = curl_exec($curl);

   curl_close($curl);

   echo $result;
}

 function api_data_deletes($url){
 
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
   curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $response = curl_exec($curl);
   curl_close($curl);
   echo $response; 
   }

 function api_data_delete($url, $params){

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded'
   ));

   $response = curl_exec($ch);

   curl_close($ch);
}

 function api_data_get($url){

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Elbay API Request'
    ));

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
 }

 function indo_currency($nominal)
 {
	$result = "Rp. ".number_format($nominal, 0, ',', '.');
	return $result;
 }