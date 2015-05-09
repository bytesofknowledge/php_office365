<?php

session_start();
require_once('office365/init.php');

/**
 * Enter your client id, secret key, thumbprint and redirect url below
 */
\Office365\Office365::setClientId('');
\Office365\Office365::setSecret('');
\Office365\Office365::setThumbprint('');
\Office365\Office365::setAuthorizationRedirectUrl('');

//sample pages
include('views/header.php');

switch($_SERVER['REQUEST_URI']) {

    case '/consent':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_token = $_POST['id_token'];
            //request access token using id_token provided from authorization response
            $access_token = new \Office365\AccessToken($id_token);
            $get_access_token = $access_token->retrieve();

            if ($get_access_token->access_token) {
                // save the access token to the session
                $_SESSION['access_token'] = $get_access_token->access_token;
                echo '<br>Access token acquired: ';
                echo $_SESSION['access_token'];
            } else {
                echo $get_access_token['error_description'];
            }     
        }

    break;

    case '/mail':

        include('views/form.php');

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $user = $_POST['email'];
            $access_token = $_SESSION['access_token'];

            $mail = new \Office365\Mail();
            $response = $mail->retrieve($user);

            if ( isset($response->value) ) {
                include('views/mail.php');
            } else {
                include('views/error.php');
            } 
        }

    break;

    case '/calendar':

        include('views/form.php');
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $user = $_POST['email'];
            $access_token =  $_SESSION['access_token'];

            $calendar = new \Office365\Calendar();
            $response = $calendar->retrieve($user);

            if ( isset($response->value) ) {
                include('views/calendar.php');  
            } else {
                include('views/error.php');
            }   
        }

    break;

}
