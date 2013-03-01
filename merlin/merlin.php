<?php

require("system/logger.php");
require("system/urls.php");
require("system/config_reader.php");
require("system/input_handler.php");
require("system/middlewares/index.php");


function start($config_file) {
    \merlin\config\set_config_file($config_file);
    $input_request = \merlin\input\generate_request();
    $controller = \merlin\urls\find_controller($input_request);
    \merlin\middlewares\load_middlewares($input_request);
    if( isset($controller)){
        return $controller($input_request);
    }
}