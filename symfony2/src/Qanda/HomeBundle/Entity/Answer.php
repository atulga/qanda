<?php
namespace Qanda\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;

/**
 * Hariult
 *
 * @ORM\Table(name="hariult")
 * @ORM\Entity
 */
class Answer
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="answer", type="text", nullable=false)
     */
    private $answer;

    /**
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createdDate;

    /**
     * @ORM\Column(name="question_id", type="integer", nullable=false)
     */
    private $questionId;

    /**
     * @ORM\Column(name="user_id", type="integer", nullable=false)
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

    static public function getById($id)
    {
        global $em;
        $answer = $em->getRepository('Answer')
                   ->findOneBy(array('id' => $id));
        return $answer;
    }

    public function getQuestion()
    {
        return Question::getById($this->getQuestionId());
    }

    static public function getByQuestionId($question_id)
    {
        global $em;
        $filter = array('questionId' => $question_id);
        $order = array('createdDate' => 'ASC');
        $answers = $em->getRepository('Answer')
            ->findBy($filter, $order);
        return $answers;
    }

    static public function getAnswerCountByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $result = $em->getRepository('Answer')
            ->findBy($filter);
        $answer_count = count($result);
        return $answer_count;
    }

    static public function deleteByQuestionId($question_id)
    {
        global $em;
        $filter = array('questionId' => $question_id);
        $answers = $em->getRepository('Answer')
            ->findBy($filter);
        foreach($answers as $answer){
            $em->remove($answer);
        }
        $em->flush();
    }

    static public function getLastFiveAnswersByUserId($user_id)
    {
        global $em;
        $filter = array('userId' => $user_id);
        $order = array('createdDate' => 'DESC');
        $answers = $em->getRepository('Answer')
            ->findBy($filter, $order, 5);
        return $answers;
    }

    static public function getCountByQuestionId($question_id)
    {
        global $em;
        $filter = array('questionId' => $question_id);
        $result = $em->getRepository('Answer')->findBy($filter);
        // TODO check: $result - Doctrine_Collection::count
        $question_count = count($result);  // TODO optimize
        return $question_count;
    }

}
?>
