<?php
session_start();
require_once( 'src/Facebook/autoload.php' );
require_once( 'storeData.php' );

$fb = new Facebook\Facebook([
    'app_id' => '126341198088946',
    'app_secret' => '03c830f9afe2306b11c44188da29b8d9',
    'default_graph_version' => 'v2.10',
    'default_access_token' => 'EAABy6Bo7ivIBAMr9G4FQq8ouTjBwygZBZAjZA1GsNU8BNBgRk0P2Hm2ZBhHxMlj9dZAhkTWEajbVsNQloq9SZAm4bngGfgvLfKIhzdmHV4J9sKWV8Fo58s6GLkgnHK5ZBlNMj46xmCcdE7z7ZAMcDwlI2nIdzKLeI3cSZBcjeGMwCljjoyii2sdcVNwqrfZBcm0j6UrBuxywwsqgZDZD', // optional
]);

$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
$_SESSION['FBRLH_state']=$_GET['state'];

//determine if the access token is set
try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error

    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues

    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


try {
    // Get the Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());
//    print_r($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'ERROR: Graph ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'ERROR: validation fails ' . $e->getMessage();
    exit;
}
$me = $response->getGraphUser();
//print_r($me);
//echo "Full Name: ".$me->getProperty('name')."<br>";
//echo "First Name: ".$me->getProperty('first_name')."<br>";
//echo "Last Name: ".$me->getProperty('last_name')."<br>";
//echo "Email: ".$me->getProperty('email')."<br>";
//echo "Facebook ID: <a href='https://www.facebook.com/".$me->getProperty('id')."' target='_blank'>".$me->getProperty('id')."</a>";

$db = new User();
$db->checkFBUserData($me);



