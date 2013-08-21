<?php
function logout()
{
    session_destroy();
    redirect('/qanda/index.php');
}

function login($question_id = null)
{
    $form = new LoginForm();
    if ($_POST){
        $form->populate($_POST);
        $has_errors = $form->validate();
        if (!$has_errors){
            $user = User::getUser($form->getName(), $form->getPassword());
            if ($user){
                if ($form->getName() == $user->getName()){
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['name'] = $user->getName();
                    $uri = $_SERVER['REQUEST_URI'];
                    if ($uri == '/qanda/index.php/login' || has_get('message')){
                        redirect('/qanda/index.php');
                    } elseif ($question_id > 0){
                        redirect('show?question_id='.$question_id);
                    } elseif ($uri == '/qanda/index.php/question_add'){
                        redirect('question_add');
                    }
                }
            }
        }
    }
    require 'templates/login.php';
}

function user_register()
{
    $form = new RegisterForm();
    if ($_POST){
        $form->populate($_POST);
        $has_errors = $form->validate();
        if (!$has_errors){
            if ($form->getPassword() == $form->getPasswordAgain()){
                    $form->save();
                    redirect('login?message=Та амжилттай бүртгэгдлээ. Өөрийн
                        эрхээрээ нэвтэрч орно уу');
            }
        }
    }
    require 'templates/register.php';
}

function question_list_action($page_number = 1)
{
    $questions = Question::getQuestions($page_number);
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
            redirect('show?question_id='.$form_answer->getQuestionId());
        }
    }
    require 'templates/show.php';
}

function question_add_edit_action($question_id = null)
{
    $form = new QuestionForm();
    if ($_POST){
        $form->populate($_POST);
        $has_errors = $form->validate();
        if (!$has_errors){
            $form->save();
            if($question_id == null){
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
    if($question_id == null)
        require 'templates/ask_question.php';
    else
        require 'templates/edit.php';
}

function delete_answer_action($answer_id)
{
    $answer = Answer::getById($answer_id);
    $question = Question::getById(get_param('question_id'));
    if($question->getBestAnswerId() == $answer_id){
        $question->setBestAnswerId('0');
    }
    $answer->delete();
    $question->updateAnswerCount();
    $question->save();
    redirect('show?question_id='.get_param('question_id'));
}

function set_best_answer_action($question_id)
{
    $question = Question::getById($question_id);
    $question->setBestAnswerId(get_param('answer_id'));
    $question->save();
    redirect('show?question_id='.$question_id);
}

function delete_question_action($question_id)
{
    $question = Question::getById($question_id);
    $question->delete();
    redirect('/qanda/index.php');
}

?>
