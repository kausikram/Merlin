<?php
namespace merlin\middlewares\validation_middleware;

function process_request(&$req){
    \merlin\logger\log(" in merlin\\middlewares\\validation_middleware\\process_request");
    $validation_function = (string)$req->urlconfig("validation");
    \merlin\logger\log(" The validation function to be used is " . $validation_function);
    if(!$validation_function){
        return;
    }
    $validation_rules_for_all_methods = $validation_function();
    if ($validation_rules_for_all_methods[$req->method()]){
        $validation_rules = $validation_rules_for_all_methods[$req->method()];
        foreach($validation_rules as $key=>$rules){
            $errors= array();
            foreach($rules as $rule){
                $rule_fn = (string) $rule;
                \merlin\logger\log("Validating rule $rule_fn for $key");
                $error = $rule_fn($req, $key);
                if(!is_null($error)){
                    $errors[] = $error;
                }
            }
            \merlin\logger\log("Errors for $key :" . var_export($errors, true));
            if(count($errors)){
                $req->set_error($key, $errors);
            }
        }
    }
}