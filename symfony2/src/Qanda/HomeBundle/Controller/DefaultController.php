<?php

namespace Qanda\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Qanda\HomeBundle\Helpers\Paginator;
use Qanda\HomeBundle\Forms\Forms;
use Qanda\HomeBundle\Entity\Question;
use Qanda\HomeBundle\Entity\Answer;
use Qanda\HomeBundle\Entity\User;


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
     * @Route("/show", name="question_show")
     * @Template()
     */
    public function showAction()
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

        return array('question' => $question, 'answers' => $answers);
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
        $order = array('createdDate' => 'ASC');

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
     * @Route("/editQuestion", name="edit_question")
     * @Template()
     */
    public function editQuestionAction()
    {
        $question_id = $this->getRequest()->query->get('question_id');

        $filter = array('id' => $question_id);
        $question = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->find($filter);
        return array('question' => $question);
    }

    /**
     * @Route("/editProfile", name="edit_profile")
     * @Template()
     */
    public function editProfileAction()
    {
        $user_id = $this->getRequest()->query->get('user_id');

        $filter = array('id' => $user_id);
        $user = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:User')
            ->find($filter);
        return array('user' => $user);
    }

    /**
     * @Route("/addQuestion", name="question_add")
     * @Template()
     */
    public function addQuestionAction()
    {
        return array();
    }

    /**
     * @Route("/register", name="register")
     * @Template()
     */
    public function registerAction()
    {
        return array();
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
    public function deleteAnswerAction()
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


        $em = $this->getDoctrine()->getManager();
        $em->remove($answer);
        $em->persist($question);
        $em->flush();

        return
            $this->redirect(
                $this->generateUrl('question_list'));
    }

    /**
     * @Route("/bestAnswer", name="best_answer")
     * @Template()
     */
    public function bestAnswerAction()
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

        return
            $this->redirect(
                $this->generateUrl('question_list'));
    }
}
