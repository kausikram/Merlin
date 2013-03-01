<?php

namespace merlin\input;

class Request {
    protected $gets = array();
    protected $posts = array();
    protected $servers = array();
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
        return $this->gets[$param];
    }

    function post($param) {
        return $this->posts[$param];
    }

    function server($param) {
        return $this->servers[$param];
    }

    function param($param) {
        return $this->params[$param];
    }

    function set_url_params($map) {
        $this->params = $map;
    }

    function get_url_segment(){
        return $this->servers["PATH_INFO"];
    }
}

function generate_request() {
    \merlin\logger\log("In merlin\\input\\generate_request");
    $req = new Request();
    $req->construct_request();
    return $req;
}