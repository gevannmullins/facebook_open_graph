<?php

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
'app_id' => '126341198088946',
'app_secret' => '03c830f9afe2306b11c44188da29b8d9',
'default_graph_version' => 'v2.10',
'default_access_token' => '3dfa58406d334f91ddb827a44a265828', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', '3dfa58406d334f91ddb827a44a265828');
    //    $response = $fb->get('/me');
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}

$me = $response->getGraphUser();
echo 'Logged in as ' . $me->getName();