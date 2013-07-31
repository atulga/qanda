<?php
function question_list_action()
{
    $questions=show_all_question();
    require 'templates/list.php';
}

function question_show_action($question_id)
{
    $question=show_question_by_id($question_id);
    $answers=get_answers_by_question($question_id);
    require 'templates/show.php';
}

function question_add_action()
{
    if(post_param('question') != NULL){
        add_question(
            post_param('questioner'),
            post_param('question_title'),
            post_param('question')
    );
    }
    redirect('/qanda/index.php');
}

function insert_question_action()
{
    require 'templates/ask_question.php';
}

function question_edit_action($question_id)
{
    $question=get_question_by_id($question_id);
    require 'templates/edit.php';
}

function question_update_action()
{
    question_update(
        post_param('title'),
        post_param('question'),
        post_param('question_id')
    );
    redirect('show?question_id='.post_param('question_id'));
}

function answer_add_action()
{
    if(post_param('answer') != NULL){
    add_answer(
        post_param('name'),
        post_param('answer'),
        post_param('question_id')
    );}
    redirect('show?question_id='.post_param('question_id'));
}

function delete_answer_action()
{
    delete_answer(get_param('answer_id'));
    redirect('show?question_id='.get_param('question_id'));
}

function set_best_answer_action()
{
    set_best_answer(get_param('question_id'), get_param('answer_id'));
    redirect('show?question_id='.get_param('question_id'));
}

function delete_question_action()
{
    $param=get_param('question_id');
    delete_question($param);
    delete_answers($param);
    redirect('/qanda/index.php');
}

?>
