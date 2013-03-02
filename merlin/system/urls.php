<?php
namespace merlin\urls;

$GLOBALS["url_routes"] = array();
        
function add_route($path, $controller) {
    $GLOBALS["url_routes"][$path] =  $controller;
}

function load_url_map($url_module, $base_segment) {
    \merlin\logger\log("loading url maps for NS: " . $url_module);
    $ns = $url_module."\\get_urls";
    foreach($ns() as $url_segment=>$segment_config){
        if(isset($segment_config["delegate"])){
            load_url_map($segment_config["delegate"], $base_segment . $url_segment);
        }
        if(isset($segment_config["controller"])){
            add_route($base_segment . $url_segment, $segment_config["controller"]);
        }
    }
}

function find_controller(&$req) {
    \merlin\logger\log("In merlins\\urls\\find_controller");
    load_url_map(\merlin\config\get_config_item("base_url_namespace"), "");
    foreach($GLOBALS["url_routes"] as $route=>$controller){
        $pattern = "#" . $route . "#i";
        $matches = array();
        if(preg_match($pattern, $req->get_url_segment(), $matches)) {
            \merlin\logger\log("best match controller: " . $controller);
            $req->set_url_params($matches);
            return $controller;
        }
    }
    return "\\merlin\\generic\\controllers\\controller_404";
}