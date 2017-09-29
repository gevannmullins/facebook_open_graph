<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new Facebook\Facebook([
    'app_id' => '126341198088946',
    'app_secret' => '03c830f9afe2306b11c44188da29b8d9',
    'default_graph_version' => 'v2.10',
    'default_access_token' => 'EAABy6Bo7ivIBAJnkzZBUmDEelNNh2ZBkqNaHD2H3LGRwNZAvQG1IZClOy3iLZAwxHoiavt7oRJm5WycqMMvWrtoczNG5ZCkJT4o4tFB9VQpr7xORlGMZAXNHC1VLxQosuXxYABu08VZAMHb9zlZCejME6ppdCeaImKrXZBXGRd1QlNDlBM1D0j2GJPEhJKEXs3UvGLEcVGlNZCCewZDZD', // optional
]);

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];

//$permissions = ['email']; // optional
$permissions = ['email', 'user_birthday', 'user_location', 'user_likes', 'user_posts', 'user_photos', 'user_gender', 'user_hometown']; // optional


try {
    // Returns a `Facebook\FacebookResponse` object
//    $response = $fb->get('/me?fields=id,name,first_name,last_name,picture');
    if (isset($_SESSION['facebook_access_token'])) {
        $accessToken = $_SESSION['facebook_access_token'];
    } else {
        $accessToken = $helper->getAccessToken();
    }
    $response = $fb->get('/me?fields=id,name,first_name,last_name,picture,gender,email,location,hometown,birthday');
    $profile = $response->getGraphNode()->asArray();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$access_granted = 'no';
if (isset($accessToken)) {

    $access_granted = 'yes';

    if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string)$accessToken;

        // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();

        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

    }


    // redirect the user back to the same page if it has "code" GET variable
    if (isset($_GET['code'])) {
        header('Location: ./');
    }

    // getting basic info about user
    try {
        $profile_request = $fb->get('/me?fields=id,name,first_name,last_name,picture,email');
        $profile = $profile_request->getGraphNode()->asArray();
        $user_profile_request = $fb->get('/me');
        $user_profile = $user_profile_request->getGraphEdge();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        // redirecting user back to app login page
        header("Location: ./");
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }



} else {
    // replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
//    $loginUrl = $helper->getLoginUrl('http://localhost/ninjas_for_hire', $permissions);
//    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}


?>

<style>
    .facebook_vars {
        display: none;
        position: fixed;
        right: 10px;
        bottom: 10px;
        width: 280px;
        height: 280px;
        background-color: #8c8c8c;
        border: 1px solid #000;
        padding: 4px;
        color: #000;
        z-index: 9999999999;
        overflow: auto;
    }
</style>


<div class="facebook_vars">

    <?php

    $user = $response->getGraphUser();
    $user_id = $user->getId();
    $user_name = $user->getName();
    $user_firstname = $user->getFirstName();
    $user_lastname = $user->getLastName();
    $user_birthday = date('dS F Y', $user->getBirthday()->getTimestamp());
    $user_pic = 'https://graph.facebook.com/' . $user_id . '/picture?type=large';
    $user_gender = $user->getFieldNames();
    $user_location = $user->getLocation()->getName();
    $user_phone = $user->all();

    ?>

</div>
