<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}



//setting up menu options and woobook page
function add_theme_menu_item1()
{
   add_menu_page("Woobook", "Woobook", "manage_options", "Woobook", "woobooksetting_page", null, 99);

}



function woobooksetting_page()
{ 
    ?>
        <div class="wrap">
        <h1>Woobooks</h1> <br>
            
            <br>
            
            <br>
        <form method="post" action="options.php">
            <?php
                settings_fields("section");
                do_settings_sections("theme-options"); 
                submit_button();
    
    
    
    
    
            ?>   
            

        </form>
        </div>
<?php
    
  $urlcurl="https://books.zoho.com/api/v3/";
 $woobookcpid= get_option('woobookcompanyid'); 
   
 $woobookproductid= get_option('woobookproduct');   
  $authcode= get_option('woobookacno');

   
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
    






 
echo "<h2> Tax Ref Id List : <br> ----------------------- <br> </h2>";
for($xq=0;$xq<$count;$xq++){

$id= $ratul933['taxes'][$xq]['tax_id'];
$name= $ratul933['taxes'][$xq]['tax_name'];

echo "Name: ".$name." -------- "."id : ".$id;
echo "<br>";
}
    
 
    
    
    if(get_option('invoice')!="createinvoice"){
        
        ?>

<br> <br>
<form method="post" action="" >
<input value="Verify Purchase Code" type="submit" name='go2'/> <br>
    <p>Save the purchase code before clicking on this button</p>
</form> 
<?php
    }
    
    if(get_option('invoice')=="createinvoice"){
        
        ?>


<br> <br>
<form method="post" action="" >
<input value="Export all products from Woocommerce to ZohoBooks" type="submit" name='gotoqbo'/>
</form> 
 <br> <br>
   
<?php 
    
    }
    $cid=get_option('woobookacno');
    if(!empty($cid)){ ?>
    

  
<?php    
}
    }



if(get_option('invoice')!="createinvoice"){
function invoice()
{
   ?>
        <input type="text" name="invoice" id="invoice" value="<?php echo get_option('invoice'); ?>" />
 <br>

    <?php
}
}

if(get_option('invoice')=="createinvoice"){
function woobookacnofield()
{
    ?>

        <input type="text" name="woobookacno" id="woobookacno" value="<?php echo get_option('woobookacno'); ?>" />
<br>
<br>
<p><i>After login, you will need to  <a href="https://accounts.zoho.com/apiauthtoken/create?SCOPE=ZohoBooks/booksapi">go to this link</a>  to get your <b>Authorization Token</b> </i></p> <br>

<p><i> <a href="https://youtu.be/j0hBOZDQmq4">Check out this video</a>  to see how to get your organization id </i></p>  <br>
<p><i>  After you save the authorization code and organization id , at the bottom you can get your <b> ZERO RATE TAX ID </b></i></p>  You will need to create a Tax in zoho with 0% rate<br> <br>

    <?php
} 
}
if(get_option('invoice')=="createinvoice"){
function woobookapifield()
{

   ?>
        <input type="text" name="woobookapikey" id="woobookapikey" value="<?php echo get_option('woobookapikey'); ?>" />
 <br>

    <?php
}
}
 




if(get_option('invoice')=="createinvoice"){
function woobookcompanyid()
{
   ?>
        <input type="text" name="woobookcompanyid" id="woobookcompanyid" value="<?php echo get_option('woobookcompanyid'); ?>" />
 <br>

    <?php
    
    
    
}
}


if(get_option('invoice')=="createinvoice"){
function woobooktaxref()
{
    ?>
        <input type="text" name="woobooktaxref" id="woobooktaxref" value="<?php echo get_option('woobooktaxref'); ?>" />
<br>

    <?php
    
    
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $urlcurl."/v3/company/".$woobookcpid."/query?query=select%20*%20From%20TaxCode",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Bearer $woobookactkn",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);





 $result7= (json_decode($response, true)); 

 $count= count($result7['QueryResponse']['TaxCode']);  
 

for($xq=0;$xq<$count;$xq++){

$id= $result7['QueryResponse']['TaxCode'][$xq]['Id'];
$name= $result7['QueryResponse']['TaxCode'][$xq]['Name'];

echo "Name: ".$name." -------- "."id : ".$id;
echo "<br>";
}

    
    
    
} 

}



function wookey()
{
    ?>
        <input type="text" name="wookey" id="wookey" value="<?php echo get_option('wookey'); ?>" />
<br>
<p><i> <a href="https://youtu.be/QRg6c4m-xUs">Check out this video</a>  to see how to get your consumer key and consumer secret </i></p>
    <?php
} 


function woosecret()
{
    ?>
        <input type="text" name="woosecret" id="woosecret" value="<?php echo get_option('woosecret'); ?>" />
<br>

    <?php
} 




function woositeurl()
{
    ?>
        <input type="text" name="woositeurl" id="woositeurl" value="<?php echo get_option('woositeurl'); ?>" />
<br>
<p><i>(for example: abcd.com or www.abcd.com . do not use https before domain name)</i></p>
<br>
<br>


  <?php
echo "<br> <br> <h1> If order is placed successfully : <br> </h1>";
} 









   



function woobookcreateinvoice()
{
    
    ?>
       <input name="woobookcreateinvoice" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateinvoice' ) ); ?> />
<br>

    <?php
} 



function woobookcreateestimate()
{
    ?>
       <input name="woobookcreateestimate" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateestimate' ) ); ?> />
<br>

    <?php
} 


function woobookcreatesalesreceipt()
{
    ?>
       <input name="woobookcreatesalesreceipt" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatesalesreceipt' ) ); ?> />
<br>

    <?php
} 


function woobookcreatepayment()
{
    ?>
       <input name="woobookcreatepayment" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatepayment' ) ); ?> />
<br>

    <?php
    echo "<br> <br> <h1> If order status is Processing : <br> </h1>";
} 


//--------------------------------------------------------------------


function woobookcreateinvoicepro()
{
    ?>
       <input name="woobookcreateinvoicepro" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateinvoicepro' ) ); ?> />
<br>

    <?php
} 



function woobookcreateestimatepro()
{
    ?>
       <input name="woobookcreateestimatepro" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateestimatepro' ) ); ?> />
<br>

    <?php
} 



function woobookcreatesalesreceiptpro()
{
    ?>
       <input name="woobookcreatesalesreceiptpro" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatesalesreceiptpro' ) ); ?> />
<br>

    <?php
} 



function woobookcreatepaymentpro()
{
    ?>
       <input name="woobookcreatepaymentpro" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatepaymentpro' ) ); ?> />
<br>

    <?php
    
    
  echo "<br> <br> <h1> If order Status is Completed : <br> </h1>";
} 




//--------------------------------------------------------------------

function woobookcreateinvoicecom()
{
    ?>
       <input name="woobookcreateinvoicecom" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateinvoicecom' ) ); ?> />
<br>

    <?php
} 




function woobookcreateestimatecom()
{
    ?>
       <input name="woobookcreateestimatecom" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateestimatecom' ) ); ?> />
<br>

    <?php
} 


function woobookcreatesalesreceiptcom()
{
    ?>
       <input name="woobookcreatesalesreceiptcom" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatesalesreceiptcom' ) ); ?> />
<br>

    <?php
} 



function woobookcreatepaymentcom()
{
    ?>
       <input name="woobookcreatepaymentcom" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatepaymentcom' ) ); ?> />
<br>

    <?php
    
    echo "<br> <br> <h1> If Subscription Renewal Payment is Completed : <br> </h1>";
    
} 








//--------------------------------------------------------------------

function woobookcreateinvoicesorc()
{
    ?>
       <input name="woobookcreateinvoicesorc" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateinvoicesorc' ) ); ?> />
<br>

    <?php
} 



function woobookcreateestimatesorc()
{
    ?>
       <input name="woobookcreateestimatesorc" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreateestimatesorc' ) ); ?> />
<br>

    <?php
} 




function woobookcreatesalesreceiptsorc()
{
    ?>
       <input name="woobookcreatesalesreceiptsorc" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatesalesreceiptsorc' ) ); ?> />
<br>

    <?php
} 



function woobookcreatepaymentsorc()
{
    ?>
       <input name="woobookcreatepaymentsorc" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatepaymentsorc' ) ); ?> />
<br>

    <?php
    
    echo "<br> <br> <h1> If order is Refunded </b> </h1> ";
} 









//---------------------------------------------------------------------


function woobookcreatecreditmemo()
{
    ?>
       <input name="woobookcreatecreditmemo" type="checkbox" value="1" <?php checked( '1', get_option( 'woobookcreatecreditmemo' ) ); ?> />
<br>

    <?php
} 


function woobookrefundaccountid()
{
    ?>
       
 <input type="text" name="woobookrefundaccountid" id="woobookrefundaccountid" value="<?php echo get_option('woobookrefundaccountid'); ?>" />
<br>

    <?php
    
} 







function woobookintmp()
{

   ?>

        <input type="text" name="woobookintmp" id="woobookintmp" value="<?php echo get_option('woobookintmp'); ?>" />
 <br>

<p><i> <a href="https://youtu.be/j0hBOZDQmq4">Check out this video</a>  to see how to get your template id </i></p>
    <?php
}




function woobookestmp()
{
   ?>
        <input type="text" name="woobookestmp" id="woobookestmp" value="<?php echo get_option('woobookestmp'); ?>" />
 <br>

    <?php
}



function woobooksalestmp()
{
   ?>
        <input type="text" name="woobooksalestmp" id="woobooksalestmp" value="<?php echo get_option('woobooksalestmp'); ?>" />
 <br>

    <?php
}

function woobookpaymenttmp()
{
   ?>
        <input type="text" name="woobookpaymenttmp" id="woobookpaymenttmp" value="<?php echo get_option('woobookpaymenttmp'); ?>" />
 <br>

    <?php
}



function woobookshipping()
{
   ?>
        <input type="text" name="woobookshipping" id="woobookshipping" value="<?php echo get_option('woobookshipping'); ?>" />
 <br>
<p><i> <a href="https://www.youtube.com/watch?v=t0eh0S1MF74">Check out this video</a>  to see how to get shipping product id </i></p>
    <?php
}




function woobookeredittmp()
{
   ?>
        <input type="text" name="woobookeredittmp" id="woobookeredittmp" value="<?php echo get_option('woobookeredittmp'); ?>" />
 <br>

    <?php

}

function woobookexportproduct()
{
    ?>
       
 <input type="text" name="woobookexportproduct" id="woobookexportproduct" value="<?php echo get_option('woobookexportproduct'); ?>" />
<br>
<p><i> If you want to export 1st 100 products, then enter <b>1</b> in the field and then save it and then click on the button below <b>"Export All products from Woocommerce to Zohobooks"</b> . Again if you want to export products from 500-600, then enter <b>5</b> into the field. In this way you can export unlimited number of products from woocomerce to zohobooks. I seperated it by 100 products to decrease the server load. Because many time server can't handle all the products at once. For this , doing it for each  100 products is great for your server.   </i></p>
    <?php
    
} 


function display_theme_panel_fields1()
{ 
    add_settings_section("section", "All Settings", null, "theme-options");
    
   if(get_option('invoice')!="createinvoice"){
    
    add_settings_field("invoice", "Codecanyon Purchase Code", "invoice", "theme-options", "section");
    register_setting("section", "invoice");
   }
    
    if(get_option('invoice')=="createinvoice"){
    
 
    
    add_settings_field("woobookacno", "Authorization Token", "woobookacnofield", "theme-options", "section");
    
     add_settings_field("woobookcompanyid", "Organization Id", "woobookcompanyid", "theme-options", "section");
    
   add_settings_field("woobooktaxref", "Enter Zero Rate Tax Id", "woobooktaxref", "theme-options", "section");
   
    add_settings_field("wookey", "Woocommerce Consumer Key", "wookey", "theme-options", "section");
    add_settings_field("woosecret", "Woocommerce Consumer Secret", "woosecret", "theme-options", "section");
      add_settings_field("woositeurl", "Your Site Domain", "woositeurl", "theme-options", "section");   
    
   
        
        
        
    
    add_settings_field("woobookcreateinvoice", "Create Invoice", "woobookcreateinvoice", "theme-options", "section");

add_settings_field("woobookcreateestimate", "Create Estimate", "woobookcreateestimate", "theme-options", "section");

add_settings_field("woobookcreatesalesreceipt", "Create Sales Order", "woobookcreatesalesreceipt", "theme-options", "section");

add_settings_field("woobookcreatepayment", "Create a Payment", "woobookcreatepayment", "theme-options", "section");

    
    
     add_settings_field("woobookcreateinvoicepro", "Create Invoice", "woobookcreateinvoicepro", "theme-options", "section");

add_settings_field("woobookcreateestimatepro", "Create Estimate", "woobookcreateestimatepro", "theme-options", "section");

add_settings_field("woobookcreatesalesreceiptpro", "Create Sales Order", "woobookcreatesalesreceiptpro", "theme-options", "section");

add_settings_field("woobookcreatepaymentpro", "Create a Payment", "woobookcreatepaymentpro", "theme-options", "section");

    
    
     add_settings_field("woobookcreateinvoicecom", "Create Invoice", "woobookcreateinvoicecom", "theme-options", "section");

add_settings_field("woobookcreateestimatecom", "Create Estimate", "woobookcreateestimatecom", "theme-options", "section");

add_settings_field("woobookcreatesalesreceiptcom", "Create Sales Order", "woobookcreatesalesreceiptcom", "theme-options", "section");

add_settings_field("woobookcreatepaymentcom", "Create a Payment", "woobookcreatepaymentcom", "theme-options", "section");

    
    
     add_settings_field("woobookcreateinvoicesorc", "Create Invoice", "woobookcreateinvoicesorc", "theme-options", "section");
add_settings_field("woobookcreateestimatesorc", "Create Estimate", "woobookcreateestimatesorc", "theme-options", "section");
        
add_settings_field("woobookcreatesalesreceiptsorc", "Create Sales Order", "woobookcreatesalesreceiptsorc", "theme-options", "section");

add_settings_field("woobookcreatepaymentsorc", "Create a Payment", "woobookcreatepaymentsorc", "theme-options", "section");

    
    
    
 add_settings_field("woobookcreatecreditmemo", "Create Credit Notes", "woobookcreatecreditmemo", "theme-options", "section");   

add_settings_field("woobookrefundaccountid", "Enter Account id from where the refund will be made", "woobookrefundaccountid", "theme-options", "section");
add_settings_field("woobook_create_vendor", "", "woobook_create_vendor", "theme-options", "section");

    
 add_settings_field("woobookintmp", "Invoice Template Id", "woobookintmp", "theme-options", "section");
    
     add_settings_field("woobookestmp", "Estimate Template Id", "woobookestmp", "theme-options", "section");
    
   add_settings_field("woobooksalestmp", "Sales Order Template Id", "woobooksalestmp", "theme-options", "section");
      add_settings_field("woobookshipping", "Shipping Product ID", "woobookshipping", "theme-options", "section");
   

    add_settings_field("woobookpaymenttmp", "Credit Note Template Id", "woobookpaymenttmp", "theme-options", "section");
        

add_settings_field("woobookexportproduct", "Products that you want to export from woocommerce to quickbooks", "woobookexportproduct", "theme-options", "section");
        
        
            register_setting("section", "woobookacno");
    register_setting("section", "woobookapikey");
    
register_setting("section", "woobookcompanyid");
     register_setting("section", "wookey");
    register_setting("section", "woosecret"); 
    register_setting("section", "woositeurl");
    
    register_setting("section", "woobooktaxref");
  
    
    
    register_setting("section", "woositeurl");
 register_setting("section", "woobookcreateinvoice");

register_setting("section", "woobookcreateestimate");

register_setting("section", "woobookcreatesalesreceipt");

register_setting("section", "woobookcreatepayment");
    
 register_setting("section", "woobookcreateinvoicepro");

register_setting("section", "woobookcreateestimatepro");

register_setting("section", "woobookcreatesalesreceiptpro");

register_setting("section", "woobookcreatepaymentpro");
    
 register_setting("section", "woobookcreateinvoicecom");

register_setting("section", "woobookcreateestimatecom");

register_setting("section", "woobookcreatesalesreceiptcom");

register_setting("section", "woobookcreatepaymentcom");
    
 register_setting("section", "woobookcreateinvoicesorc");

register_setting("section", "woobookcreateestimatesorc");

register_setting("section", "woobookcreatesalesreceiptsorc");

register_setting("section", "woobookcreatepaymentsorc");
        
        

    
register_setting("section", "woobookcreatecreditmemo");

register_setting("section", "woobookrefundaccountid");

 

  register_setting("section", "woobookintmp");

register_setting("section", "woobookestmp");

register_setting("section", "woobooksalestmp");

register_setting("section", "woobookpaymenttmp");     
 register_setting("section", "woobookshipping");     
 
register_setting("section", "woobookexportproduct");
    }
    


 


} 

function add_my_custom_product_data_tab1( $product_data_tabs ) {
   $product_data_tabs['my-custom-tab'] = array(
        'label' => __( 'Woobook', 'my_text_domain' ),
        'target' => 'my_custom_product_data',
    );
    return $product_data_tabs;
}