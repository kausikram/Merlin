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
    $str = $req->$method($key) + 0; #adding 0 to convert a string to int quick and dirty
    if (!is_int($str)){
        return "$key should be an integer";
    }
}