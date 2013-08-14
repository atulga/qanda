<?php

function question_list_action()
{
    $questions = Question::getQuestions();
    require 'templates/list.php';
}

function question_show_action($question_id)
{
    $question = Question::getById($question_id);

    $form_answer = new AnswerForm();
    if ($_POST){
        $form_answer->populate($_POST);
        $has_errors = $form_answer->validate();
        if (!$has_errors){
            $form_answer->save();
            $_SESSION['name'] = $form_answer->getName();
            redirect('show?question_id='.$form_answer->getQuestion_id());
        }
    }
    require 'templates/show.php';
}

function question_action($question_id = null)
{
    $form = new QuestionForm();
    if ($_POST){
    $form->populate($_POST);
    $has_errors = $form->validate();
    if (!$has_errors){
        $form->save();
        if($question_id == null){
            $_SESSION['name'] = $form->getName();
            redirect('/qanda/index.php');
        } else {
            redirect('show?question_id='.$form->getId());
        }
    }
    } else {
        if(!($question_id == null)){
            $question = Question::getById($question_id);
            $form->populate($question->toArray());
        }
    }
    if($question_id == null) require 'templates/ask_question.php';
        else require 'templates/edit.php';
}

function delete_answer_action()
{
    $answer = new Answer();
    $answer->setId($_GET['answer_id']);
    $answer->delete();
    redirect('show?question_id='.$_GET['question_id']);
}

function set_best_answer_action()
{
    $answer = new Answer();
    $answer->best($_GET['question_id'],$_GET['answer_id']);
    redirect('show?question_id='.get_param('question_id'));
}

function delete_question_action()
{
    $question = new Question();
    $question->setId($_GET['question_id']);
    $question->delete();
    redirect('/qanda/index.php');
}
?>
