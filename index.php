<?php

require_once 'helpers.php';
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '?')){
    $uri_filtered = strstr($uri, '?', true);
} else {
    $uri_filtered = $uri;
}
if (uri_is('/')){
    //question_list_action();
    require 'symfony2/web/app_dev.php';
    exit();
}

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'bootstrap.php';
require_once 'local_settings.php';
require_once 'controllers.php';
require_once 'forms.php';

if ($uri_filtered == '/qanda/' || $uri_filtered == '/qanda/index.php'){
    redirect('/qanda/index.php/');
}

if (uri_is('/list') && has_get('page') && has_get('message')){
    question_list_action(get_param('page'), get_param('message'));
} elseif (uri_is('/show') && has_get('question_id')){
    question_show_action(get_param('question_id'));
} elseif (uri_is('/logout')){
    user_logout_action();
} elseif (uri_is('/login')){
    if(has_get('question_id')){
        user_login_action(get_param('question_id'));
    } elseif(has_get('message')){
        user_login_action(get_param('message'));
    } else {
        user_login_action();
    }
} elseif (uri_is('/register')){
    user_register_action();
} elseif (uri_is('/question_add')){
    if(logged_in()){
        question_add_edit_action();
    } else {
        user_login_action();
    }
} elseif (uri_is('/question_edit') && has_get('question_id')){
    question_add_edit_action(get_param('question_id'));
} elseif (uri_is('/best_answer')){
    answer_set_best_action(get_param('question_id'));
} elseif (uri_is('/delete_question')){
    question_delete_action(get_param('question_id'));
} elseif (uri_is('/delete_answer')){
    answer_delete_action(get_param('answer_id'));
} else if (uri_is('/profile') ){
    user_profile_action(get_param('user_id'));
} else if (uri_is('/profile_edit')){
    user_profile_edit_action(logged_in());
}else {
    header('Status:404 Not Found');
    echo '<html><body><h2>File Not 123 Found!</h2></body></html>';
}

$em->flush();
?>
