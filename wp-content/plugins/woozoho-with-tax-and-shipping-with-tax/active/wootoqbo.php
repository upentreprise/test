<?php

function toquickon(){
    


$woobookexportproduct= get_option('woobookexportproduct');    
 $plus = $woobookexportproduct + 1;   
    
  $consumerkey= get_option('wookey');
$consumersecret= get_option('woosecret');
$siteurlwoo= get_option('woositeurl');
    
 $urlcurl="https://books.zoho.com/api/v3/";
 $woobookcpid= get_option('woobookcompanyid');  
    
  $authcode= get_option('woobookacno');


    




for($a=$woobookexportproduct;$a<$plus;$a++){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://".$siteurlwoo."/wp-json/wc/v2/products?per_page=100&page=".$a."&consumer_key=".$consumerkey."&consumer_secret=".$consumersecret,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$ratul33= (json_decode($response, true));
$count=count($ratul33);


for($x=0;$x<$count;$x++){



$id= $ratul33[$x]['id'];

$price= $ratul33[$x]['price'];
$title=  $ratul33[$x]['name'];

 
    
    // create products in zoho
    


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."items?organization_id=".$woobookcpid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"name\": \"$title\",\n    \"rate\": $price  \n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

sleep(0.5);
    

}
} } 