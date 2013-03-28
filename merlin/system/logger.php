<?php

namespace merlin\logger;

function log($log_string) {
    //echo $log_string . "<br />";
    if(\merlin\config\get_config_item("enable_logging")){
        file_put_contents(\merlin\config\get_config_item("log_file"), $log_string."\n", FILE_APPEND);
    }
}