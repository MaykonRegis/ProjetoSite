<?php

    use Facebook\Exceptions\FacebookResponseException;

    session_start();
    include('config.php');
    require_once 'App/Core/core.php';
    require_once 'vendor/autoload.php';
    require_once 'App/Database/conexao.php';

    require_once 'App/Controller/HomeController.php';
    require_once 'App/Controller/CadastroController.php';
    require_once 'App/Controller/SobreController.php';
    require_once 'App/Controller/ContatoController.php';
    require_once 'App/Controller/LoginController.php';
    require_once 'App/Controller/DashboardController.php';

    require_once 'App/Model/usuario.php';
    
    $core = new Core;
    echo $core->start($_GET);

    /*CONEXAO FACEBBOK */
    
    if(isset($accessToken)){

        if(isset($_SESSION['facebook-access_token'])){
            $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }else {
            $_SESSION['facebook_access_token'] = (string)$accessToken;
            $oAuth2Client = $fb->getOAuth2Client();
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
            $_SESSION['facebook_access_token'] = (string)$longLivedAccessToken;
            $gb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }if(isset($__GET['code'])){
            header('Location: ./');
        }

        try{
            $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
            $fbUserProfile = $profileRequest->getGraphNode()->asArray();
        }catch(FacebookResponseException $e){}
        
        $fbUserData = [
            'oauth_provider' => 'facebook',
            'oauth_uid' => $fbUserProfile['id'],
            'first_name' => $fbUserProfile['first_name'],
            'last_name' => $fbUserProfile['last_name'],
            'email' => $fbUserProfile['email'],
           'imagem' => $fbUserProfile['picture']['url']
        ];

        $userDATA = $fbUserData;

        $_SESSION['userData'] = $fbUserData;

        $logoutUrl = $helper->getLogoutUrl($accessToken, $redirectUrl. 'logout.php');

        if(!empty($userData)){
            $output = '';
            $output.="<h1>Nome: $userData[first_name]</h1>";
            $output.="<h1>Sobrenome: $userData[last_name]</h1>";
            $output.="<h1>Email: $userData[email]</h1>";
            $output.='<br/><img src="'.$userData['imagem'].'"/>';
            $output.='<br/> <a href="'.$logoutUrl.'">Logout</a>';
        }else {
            $output = '<h1 style="color:red">Ocorreu um erro</h1>';
        }

    }else{
        $loginUrl = $helper->getLoginUrl($redirectUrl, $fbPermission);
        $output = '<a href="'.$loginUrl.'">Fazer Login com facebook</a>';
    }

    echo $output;

?>