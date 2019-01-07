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

    echo " Account SID ".$ACCOUNT_SID."API KEY ".$API_KEY."API key secret ".$API_KEY_SECRET."Identity ".$identity."APP SID ".$APP_SID."push ".$PUSH_CREDENTIAL_SID
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
