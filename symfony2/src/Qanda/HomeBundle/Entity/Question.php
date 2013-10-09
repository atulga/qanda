<?php
namespace Qanda\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Asuult
 *
 * @ORM\Table(name="asuult")
 * @ORM\Entity
 */
class Question
{
    static public $_table = 'asuult';

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;

    /**
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    private $question;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="best_answer_id", type="integer", nullable=false)
     */
    private $bestAnswerId = 0;

    /**
     * @ORM\Column(name="answer_count", type="integer", nullable=false)
     */
    private $answerCount = 0;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="questions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Asuult
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Asuult
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return Asuult
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set bestAnswerId
     *
     * @param integer $bestAnswerId
     * @return Asuult
     */
    public function setBestAnswerId($bestAnswerId)
    {
        $this->bestAnswerId = $bestAnswerId;

        return $this;
    }

    /**
     * Get bestAnswerId
     *
     * @return integer
     */
    public function getBestAnswerId()
    {
        return $this->bestAnswerId;
    }

    /**
     * Set answerCount
     *
     * @param integer $answerCount
     * @return Asuult
     */
    public function setAnswerCount($answerCount)
    {
        $this->answerCount = $answerCount;

        return $this;
    }

    /**
     * Get answerCount
     *
     * @return integer
     */
    public function getAnswerCount()
    {
        return $this->answerCount;
    }

    /**
     * Set user
     *
     * @param \Qanda\HomeBundle\Entity\User $user
     * @return Question
     */
    public function setUser(\Qanda\HomeBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \Qanda\HomeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    public function isAnswered()
    {
        return $this->getBestAnswerId() > 0;
    }

    static public function getById($id, $as_array=false)
    {
        global $em;
        $qb = $em->createQueryBuilder();
        $query = $qb->select('a')
            ->from('Question', 'a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        if ($as_array){
            $q = $query->getSingleResult(Query::HYDRATE_ARRAY);
        }else{
            $q = $query->getSingleResult();
        }
        return $q;
    }

    static public function getQuestionCount()
    {
        global $em;
        $filter = array();
        $result = $em->getRepository('Question')
            ->findBy($filter);
        $count = count($result);
        return $count;
    }

    static public function getQuestions($page)
    {
        global $em;
        $filter = array();
        $order = array('createdDate' => 'DESC');
        $one_page_rows = 5;
        $offset = ($page -1) * $one_page_rows;
        $questions = $em->getRepository('Question')
            ->findBy($filter, $order, $one_page_rows, $offset);
        return $questions;
    }

    public function getAnswers()
    {
        return Answer::getByQuestionId($this->getId());
    }

    static public function getLastFiveQuestionsByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $order = array('createdDate' => 'DESC');
        $questions = $em->getRepository('Question')
            ->findBy($filter, $order, 5);
        return $questions;
    }

    static public function getQuestionCountByUserId($user_id){
        global $em;
        $filter = array('userId' => $user_id);
        $result = $em->getRepository('Question')
            ->findBy($filter);
        $question_count = count($result);
        return $question_count;
    }
}

?>
