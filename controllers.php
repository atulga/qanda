<?php 
function question_list()
{
    $questions = show_all_question();
    require 'templates/list.php';
}

function show_question($question_id)
{
    $question = show_question_by_id($question_id);
    $answers = get_answers_by_question($question_id);
    require 'templates/show.php';
}

function add_question()
{
    // TODO get the params in this function
    question_add(
        post_param('questioner'),
        post_param('question_title'),
        post_param('question')
    );
    header('Location: /qanda/index.php');
    exit();
}

function edit_question_action($question, $resulted, $questionid)
{
    edit_question($question, $resulted, $questionid);
    header('Location: /qanda/index.php'); 
    exit();
}

function add_answer()
{
    answer_add(
        post_param('name'),
        post_param('answer'),
        post_param('question_id')
    );
    header('Location: /qanda/index.php');
    exit();
}

function delete_answer_action($answer_id)
{
    delete_answer($answer_id);
    header('Location: /qanda/index.php');
    exit();
}
?>
