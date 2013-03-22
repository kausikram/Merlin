<?php
namespace merlin\validators;

function required(&$req, $key){
    $method = strtolower($req->method());
    if (is_null($req->$method($key))){
        return "$key is required";
    }
    if ($req->$method($key) == ""){
        return "$key is required";
    }
}


function integer_field(&$req, $key){
    $method = strtolower($req->method());
    if (!is_int($req->$method($key))){
        return "$key should be an integer";
    }

}