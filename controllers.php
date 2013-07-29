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
function ask_action($Name, $title, $question)
{
    set_new_question($Name, $title, $question);
    list_action();
}

function answer_action($answername, $answer, $questionid)
{
    save_answer($answername, $answer, $questionid);
    header('Location: /qanda/index.php');
    exit()
}

?>
