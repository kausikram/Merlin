<?php
namespace merlin\middlewares\basic_auth_middleware;

function process_request(&$req){
    $username="admin";
    $password="admin";
    if($req->requires_authentication()){
        $auth_user = $req->server('PHP_AUTH_USER');
        if (!isset($auth_user)) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'This Url Requires Authentication';
            exit;
        } else {
            if(($auth_user==$username) && ($req->server('PHP_AUTH_PW')==$password)){
                return;
            } else {
                header('WWW-Authenticate: Basic realm="My Realm"');
                header('HTTP/1.0 401 Unauthorized');
                echo 'This Url Requires Authentication';
                exit;
            }
        }
    }
}