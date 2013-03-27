<?php

namespace merlin\generic\controllers;

function controller_404($req) {
    \header("HTTP/1.1 404 Not Found");
    include(\merlin\config\get_config_item("404_page"));
}

function direct_file_response($req) {
    foreach($req->urlconfig("additional_headers") as $header){
        header($header);
    }
    echo \file_get_contents($req->urlconfig("filename"));
}