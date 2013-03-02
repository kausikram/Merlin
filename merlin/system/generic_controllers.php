<?php

namespace merlin\generic\controllers;

function controller_404($req) {
    \header("HTTP/1.1 404 Not Found");
    include(\merlin\config\get_config_item("404_page"));
}