<?php
namespace merlin\urls;

$global_routes = array();
        
function add_routes($route) {

}

function load_url_map() {
    \merlin\logger\log("loading url maps");
    \merlin\logger\log(\merlin\config\get_config_item("base_url_file"));
}