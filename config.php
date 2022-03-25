<?php


include('Facebook/autoload.php');
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

$appId = '1811201272422004';
$appSecret = '1abefb5f3a9b34f176970610d4f34cec';
$redirectUrl = 'http://localhost/teste/';
$fbPermission = array('email');

$fb = new Facebook(array(
    'app_id'=> $appId,
    'app_secret'=> $appSecret,
    'default_graph_version' => 'v2.2' 
));

$helper = $fb->getRedirectLoginHelper();

try{
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else {
        $accessToken = $helper->getAccessToken();
    }
}catch(FacebookResponseException $e){}
?>
