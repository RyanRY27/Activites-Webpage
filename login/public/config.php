<?php

//initialize facebook sdk
require 'fb/vendor/autoload.php';
session_start();
$fb = new Facebook\Facebook([
  'app_id' => '707216293685878',
  'app_secret' => 'ad7eb748758a5c8435cb5c593dc3e05f',
  'default_graph_version' => 'v2.5',

]);
$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional

try {
  if (isset($_SESSION['facebook_access_token'])) {
    $accessToken = $_SESSION['facebook_access_token'];
  } else {
    $accessToken = $helper->getAccessToken();
  }
} catch (Facebook\Exceptions\facebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

?>