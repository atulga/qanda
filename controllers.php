<?php
function question_list_action()
{
  $questions = show_all_question();
  require 'templates/list.php';
}

function question_show_action($question_id)
{
  $question = show_question_by_id($question_id);
  $answers = get_answers_by_question($question_id);
  $form_answer = new AnswerForm();
  if ($_POST){
    $form_answer->populate($_POST);
    $has_errors = $form_answer->validate();
    if (!$has_errors){
      $form_answer->save();
      $_SESSION['name'] = $form_answer->getName();
      redirect('show?question_id='.$form_answer->getId());
    }
  }
  require 'templates/show.php';
}

function question_add_action()
{
  $form = new QuestionForm();
  if ($_POST){
    $form->populate($_POST);
    $has_errors = $form->validate();
    if (!$has_errors){
      $form->save();
      $_SESSION['name'] = $form->getName();
      redirect('/qanda/index.php');
    }
  }
  require 'templates/ask_question.php';
}

function question_edit_action($question_id)
{
  $question = get_question_by_id($question_id);
  $form_edit = new QuestionForm();
  if ($_POST){
    $form_edit->populate($_POST);
    $has_errors = $form_edit->validate();
    if (!$has_errors){
      $form_edit->save();
      redirect('show?question_id='.$form_edit->getId());
    }
  } else {
    $form_edit->populate($question);

  }
  require 'templates/edit.php';
}
/*
function question_action($question_id = null)
{
  if(!($question_id = null))
  $question = get_question_by_id($question_id);
  
  $form = new QuestionForm();
  if ($_POST){
  $form->populate($_POST);
  $has_errors = $form->validate();
  if (!$has_errors){
    $form->save();
    if(!($question_id = null)){
    redirect('show?question_id='.$form->getId());
    } else {
    $_SESSION['name'] = $form->getName();
    redirect('/qanda/index.php');
    } 
  }
  } else {
    $form->populate($question);
  }
  if(!($question_id = null))require 'templates/edit.php';
  else require 'templates/ask_question.php';
}
 */

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
  $param = get_param('question_id');
  delete_question($param);
  delete_answers($param);
  redirect('/qanda/index.php');
}
?>
