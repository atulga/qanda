<?php
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;

/**
 * Asuult
 *
 * @Table(name="asuult")
 * @Entity
 */
class Question 
{
    static public $_table = 'asuult';

    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="title", type="text", nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;

    /**
     * @var string
     *
     * @Column(name="question", type="text", nullable=false)
     */
    private $question;

    /**
     * @var integer
     *
     * @Column(name="best_answer_id", type="integer", nullable=false)
     */
    private $bestAnswerId;

    /**
     * @var integer
     *
     * @Column(name="answer_count", type="integer", nullable=false)
     */
    private $answerCount = 0;

    /**
     * @var integer
     *
     * @Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;



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
     * Set userId
     *
     * @param integer $userId
     * @return Asuult
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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

    public function delete()
    {
        global $em;
        Answer::deleteByQuestionId($this->getId());
        $em->remove($this->getId());
        $em->flush();
    }

    static public function getLastFiveQuestionsByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $order = array('createdDate' => 'DESC');
        $questions = $em->getRepository('Asuult')
            ->findBy($filter, $order, 5);
        return $questions;
    }

    static public function getQuestionCountByUserId($user_id){
        global $em;
        $filter = array('userId' => $user_id);
        $result = $em->getRepository('Asuult')
            ->findBy($filter);
        $question_count = count($result);
        return $question_count;
    }
}
