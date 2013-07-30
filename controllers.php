<?php 
function list_action()
{
    $posts = get_all_posts();
    require 'templates/list.php';
}

function show_action($id)
{
    $post = get_post_by_id($id);
    $answerpost = get_answer_all_post($id);
    require 'templates/show.php';
}

function ask_action($name, $title, $question)
{
    save_question($name, $title, $question);
    header('Location: /qanda/index.php');
    exit();
}

function edit_question_action($question, $resulted, $questionid){
    edit_question($question, $resulted, $questionid);
    header('Location: /qanda/index.php');    
}

function answer_action($answername, $answer, $questionid)
{
    save_answer($answername, $answer, $questionid);
    header('Location: /qanda/index.php');
    exit();
}

?>
