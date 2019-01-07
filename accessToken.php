<?php
/*
 * Creates an access token with VoiceGrant using your Twilio credentials.
 */
include('./vendor/autoload.php');
include('./config.php');
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;

// Use identity and room from query string if provided
    echo "Identity = ".$_GET["identity"];
    
$identity = isset($_GET["identity"]) ? $_GET["identity"] : NULL;
if (!isset($identity) || empty($identity)) {
  $identity = isset($_POST["identity"]) ? $_POST["identity"] : "alice";
}
    
    
    if (!isset($ACCOUNT_SID)) {
        echo "account ID not set";
    }else {
        echo "account ID  set";
    }
    
    if (!isset($API_KEY)) {
        echo "api key not set";

    }else {
        echo "api key  set";

    }
    
    if (!isset($API_KEY_SECRET)) {
        echo "api key secret not set";

    }else {
        echo "api key secret  set";

    }
    
    if (!isset($identity)) {
        echo "identity not set";

    }else {
        echo "identity set";

    }
    
    if (!isset($APP_SID)) {
        echo "app SID not set";

    }else {
        echo "app SID  set";

    }
    
    if (!isset($PUSH_CREDENTIAL_SID)) {
        echo "push SID not set";

    }else {
        echo "push SID set";

    }

//    echo $ACCOUNT_SID
//    echo $API_KEY
//    echo $API_KEY_SECRET
//    echo $identity
//    echo $APP_SID
//    echo $PUSH_CREDENTIAL_SID
    
// Create access token, which we will serialize and send to the client
$token = new AccessToken($ACCOUNT_SID, 
                         $API_KEY, 
                         $API_KEY_SECRET, 
                         3600, 
                         $identity
);

// Grant access to Video
$grant = new VoiceGrant();
$grant->setOutgoingApplicationSid($APP_SID);
$grant->setPushCredentialSid($PUSH_CREDENTIAL_SID);
$token->addGrant($grant);

echo $token->toJWT();
