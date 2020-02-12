<?php
function misha_bulk_process_custom_status() {
 
	// if an array with order IDs is not presented, exit the function
	if( !isset( $_REQUEST['post'] ) && !is_array( $_REQUEST['post'] ) )
		return;
 
	foreach( $_REQUEST['post'] as $order_id ) {
 
       $order = new WC_Order( $order_id);
    $email12 = $order->billing_email;
 $firstname12 = $order->billing_first_name;
    $lastname12= $order->billing_last_name;
    $fullname= $firstname12.$lastname12;
    $phone1 = $order->billing_phone;
    $billing_address = $order->billing_address_1;
     $billing_address2 = $order->billing_address_2;
    $billing_city = $order->billing_city;
    $billing_company= $order->billing_company;
   $billing_state = $order->billing_state;
   $billing_postcode = $order->billing_postcode;
   $billing_country = $order->billing_country;
    $cart_discount = $order->cart_discount;
    $shipping_type = $order->get_shipping_method();
    $shipping_cost = $order->get_total_shipping();
    
   $productid = array(); 
    $urlcurl="https://books.zoho.com/api/v3/";
 $woobookcpid= get_option('woobookcompanyid'); 
    $taxref= get_option('woobooktaxref'); 
 
 
    
      $shipping_product_id=  get_option('woobookshipping'); 
    
     $total_tax1 = $order->get_total_tax();
    
  
  
 
$woobook_product_price1=get_post_meta($product_id, 'woobook_quickbooks_product_price', true);
    
  $woobook_total_price= $product_qty * $woobook_product_price1; 
 $woobook_product_price= $woobook_total_price - $cart_discount; 


    

    
    
$woobook_create_estimate=get_post_meta($product_id, 'woobook_create_estimate', true);   
 

 $woobook_create_invoice=get_post_meta($product_id, 'woobook_create_invoice', true);   
 
 
    
  $woobook_create_sales_receipt=get_post_meta($product_id, 'woobook_create_sales_receipt', true);   
 
 
    
$woobook_create_payment=get_post_meta($product_id, 'woobook_create_payment', true);  
    
//$woobook_create_vendor=get_post_meta($product_id, 'woobook_create_vendor', true); 
    
    //getting template id 
   $invoice= get_option('woobookintmp');
    $estimate= get_option('woobookestmp');
    $salesorder= get_option('woobooksalestmp');
    $payment= get_option('woobookpaymenttmp');
     $authcode= get_option('woobookacno');
    
    
    
    
    
    
    
    
    
    
    $consumerkey= get_option('wookey');
$consumersecret= get_option('woosecret');
$siteurlwoo= get_option('woositeurl');
    
 $urlcurl="https://books.zoho.com/api/v3/";
 $woobookcpid= get_option('woobookcompanyid');  
   
    
    
    
    
    
    
    
//search contact with email in zohobook
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://books.zoho.com/api/v3/contacts?organization_id=".$woobookcpid."&email_contains=".$email12,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$ratul1330= (json_decode($response, true));
 $contact_id= $ratul1330["contacts"][0]["contact_id"];   

    
    
    ////////// create contact
    
if(is_null($contact_id)){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."contacts?organization_id=".$woobookcpid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"contact_name\": \"$fullname\",\n    \n    \n    \"contact_type\": \"customer\",\n    \"is_portal_enabled\": false,\n    \n    \"notes\": \"Payment option : Woocommerce\",\n    \"billing_address\": {\n        \"attention\": \"$fullname\",\n        \"address\": \"$billing_address\",\n        \"street2\": \"$billing_address2\",\n        \"city\": \"$billing_city\",\n        \"state\": \"$billing_state\",\n        \"zip\": $billing_postcode,\n        \"country\": \"$billing_country\",\n        \n        \"phone\": \"$phone1\"\n    },\n    \"contact_persons\": [\n        {\n           \n            \"first_name\": \"$firstname12\",\n            \"last_name\": \"$lastname12\",\n            \"email\": \"$email12\",\n            \"phone\": \"$phone1\",\n            \n           \n            \"is_primary_contact\": true,\n            \"enable_portal\": false\n        }\n    ]\n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
//echo $response;





curl_close($curl);
 
 $ratul133= (json_decode($response, true));
 $contact_id= $ratul133["contact"]["contact_id"];   
        
}

    
 //echo "contact id:".$contact_id;   
   // echo "<br>";
////////create customer in ZOHOBOOKS
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    //new and proper way 
    
    
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://".$siteurlwoo."/wp-json/wc/v2/orders/".$order_id."?consumer_key=".$consumerkey."&consumer_secret=".$consumersecret,
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


$ratul1330= (json_decode($response, true));
 $tax_rate_id= $ratul1330["tax_lines"][0]["rate_id"];
    
$date=date("Y-m-d");
     
    
    
    
    
    
    //get percentage
    
    
    
     $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://".$siteurlwoo."/wp-json/wc/v2/taxes/".$tax_rate_id."?consumer_key=".$consumerkey."&consumer_secret=".$consumersecret,
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

  //echo $response;
    
    
$ratul933= (json_decode($response, true));
 $tax_rate_percentage= $ratul933["rate"];   
    
  
    
$taxpercentageinwoo= number_format((float)$tax_rate_percentage, 3, '.', ''); 
    
 // echo "tax :".$taxpercentageinwoo;   
  //  echo "<br>";
    
    
    
    
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."settings/taxes?organization_id=".$woobookcpid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 57b360c3-9bda-7886-6520-8b8a02de4b0f"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$ratul933= (json_decode($response, true));
$count= count($ratul933["taxes"]);  
//echo $count;
    
 
    
    
    
    
    
    
   if($total_tax1 == 0) {
     
  $taxid=  $taxref;

    
     
     
 } 
    
    
if($total_tax1 > 0) {
     

for($x=0;$x<$count;$x++){
$taxinzoho= $ratul933["taxes"][$x]["tax_percentage"]; 

//echo $rateename; echo "<br>";
    
$taxrateinqbo3dec= number_format((float)$taxinzoho, 3, '.', '');



//echo $taxrateinqbo3dec;


    
if($taxrateinqbo3dec==$taxpercentageinwoo){

   
$taxid= $ratul933["taxes"][$x]["tax_id"];
    
 
    
    
   break; 
    
    
}

 




} 
    
}
    
    
    
    
    
    
    

    
    $x=0;
  foreach ( $order->get_items() as $item_key => $item ) {
    $product = $order->get_product_from_item( $item );
   
    $protitle = $product->get_title();
 
     

if (strpos($protitle, ' ') !== false) {
 $protitle= str_replace(' ', '%20', $protitle);
}
      
  //get zoho product id    
      
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."items?organization_id=".$woobookcpid."&name_contains=".$protitle,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
  ),
));

$response0 = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);




 $result7= (json_decode($response0, true));    
$aproductid=  $result7["items"][0]["item_id"];     
$productid[$x] = $aproductid; 
      $x=$x+1;
}  
    
    

    
    
    
    
       
       
       
       
       
       
       
       
       
       
       
       
       
       
    
    

 

    
       
       
       
       
       
$items = $order->get_items();
    $x=0;
    $qtuarr = array(); 
    $totalarr =  array();
    $unitpricearr= array();
      if($shipping_cost>0){
       $postfieldsinvoice = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n    \"date\": \"$date\",\n \"template_id\": $invoice,\n\n   \"line_items\": [ \n                {\n                   \n                    \"item_id\": $shipping_product_id,\n\n                 \"item_order\": 1,\n                    \"rate\": $shipping_cost,\n                    \"quantity\": 1,\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";
       
       
       
    $postfieldsestimate = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $estimate,\n\n   \"line_items\": [ \n                {\n                   \n                    \"item_id\": $shipping_product_id,\n\n                 \"item_order\": 1,\n                    \"rate\": $shipping_cost,\n                    \"quantity\": 1,\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                }, ";
       
       $postfieldssalesorder = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $salesorder,\n\n   \"line_items\": [ \n                {\n                   \n                    \"item_id\": $shipping_product_id,\n\n                 \"item_order\": 1,\n                    \"rate\": $shipping_cost,\n                    \"quantity\": 1,\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";
       
       
        $postfieldscredit = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $payment,\n\n   \"line_items\": [ \n                {\n                   \n                    \"item_id\": $shipping_product_id,\n\n                 \"item_order\": 1,\n                    \"rate\": $shipping_cost,\n                    \"quantity\": 1,\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";
        
    }
    
    
    
      if($shipping_cost==0){
    
    $postfieldsinvoice = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n    \"date\": \"$date\",\n \"template_id\": $invoice,\n\n   \"line_items\": [";
       
       
       
    $postfieldsestimate = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $estimate,\n\n   \"line_items\": [";
       
       $postfieldssalesorder = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $salesorder,\n\n   \"line_items\": [";
       
       
        $postfieldscredit = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"JSONString\"\r\n\r\n{\n    \"customer_id\": $contact_id,\n \"template_id\": $payment,\n\n   \"line_items\": [";
    
    
      }
    
    
    
    
       
foreach ( $items as $item ) {
   
    $product_name = $item['name'];
    $product_id = $item['product_id'];
    $product_variation_id = $item['variation_id'];
 $product_qty = $item['qty'];
  $total_with_or_without_discount= $item['total'];
 $item_unit_price=$total_with_or_without_discount/$product_qty;
    
$qtuarr[$x]= $product_qty;
$totalarr[$x]= $total_with_or_without_discount;
$unitpricearr[$x]= $item_unit_price;

  $postfieldsinvoice=   $postfieldsinvoice."\n                {\n                   \n                    \"item_id\": $productid[$x],\n\n                 \"item_order\": 1,\n                    \"rate\": $unitpricearr[$x],\n                    \"quantity\": $qtuarr[$x],\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";  
    
    
    
     $postfieldsestimate=   $postfieldsestimate."\n                {\n                   \n                    \"item_id\": $productid[$x],\n\n                 \"item_order\": 1,\n                    \"rate\": $unitpricearr[$x],\n                    \"quantity\": $qtuarr[$x],\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";  
    
    
    
     $postfieldssalesorder=   $postfieldssalesorder."\n                {\n                   \n                    \"item_id\": $productid[$x],\n\n                 \"item_order\": 1,\n                    \"rate\": $unitpricearr[$x],\n                    \"quantity\": $qtuarr[$x],\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";  
    
    
    
        $postfieldscredit=   $postfieldscredit."\n                {\n                   \n                    \"item_id\": $productid[$x],\n\n                 \"item_order\": 1,\n                    \"rate\": $unitpricearr[$x],\n                    \"quantity\": $qtuarr[$x],\n                    \"account_id\": $accountid,\n                    \"discount_amount\": 0,\n                    \"discount\": 0,\n                    \"tax_id\": $taxid,\n\n                },";  
    
    
    
    
    
$x=$x+1;
}

 $a = rtrim($postfieldsinvoice,',');
       
 $postfieldsinvoice= $a."\n            ],\n\"shipping_charge\": 0  \n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
    
 //echo "taxid : ".$taxid;  
//echo "shipping cost: ".$shipping_cost;
    

       
       
  $b = rtrim($postfieldsestimate,',');
       
 $postfieldsestimate= $b."\n            ],\n\"shipping_charge\": 0  \n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
    
       
       
       
       
       
       
   $c = rtrim($postfieldssalesorder,',');
       
 $postfieldssalesorder= $c."\n            ],\n\"shipping_charge\": 0  \n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
        
       
       
       
     $d = rtrim($postfieldscredit,',');
       
 $postfieldscredit= $d."\n            ],\n\"shipping_charge\": 0  \n}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
             
       
       
       
       
       
       
       
    
    
    
    
$woobookcreateinvoice= 1;  
    
  if($woobookcreateinvoice==1) {
      
      
      
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."invoices?organization_id=".$woobookcpid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => $postfieldsinvoice,
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Zoho-authtoken $authcode",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: fb7bf7d8-e6d4-4b29-8bba-2f9beecd3cb8"
  ),
));

$response9 = curl_exec($curl);
          //echo "invoice :".$postfieldsinvoice; 
//echo "<br>";echo "<br>";
$err = curl_error($curl);

curl_close($curl);


  //echo $response9;
 
     
      
    

      
      
   $ratul9006= (json_decode($response9, true));                    
$srcpt=  $ratul9006["code"];      
  //echo $response9;
  
           if($srcpt==0){
   $noticecount = $noticecount + 1;
   $noticetext = $noticetext."Order Id: ".$order_id." Successfull.. <br>";
   $columnvalue= "Exported as Inv.";
        update_post_meta( $order_id, 'woobookstatus', sanitize_text_field( $columnvalue ) );
           }
           
     else  {
         
       $noticetext = $noticetext."Order Id: ".$order_id." Failed.. <br>";
      $columnvalue= "Failed To Export as Inv.";
        update_post_meta( $order_id, 'woobookstatus', sanitize_text_field( $columnvalue ) );
         update_post_meta( $order_id, 'woobookerror', sanitize_text_field(  $response9 ) ); 
         
     }       
  
  
  
  
  
  
  
  
  
//end of create invoice  
      
  }
       

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
    
    
      $location = add_query_arg( array(
    		'post_type' => 'shop_order',
		'marked_awaiting_shipment2' => 1, // markED_awaiting_shipment=1 is just the $_GET variable for notices
		'changed' => count( $_REQUEST['post'] ), // number of changed orders
		'ids' => join( $_REQUEST['post'], ',' ),
		'post_status' => 'all'
	), 'edit.php' );
 
	wp_redirect( admin_url( $location ) );
	exit;
 
/*
 * Notices
 */
    
}