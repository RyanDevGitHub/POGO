<?php 

// Product Details 
$itemNumber = "DP12345"; 
$itemName = "Demo Product";  
$currency = "EUR"; 

/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */ 
define('PAYPAL_SANDBOX', FALSE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'client id'); 
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'secret id'); 
define('PAYPAL_PROD_CLIENT_ID', 'client id'); 
define('PAYPAL_PROD_CLIENT_SECRET', 'secret id'); 

define('DB_HOST', 'localhost');  
define('DB_USERNAME', 'root');  
define('DB_PASSWORD', '');  
define('DB_NAME', 'projet_pi_pogo'); 

?>