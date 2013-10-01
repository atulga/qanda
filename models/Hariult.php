<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Hariult
 *
 * @Table(name="hariult")
 * @Entity
 */
class Hariult
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
     * @Column(name="answer", type="text", nullable=false)
     */
    private $answer;

    /**
     * @var \DateTime
     *
     * @Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;

    /**
     * @var integer
     *
     * @Column(name="question_id", type="integer", nullable=false)
     */
    private $questionId;

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
     * Set answer
     *
     * @param string $answer
     * @return Hariult
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {

        return $this->answer;
    }

    /**
     * Set createdDate
     *

     * @param \DateTime $createdDate
     * @return Hariult
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
     * Set questionId
     *
     * @param integer $questionId
     * @return Hariult
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer 
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Hariult
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

    static $_table = 'hariult';

    public function getQuestion()
    {
        return Asuult::getById($this->getQuestionId());
    }

    static public function getByQuestionId($question_id)
    {
        $format = "SELECT * FROM %s WHERE question_id = '%s'
                   ORDER BY created_date ASC";
        $sql = sprintf($format, self::$_table, $question_id);
        $answers = array();
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $answer = new Hariult();
            $answer->populate($row);
            $answers[] = $answer;
        }
        self::close_database();
        return $answers;
    }

    public function delete()
    {
        $id = $this->getId();
        $format = "DELETE FROM %s WHERE id=%s";
        $sql = sprintf($format, self::$_table, $id);
        self::connect_to_database();
        mysql_query($sql);
        self::close_database();
    }

    static public function getAnswerCountByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $result = $em->getRepository('Hariult')
            ->findBy($filter); 
        $answer_count = count($result);
        return $answer_count;
    }

    public function deleteByQuestionId($question_id)
    {
        
        $format = "DELETE FROM %s WHERE question_id=%s";
        $sql = sprintf($format, self::$_table, $question_id);
        self::connect_to_database();
        mysql_query($sql);
        self::close_database();
    }

    static public function getLastFiveAnswersByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $order = array('createdDate' => 'DESC');
        $answers = $em->getRepository('Hariult')
            ->findBy($filter, $order, 5);
        return $answers;
    }
    
    static public function getCountByQuestionId($question_id)
    {
        
        $format = "SELECT COUNT(id) FROM %s WHERE question_id=%s";
        $sql = sprintf($format, self::$_table, $question_id);
        self::connect_to_database();
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        $count = $row[0];
        self::close_database();

        return $count;
    }

}
