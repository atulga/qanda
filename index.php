<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'model.php';
require_once 'controllers.php';
require_once 'helpers.php';

$uri = $_SERVER['REQUEST_URI'];

if (strpos($uri, '?')){
    $uri_filtered = strstr($uri, '?', true);
} else {
    $uri_filtered = $uri;
}

if (uri_is('/qanda/') || uri_is('/qanda/index.php') && !has_post('questioner')){
    question_list();
} elseif (uri_is('/qanda/index.php/show') && has_get('id')){
    show_question(get_param('id'));
} elseif (uri_is('/qanda/index.php/question_add')){
    add_question();
} elseif (uri_is('/qanda/index.php/answer_add/answer_add')){
    add_answer();
} elseif ($uri_filtered == '/qanda/index.php/index.php' &&
          has_post('resulted') || has_post('question')){
    // TODO change the URL to /qanda/index.php/save_question
    edit_question_action(
        post_param('question'),
        post_param('resulted'),
        post_param('question_id')
    );
} elseif ($uri_filtered =='/qanda/index.php/index.php' &&
          has_post('answer_id_delete')){
    delete_answer_action(post_param('answer_id_delete'));
} else {
    header('Status:404 Not Found');
    echo '<html><body><h2>File Not Found!</h2></body></html>';
}
?>
