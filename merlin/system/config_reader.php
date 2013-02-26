<?php
namespace merlin\config;

function set_config_file($fn){
    $GLOBALS["base_config_file"] = $fn;
    \merlin\logger\log("in set file name: " . $GLOBALS["base_config_file"]);
}

function get_config_item($key){
    \merlin\logger\log("in get_config_item file name: " . $GLOBALS["base_config_file"]);
    require_once($GLOBALS["base_config_file"]);
    return $config[$key];
}