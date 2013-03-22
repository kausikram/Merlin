<?php

namespace merlin\middlewares;

require(__DIR__."/basic_auth_middleware.php");
require(__DIR__."/validation.php");
function load_middlewares(&$req){
    \merlin\logger\log("loading all middlewares");
    foreach(\merlin\config\get_config_item("middlewares") as $middleware){
        $processor = $middleware . "\\process_request";
        $processor($req);
    }
    \merlin\logger\log("loaded all middlewares");
}