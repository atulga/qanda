<?php

require_once 'model.php';
require_once 'controllers.php';

$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '?')){
    $uri_filtered = strstr($uri, '?', true);
}else{
    $uri_filtered = $uri;
}

function has_get($param_name){
    return isset($_GET[$param_name]);
}

function has_post($param_name){
    return isset($_POST[$param_name]);
}

function get_param($name){
    return $_GET[$name];
}

function post_param($name){
    return $_POST[$name];
}

function uri_is($u){
    global $uri_filtered;
    return $u == $uri_filtered;
}

if (uri_is('/qanda/index.php') || uri_is('/qanda/')){
    list_action();

} elseif (uri_is('/qanda/index.php/show') && has_get('id')){  
    show_action(get_param('id');

} elseif (uri_is('/qanda/index.php') && has_post('Name')){
    ask_action(post_param('Name'), post_param('title'), post_param('question'));
    
} elseif (uri_is('/qanda/index.php/index.php') && has_post('answername')){
    answer_action(post_param('answername'), post_param('answer'), post_param('questionid'));
}

else {

    header('Status:404 Not Found');
    echo '<html><body><h2>File Not Found!</h2></body></html>';

}

?>



