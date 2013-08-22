<?php

function logid_in()
{
    return isset($_SESSION['id']);
}

function has_get($param_name)
{
    return isset($_GET[$param_name]);
}

function has_post($param_name)
{
    return isset($_POST[$param_name]);
}

function get_param($name)
{
    return $_GET[$name];
}

function post_param($name)
{
    return $_POST[$name];
}

function uri_is($u)
{
    global $uri_filtered;
    $u = '/qanda/index.php'.$u;
    return $u == $uri_filtered;
}

function redirect($uri)
{
    header('Location:'.$uri);
    exit();
}

function camelcase($str)
{
    $str = strtolower($str);
    $str = preg_replace('/[^a-z]+/', ' ', $str);
    $str = ucwords($str);
    $str = preg_replace('/ /', '', $str);
    return $str;
}
?>
