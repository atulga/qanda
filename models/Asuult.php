<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Asuult
 *
 * @Table(name="asuult")
 * @Entity
 */
class Asuult
{
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
    private $answerCount;

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

        return $this;
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
}
