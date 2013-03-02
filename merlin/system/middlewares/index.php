<?php

namespace merlin\middlewares;

require(__DIR__."/basic_auth_middleware.php");

function load_middlewares(&$req){
    foreach(\merlin\config\get_config_item("middlewares") as $middleware){
        $processor = $middleware . "\\process_request";
        $processor($req);
    }
    \merlin\logger\log("loading all middlewares");
}