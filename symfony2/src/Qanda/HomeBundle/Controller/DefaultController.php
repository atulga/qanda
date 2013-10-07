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
        $filter = array('userId' => $user_id);

        $questions = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Question')
            ->findBy($filter, $order, 5);

        $answers = $this->getDoctrine()
            ->getRepository('QandaHomeBundle:Answer')
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

}
