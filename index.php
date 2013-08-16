<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'model.php';
require_once 'controllers.php';
require_once 'helpers.php';
require_once 'forms.php';

$uri=$_SERVER['REQUEST_URI'];

if (strpos($uri, '?')){
    $uri_filtered = strstr($uri, '?', true);
} else {
    $uri_filtered = $uri;
}

if ($uri_filtered == '/qanda/' || $uri_filtered == '/qanda/index.php'){
    redirect('/qanda/index.php/');
}

if (uri_is('/')){
    question_list_action();
} elseif (uri_is('/show') && has_get('question_id')){
    question_show_action(get_param('question_id'));
} elseif (uri_is('/question_add')){
    question_add_edit_action();
} elseif (uri_is('/question_edit') && has_get('question_id')){
    question_add_edit_action(get_param('question_id'));
} elseif (uri_is('/best_answer')){
    set_best_answer_action(get_param('question_id'));
} elseif (uri_is('/delete_question')){
    delete_question_action(get_param('question_id'));
} elseif (uri_is('/delete_answer')){
    delete_answer_action(get_param('answer_id'));
} else {
    header('Status:404 Not Found');
    echo '<html><body><h2>File Not Found!</h2></body></html>';
}

?>
