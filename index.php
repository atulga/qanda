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

if ($uri_filtered == '/qanda/' ||
    $uri_filtered == '/qanda/index.php'){
    redirect('/qanda/index.php/');
}

function redirect($uri){
    header('Location: '.$uri);
    exit();
}

if (uri_is('/qanda/index.php/')){
    question_list();
} elseif (uri_is('/qanda/index.php/show') && has_get('question_id')){
    question_show(get_param('question_id'));
} elseif (uri_is('/qanda/index.php/question_add')){
    question_add();
} elseif (uri_is('/qanda/index.php/answer_add')){
    answer_add();
} elseif (uri_is('/qanda/index.php/question_edit') && has_get('question_id')){
    // TODO change the URL to /qanda/index.php/save_question
    question_edit(get_param('question_id'));
} elseif ($uri_filtered =='/qanda/index.php/index.php' &&
          has_post('answer_id_delete')){
    delete_answer_action(post_param('answer_id_delete'));
} else {
    header('Status:404 Not Found');
    echo '<html><body><h2>File Not Found!</h2></body></html>';
}
?>
