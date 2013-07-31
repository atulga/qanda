<?php
function question_list()
{
    $questions = show_all_question();
    require 'templates/list.php';
}

function question_show($question_id)
{
    $question = show_question_by_id($question_id);
    $answers = get_answers_by_question($question_id);
    require 'templates/show.php';
}

function question_add()
{
    add_question(
        post_param('questioner'),
        post_param('question_title'),
        post_param('question')
    );
    header('Location: /qanda/index.php');
    exit();
}

function question_edit($question_id)
{
    show_edit_question_by_id($question_id);
    require 'templates/edit.<?php';
}

function answer_add()
{
    add_answer(
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
