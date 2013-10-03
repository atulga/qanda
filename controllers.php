<?php
function user_logout_action()
{
    session_destroy();
    redirect('/qanda/index.php');
}

function user_login_action($question_id = null)
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
                    $_SESSION['password'] = $user->getPassword();
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

function user_register_action()
{
    $form = new RegisterForm();
    if ($_POST){
        $form->populate($_POST);
        $has_errors = $form->validate();
        if (!$has_errors){
            if ($form->getPassword() == $form->getPasswordAgain()){
                    $form->save();
                    redirect('login?message=Та амжилттай бүртгэгдлээ, нэвтэрч орно уу');
            }
        }
    }
    require 'templates/register.php';
}

function question_list_action($page = 1)
{
    $pager = new Paginator();
    if($_GET){
        $pager->setCurrentPage(get_param('page'));
    }else{
        $pager->setCurrentPage(1);
    }
    $questions = Question::getQuestions($pager->getCurrentPage());

    require 'templates/list.php';
}

function question_show_action($question_id)
{
    global $em;
    $question = $em->find('Question', $question_id);

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
            $question_values = Question::getById($question_id, true);
            $form->populate($question_values);
        }
    }
    if($question_id == null)
        require 'templates/ask_question.php';
    else
        require 'templates/edit.php';
}

function answer_delete_action($answer_id)
{
    global $em;
    $answer = Answer::getById($answer_id);
    $question = Question::getById(get_param('question_id'));
    if($question->getBestAnswerId() == $answer_id){
        $question->setBestAnswerId('0');
    }
    $em->remove($answer);
    $em->flush();
    $num_answers = Answer::getCountByQuestionId($question->getId());
    $question->setAnswerCount($num_answers);
    $em->persist($question);
    $em->flush();
    redirect('show?question_id='.get_param('question_id'));
}

function answer_set_best_action($question_id)
{
    global $em;
    $question = Question::getById($question_id);
    $question->setBestAnswerId(get_param('answer_id'));
    $em->persist($question);
    $em->flush();
    redirect('show?question_id='.$question_id);
}

function question_delete_action($question_id)
{
    global $em;
    $question = Question::getById($question_id);
    Answer::deleteByQuestionId($question_id);
    $em->remove($question);
    $em->flush();
    redirect('/qanda/index.php');
}

function user_profile_action($id)
{
    $user = User::getById($id);
    $questions = Question::getLastFiveQuestionsByUserId($id);
    $question_count = Question::getQuestionCountByUserId($id);
    $answer_count = Answer::getAnswerCountByUserId($id);
    $answers = Answer::getLastFiveAnswersByUserId($id);
    $isme = $_SESSION['id'] == $id;
    require 'templates/profile.php';
}

function user_profile_edit_action()
{
    $user = User::getById($_SESSION['id']);
    $form = new ProfileForm();
    if ($_POST){
        $form->populate($_POST);
        $has_errors = $form->validate();
        if (!$has_errors){
            $form->save();
            redirect('profile?user_id='.$form->getId());
        }
     }else {
         $user_profile = array( 'nickname' => $user->getNickname(),
                        'description' => $user->getDescription(),
                        'id' => $user->getId());
        $form->populate($user_profile);
     }
    require 'templates/profile_edit.php';
}
?>
