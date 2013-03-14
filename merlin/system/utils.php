<?php
namespace merlin\utils;

function redirect($url) {
    \header("Location:" . $url);
    exit();
}
