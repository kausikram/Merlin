<?php

namespace merlin\input;

class Request {
    protected $gets = array();
    protected $posts = array();
    protected $servers = array();
    protected $sessions = array();
    protected $route_configs = array();
    protected $errors = array();
    protected $params = array();

    function construct_request(){
        $this->posts = $_POST;
        $this->gets = $_GET;
        $this->servers = $_SERVER;
        unset($_GET);
        unset($_POST);
        unset($_SERVER);
    }

    function get($param) {
        if(isset($this->gets[$param])){
            return $this->gets[$param];
        }
        return null;
    }

    function post($param) {
        if(isset($this->posts[$param])){
            return $this->posts[$param];
        }
        return null;
    }

    function all_posts(){
        return $this->posts;
    }

    function server($param) {
        if(isset($this->servers[$param])){
            return $this->servers[$param];
        }
        return null;
    }

    function set_error($k, $v){
        $this->errors[$k] = $v;
    }
    function error($param) {
        if(isset($this->errors[$param])){
            return $this->errors[$param];
        }
        return null;
    }

    function all_errors() {
        return $this->errors;
    }

    function has_errors() {
        if(count($this->errors) > 0){
            return true;
        }
        return false;
    }

    function param($param) {
        if(isset($this->params[$param])){
            return $this->params[$param];
        }
        return null;
    }

    function urlconfig($param){
        if(isset($this->route_configs[$param])){
            return $this->route_configs[$param];
        }
        return null;                            
    }

    function set_url_params($map) {
        $this->params = $map;
    }

    function get_url_segment(){
        return $this->server("PATH_INFO");
    }

    function set_url_configs($config_array){
        $this->route_configs = $config_array;
    }

    function requires_authentication(){
        return isset($this->route_configs["secure"]);
    }

    function method(){
        return $this->server("REQUEST_METHOD");
    }

}

function generate_request() {
    \merlin\logger\log("In merlin\\input\\generate_request");
    $req = new Request();
    $req->construct_request();
    return $req;
}