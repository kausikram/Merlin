<?php

namespace merlin\input;

class Request {
    protected $blah = "blah";
    protected $gets = array();
    protected $posts = array();
    protected $servers = array();

    function construct_request(){
        $this->posts = $_POST;
        $this->gets = $_GET;
        $this->servers = $_SERVER;
        unset($_GET);
        unset($_POST);
        unset($_SERVER);
    }

    function get($param) {

    }

    function post($param) {

    }

    function file($param) {

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