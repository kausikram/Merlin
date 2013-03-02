<?php

namespace merlin\input;

class Request {
    protected $gets = array();
    protected $posts = array();
    protected $servers = array();
    protected $sessions = array();
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

    function server($param) {
        if(isset($this->servers[$param])){
            return $this->servers[$param];
        }
        return null;
    }

    function param($param) {
        if(isset($this->params[$param])){
            return $this->params[$param];
        }
        return null;
    }

    function set_url_params($map) {
        $this->params = $map;
    }

    function get_url_segment(){
        return $this->server("PATH_INFO");
    }
}

function generate_request() {
    \merlin\logger\log("In merlin\\input\\generate_request");
    $req = new Request();
    $req->construct_request();
    return $req;
}