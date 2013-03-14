<?php
namespace merlin\urls;

$GLOBALS["url_routes"] = array();
        
function add_route($path, $seg_config) {
    $GLOBALS["url_routes"][$path] =  $seg_config;
}

function load_url_map($url_module, $base_segment, $base_url_config_params) {
    \merlin\logger\log("loading url maps for NS: " . $url_module);
    $ns = $url_module."\\get_urls";
    foreach($ns() as $url_segment=>$segment_config){
        if(isset($segment_config["delegate"])){
            $updated_url_config = array_replace($base_url_config_params, $segment_config);
            load_url_map($segment_config["delegate"], $base_segment . $url_segment, $updated_url_config);
        }
        if(isset($segment_config["controller"])){
            add_route($base_segment . $url_segment, $segment_config);
        }
    }
}

function find_controller(&$req) {
    \merlin\logger\log("In merlins\\urls\\find_controller");
    \merlin\logger\log("THe URL pattern is : " . $req->get_url_segment());
    load_url_map(\merlin\config\get_config_item("base_url_namespace"), "", array());
    foreach($GLOBALS["url_routes"] as $route=>$route_config){
        $controller = $route_config["controller"];
        $pattern = "#" . $route . "#i";
        $matches = array();
        if(preg_match($pattern, $req->get_url_segment(), $matches)) {
            \merlin\logger\log("best match controller: " . $controller);
            $req->set_url_params($matches);
            $req->set_url_configs($route_config);
            return $controller;
        }
    }
    return "\\merlin\\generic\\controllers\\controller_404";
}


function get_url_by_name($name, $params){
    //TODO: get_url_by_name_should_replace_patterns
    \merlin\logger\log("in get url by name : " . $name . "with params: " . var_export($params, true));
    foreach($GLOBALS["url_routes"] as $k=>$v){
        if ((isset($v["name"])) && ($v["name"]==$name)){
            $url_str = \merlin\config\get_config_item("base_uri_component") . "/" . $k;

            return trim($url_str,"$");
        }
    }
    return null;
}