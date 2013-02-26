<?php

require("system/logger.php");
require("system/urls.php");
require("system/config_reader.php");
require("system/middlewares/index.php");


function start($config_file) {
    \merlin\config\set_config_file($config_file);
    \merlin\middlewares\load_middlewares();
    \merlin\urls\load_url_map();
}