<?php
session_start();
require_once( 'src/Facebook/autoload.php' );

$fb = new Facebook\Facebook([
    'app_id' => '126341198088946',
    'app_secret' => '03c830f9afe2306b11c44188da29b8d9',
    'default_graph_version' => 'v2.10',
    'default_access_token' => 'EAABy6Bo7ivIBAMr9G4FQq8ouTjBwygZBZAjZA1GsNU8BNBgRk0P2Hm2ZBhHxMlj9dZAhkTWEajbVsNQloq9SZAm4bngGfgvLfKIhzdmHV4J9sKWV8Fo58s6GLkgnHK5ZBlNMj46xmCcdE7z7ZAMcDwlI2nIdzKLeI3cSZBcjeGMwCljjoyii2sdcVNwqrfZBcm0j6UrBuxywwsqgZDZD', // optional
]);

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];


$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('http://127.0.0.1/ninjas_for_hire/app.php', $permissions);
header("location: ".$loginUrl);

