<?php
class Model
{
    static protected $link;

    static public function connect_to_database()
    {
        self::$link = mysql_connect('localhost', 'root', '');
        mysql_select_db('qanda_db', self::$link);
    }

    static public function close_database()
    {
        mysql_close(self::$link);
    }
}


class Question extends Model
{
    protected $id;
    protected $name;
    protected $title;
    protected $question;
    protected $created_date;  
    protected $answer_count;
    protected $best_answer_id; 

    public function getId()
    {
        return $this->id;
    }

    public function setId($v)
    {
        $this->id = $v;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($v)
    {
        $this->name = $v;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($v)
    {
        $this->title = $v;
        return $this;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($v)
    {
        $this->question = $v;
        return $this;
    }

    public function getDate()
    {
        return $this->created_date;
    }

    public function setDate($v)
    {
        $this->created_date = $v;
        return $this;
    }

    public function getAnswersCount()
    {
        return $this->answer_count;
    }

    public function setAnswersCount($v)
    {
        $this->answer_count = $v;
        return $this;
    }

    public function getBestAnswerId()
    {
        return $this->best_answer_id;
    }

    public function setBestAnswerId($v)
    {
        $this->best_answer_id = $v;
        return $this;
    }

    public function isAnswered()
    {
        return $this->getBestAnswerId() > 0;
    }

    public function toArray()
    {
        // return $this->_values;
        $arr = array(
            "title" => $this->getTitle(),
            "question" => $this->getQuestion(),
            "name" => $this->getName(),
            "id" => $this->getId()
        );
        return $arr;
    }

    static public function getQuestions()
    {
        $sql = "SELECT a.id, a.title, a.created_date, a.question,
                    a.name, a.bestAnswer, COUNT(h.id) as hariult_count
                FROM asuult a
                LEFT JOIN hariult h
                ON a.id = h.question_id
                GROUP BY a.created_date DESC";
        $questions = array();
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->setId($row['id']);
            $question->setTitle($row['title']);
            $question->setDate($row['created_date']);
            $question->setQuestion($row['question']);
            $question->setName($row['name']);
            $question->setBestAnswerId($row['bestAnswer']);
            $question->setAnswersCount($row['hariult_count']);
            $questions[] = $question;
        }
        self::close_database();
        return $questions;
    }

    public function getAnswers()
    {
        $question_id = $this->getId();
        $format = "SELECT * FROM hariult WHERE question_id = '%s' 
                   ORDER BY created_date ASC";
        $sql = sprintf($format, $question_id);
        $answers = array();
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $answer = new Answer();
            $answer->setId($row['id']);
            $answer->setDate($row['created_date']);
            $answer->setAnswer($row['answer']);
            $answer->setName($row['name']);
            $answer->setQuestionId($row['question_id']);
            $answers[] = $answer;
        }
        self::close_database();
        return $answers;
    }

    public function save()
    {
        $is_editing = is_numeric($this->getId());
        $question = mysql_escape_string($this->getQuestion());
        $title = mysql_escape_string($this->getTitle());
        $date = date("Y-m-d H:i:s");
        $name = mysql_escape_string($this->getName());
        $id = $this->getId();
        $best_answer_id = $this->getBestAnswerId();

        if ($is_editing){
            $format = "UPDATE asuult SET question='%s', title='%s',
                bestAnswer='%s' WHERE id=%s";
            $sql = sprintf($format, $question, $title, $best_answer_id, $id);
        } else {
            $format = "INSERT INTO asuult 
                        (id, title, created_date, question, name, bestAnswer)
                       VALUES (NULL, '%s' , '%s', '%s' ,'%s', 0 )";
            $sql = sprintf($format, $title, $date, $question, $name);
        }
        self::connect_to_database();
        $resultset = mysql_query($sql);
        if ($resultset){
            // saved successfully
        }else{
            // error in saving
        }
        if (!$is_editing){  // is adding
            $this->setId(mysql_insert_id());
        }
        self::close_database();
    }

    public function delete()
    {
        parent::connect_to_database();
        $id = $this->getId();
        $format = "DELETE FROM hariult WHERE question_id=%s";
        $sql = sprintf($format, $id);
        mysql_query($sql);
        $format = "DELETE FROM asuult WHERE id=%s";
        $sql = sprintf($format, $id);
        mysql_query($sql);
        parent::close_database();
    }

    static public function getById($id)
    {
        $format = "SELECT * FROM asuult WHERE id = %s";
        $sql = sprintf($format, $id);

        self::connect_to_database();
        $r = mysql_query($sql);
        while ($values = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->setId($values['id']);
            $question->setName($values['name']);
            $question->setTitle($values['title']);
            $question->setQuestion($values['question']);
            $question->setBestAnswerId($values['bestAnswer']);
            $question->setDate($values['created_date']);
        }
        self::close_database();
        return $question;
    }
}


class Answer extends Model
{
    protected $id;
    protected $name;
    protected $created_date;
    protected $answer;
    protected $question_id;

    public function setId($v)
    {
        $this->id = $v;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDate($v)
    {
        $this->created_date = $v;
        return $this;
    }

    public function getDate()
    {
        return $this->created_date;
    }

    public function setName($v)
    {
        $this->name = $v;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAnswer($v)
    {
        $this->answer = $v;
        return $this;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setQuestionId($v)
    {
        $this->question_id = $v;
        return $this;
    }

    public function getQuestionId()
    {
    return $this->question_id;
    }

    public function getQuestion()
    {
        return Question::getById($this->getQuestionId());
    }

    public function save()
    {
        $answer = mysql_escape_string($this->getAnswer());
        $name = mysql_escape_string($this->getName());
        $date = date("Y-m-d H:i:s");
        $question_id = $this->getQuestionId();
        $format = "INSERT INTO hariult (id, answer, name, created_date,
            question_id)
                   VALUES (NULL, '%s', '%s','%s', '%s')";
        $sql = sprintf($format, $answer, $name, $date, $question_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }

    static public function getById($id)
    {
        $format = "SELECT * FROM hariult WHERE id = %s";
        $sql = sprintf($format, $id);

        self::connect_to_database();
        $r = mysql_query($sql);
        while ($values = mysql_fetch_array($r))
        {
            $answer = new Answer();
            $answer->setId($values['id']);
            $answer->setName($values['name']);
            $answer->setDate($values['created_date']);
            $answer->setAnswer($values['Answer']);
            $answer->setQuestionId($values['question_id']);
        }
        self::close_database();
        return $answer;
    }

    public function delete()
    {
        $id = $this->getId();
        $format = "DELETE FROM hariult WHERE id=%s";
        $sql = sprintf($format, $id);
        self::connect_to_database();
        mysql_query($sql);
        self::close_database();
    }
}
?>
