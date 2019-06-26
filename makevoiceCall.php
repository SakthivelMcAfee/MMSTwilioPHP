<?php
/*
 * Creates an endpoint that can be used in your TwiML App as the Voice Request Url.
 *
 * In order to make an outgoing call using Twilio Voice SDK, you need to provide a
 * TwiML App SID in the Access Token. You can run your server, make it publicly
 * accessible and use `/makeCall` endpoint as the Voice Request Url in your TwiML App.
 */
include('./vendor/autoload.php');
include('./config.php');

function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
        
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
$requestBody = file_get_contents('php://input');
$requestBody = json_decode($requestBody) or die("Could not decode JSON");

$callerId = 'client:quick_start';
$to = isset($_POST["to"]) ? $_POST["to"] : "";
if (!isset($to) || empty($to)) {
  $to = isset($_GET["to"]) ? $_GET["to"] : "";
}
    
   // if (!isset($to) || empty($to)){
    $to = $DESTINATION_ID;
   // }
    $response->say('Welcome');

/*
 * Use a valid Twilio number by adding to your account via https://www.twilio.com/console/phone-numbers/verified
 */
$callerNumber = $CALLER_ID;

$response = new Twilio\Twiml();
if (!isset($to) || empty($to)) {
  $response->say('Congratulations! You have just made your first call! Good bye.');
} else if (is_numeric($to)) {
  $dial = $response->dial(
    array(
  	  'callerId' => $callerNumber
  	));
  $dial->number($to);
} else {
  $dial = $response->dial(
    array(
       'callerId' => $callerId
    ));
  $dial->client($to);
}

debug_to_console( "Test" );
debug_to_console( $requestBody );
print $response;
