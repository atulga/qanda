<?php

namespace Qanda\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Qanda\HomeBundle\Entity\Question;
use Qanda\HomeBundle\Entity\Answer;
use Qanda\HomeBundle\Entity\User;
use Qanda\HomeBundle\Form\Type\AnswerType;
use Qanda\HomeBundle\Form\Type\LoginType;
use Qanda\HomeBundle\Form\Type\QuestionType;
use Qanda\HomeBundle\Form\Type\RegisterType;
use Qanda\HomeBundle\Form\Type\UserType;
use Qanda\HomeBundle\Helpers\Paginator;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="question_list")
     * @Template()
     */
    public function indexAction()
    {
        $page = $this->getRequest()->query->get('page');
        $pager = new Paginator($this->getDoctrine(),
                            'QandaHomeBundle:Question', $page);
        $questions = $pager->fetch();
        return array('questions' => $questions, 'pager' => $pager);
    }

    /**
     * @Route("/logout", name="logout")
     * @Template()
     */
    public function logoutAction(Request $request)
    {
        $session = $this->getRequest()->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl('question_list'));
    }

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $form = $this->createForm(new LoginType(), new User());
        $form->handleRequest($request);
        if ($form->isValid()){
            $insert_value = $form->getData();
            $name = $insert_value->getName(); 
            $pass = $insert_value->getPassword(); 

            $filter = array('name' => $name, 'password' => $pass);
            $user = $this->getDoctrine()
                ->getRepository('QandaHomeBundle:User')
                ->findOneBy($filter);
            if($user){
                session_set('id', $user->getId());
                session_set('name', $user->getName());
                session_set('password', $user->getPassword());
                $uri = $_SERVER['REQUEST_URI'];
                if ($uri == '/qanda/index.php/login' || has_get('message')){
                    return $this->redirect(
                        $this->generateUrl('question_list'));
                } else {
                    return $this->redirect($request->headers->get('referer'));
                }
            }
        }

        return array('login_form' => $form->createView());
    }

    /**
     * @Route("/show", name="question_show")
     * @Template()
     */
    public function showAction(Request $request)
    {
        $question_id = $this->getRequest()->query->get('question_id');

        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($question_id);

        $order = array('createdDate' => 'ASC');
        $filter = array('questionId' => $question_id);

        $answers = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->findBy($filter, $order);

        $session_id = $request->getSession()->get('id');
        $form = $this->createForm(new AnswerType(), new Answer());

        $form->handleRequest($request);
        if ($form->isValid()){
            $answer = $form->getData();

            $filter = array('id' => $session_id);
            
            $user = $this->getDoctrine()
                ->getRepository('QandaHomeBundle:User')
                ->find($filter);

            $count_answers = count($answers) + 1;

            $em = $this->getDoctrine()->getManager();
            $answer->setCreatedDate(date_create(date('Y-m-d H:i:s')));
            $answer->setUser($user);
            $answer->setQuestionId($question->getID());

            $question->setAnswerCount($count_answers);

            $em->persist($question);
            $em->persist($answer);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));
        }

        return array(
            'question' => $question, 
            'answers' => $answers, 
            'answer_form' => $form->createView(),
        );
    }

    /**
     * @Route("/profile", name="profile")
     * @Template()
     */
    public function profileAction()
    {
        $user_id = $this->getRequest()->query->get('user_id');

        $user = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:User')
            ->find($user_id);
        $order = array('createdDate' => 'DESC');

        $filter = array('user' => $user);

        $answers = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->findBy($filter, $order, 5);
        $questions = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->findBy($filter, $order, 5);

        $answer_result = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->findBy($filter);
        $total_answer = count($answer_result);

        $question_result = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->findBy($filter);
        $total_question = count($question_result);

        return array(
            'user' => $user,
            'questions' => $questions,
            'answers' => $answers,
            'total_answer' => $total_answer,
            'total_question' => $total_question);
    }

    /**
     * @Route("/editProfile", name="edit_profile")
     * @Template()
     */
    public function editProfileAction(Request $request)
    {
        $user_id = $this->getRequest()->query->get('user_id');
        $filter = array('id' => $user_id);
        $user = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:User')
            ->find($filter);

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()){
            $form_user = $form ->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($form_user);
            $em->flush();

            return $this->redirect($this->generateUrl('question_list'));
        }
        return array('user' => $user, 'user_form' => $form->createView());
    }

    /**
     * @Route("/addQuestion", name="question_add")
     * @Template()
     */
    public function addQuestionAction(Request $request)
    {
        $session_id = $request->getSession()->get('id');
        if ($session_id){
        $form = $this->createForm(new QuestionType(), new Question());

        if ($form->isValid()){
            $form->bindRequest($request);
            $question = $form->getData();

            $filter = array('id' => $session_id);
            
            $user = $this->getDoctrine()
                ->getRepository('QandaHomeBundle:User')
                ->find($filter);
            $em = $this->getDoctrine()->getManager();
            $question->setCreatedDate(date_create(date('Y-m-d H:i:s')));
            $question->setUser($user);
            $em->persist($question);
            $em->flush();

            return $this->redirect($this->generateUrl('question_list'));
        }

        return array('question_form' => $form->createView());
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
       
    }

    /**
     * @Route("/editQuestion", name="edit_question")
     * @Template()
     */
    public function editQuestionAction(Request $request)
    {
        $question_id = $this->getRequest()->query->get('question_id');
        $filter = array('id' => $question_id);
        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($filter);

        $form = $this->createForm(new QuestionType(), $question);
        $form->handleRequest($request);

        if ($form->isValid()){
            $form_question = $form ->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($form_question);
            $em->flush();

            return $this->redirect($this->generateUrl('question_list'));
        }
        return array('question' => $question, 'question_form' => $form->createView());
    }

    /**
     * @Route("/register", name="register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(new RegisterType(), new User());

        $form->handleRequest($request);
        if ($form->isValid()){
            $question = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('login'));
        }

        return array('register_form' => $form->createView());
    }

    /**
     * @Route("/deleteQuestion", name="delete_question")
     * @Template()
     */
    public function deleteQuestionAction()
    {
        $question_id = $this->getRequest()->query->get('question_id');
        $filter = array('questionId' => $question_id);

        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($question_id);
        $answers = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->findBy($filter);

        $em = $this->getDoctrine()->getManager();
        $em->remove($question);
        foreach ($answers as $answer) {
            $em->remove($answer);
        }
        $em->flush();

        return $this->redirect($this->generateUrl('question_list'));
    }

    /**
     * @Route("/deleteAnswer", name="delete_answer")
     * @Template()
     */
    public function deleteAnswerAction(Request $request)
    {
        $answer_id = $this->getRequest()->query->get('answer_id');

        $answer = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->find($answer_id);

        $answers = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->findBy(array('questionId' => $answer->getQuestionId()));
        $count_answers = count($answers) - 1;

        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($answer->getQuestionId());

        $question->setAnswerCount($count_answers);
        if ($question->getBestAnswerId() == $answer->getId()){
            $question->setBestAnswerId(0);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($answer);
        $em->persist($question);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/bestAnswer", name="best_answer")
     * @Template()
     */
    public function bestAnswerAction(Request $request)
    {
        $answer_id = $this->getRequest()->query->get('answer_id');

        $answer = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
            ->find($answer_id);

        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($answer->getQuestionId());
        $question->setBestAnswerId($answer->getId());

        $em = $this->getDoctrine()->getManager();
        $em->persist($question);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}
