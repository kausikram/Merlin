<?php
namespace merlin\middlewares\basic_auth_middleware;

function _force_authenticate(){
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'This Url Requires Authentication';
    exit;
}

function process_request(&$req){
    \merlin\logger\log(" in merlin\\middlewares\\basic_auth_middleware\\process_request");
    $pairs = \merlin\config\get_config_item("basic_auth_pairs");
    if($req->requires_authentication()){
        \merlin\logger\log("BasicAuthMiddleware: url requires authentication");
        $auth_user = $req->server('PHP_AUTH_USER');
        if (!isset($auth_user)) {
            #auth creds not sent
            _force_authenticate();
        } else {
            \merlin\logger\log("BasicAuthMiddleware: user was set to: ".$auth_user);
            if(!isset($pairs[$auth_user])){
                #creds for user not present
                \merlin\logger\log("BasicAuthMiddleware: user not found");
                _force_authenticate();
            } else {
                \merlin\logger\log("BasicAuthMiddleware: processing password");
                #creds for user present
                $salted_password_hash = $pairs[$auth_user];
                $split_password = explode("-",$salted_password_hash);
                $salt = $split_password[0];
                $password_hash = $split_password[1];

                $hash_of_sent_creds = sha1($salt.$req->server("PHP_AUTH_PW"));
                if($password_hash!=$hash_of_sent_creds){
                    \merlin\logger\log("BasicAuthMiddleware: wrong password");
                    #creds are wrong
                    _force_authenticate();
                }
                \merlin\logger\log("BasicAuthMiddleware: password was correct let them go");
            }
        }
    }
}