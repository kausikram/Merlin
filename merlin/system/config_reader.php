<?php
namespace merlin\config;

function set_config_file($fn){
    $GLOBALS["base_config_file"] = $fn;
    \merlin\logger\log("in set file name: " . $GLOBALS["base_config_file"]);
}

function get_config_item($key){
    //\merlin\logger\log("in get_config_item for: " . $key);
    require($GLOBALS["base_config_file"]);
    if(isset($config[$key])){
        return $config[$key];
    }
    //\merlin\logger\log("returning value: " . var_export($value, true));
    return null;
}