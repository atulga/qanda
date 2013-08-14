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
    protected $create_date;
    protected $answer_count;
    protected $best_answer;

    public function getId()
    {
        return $this->id;
    }

    public function setId($v)
    {
        $this->id = mysql_escape_string($v);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($v)
    {
        $this->name = mysql_escape_string($v);
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($v)
    {
        $this->title = mysql_escape_string($v);
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
        return $this->create_date;
    }

    public function setDate($v)
    {
        $this->create_date = $v;
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

    public function getBestAnswer()
    {
        return $this->best_answer;
    }

    public function setBestAnswer($v)
    {
        $this->best_answer = $v;
        return $this;
    }

    public function isAnswered(){
        if ($this->getBestAnswer() == 0) return false;
        else return true;
    }
    public function toArray()
    {
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
        self::connect_to_database();
        $sql = "SELECT a.id, a.title, a.create_date, a.question,
                    a.name, a.result, COUNT(h.id) as hariult_count
                FROM asuult a
                LEFT JOIN hariult h
                ON a.id = h.asuult_id
                GROUP BY a.create_date DESC";
        $questions = array();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->id = $row['id'];
            $question->title = $row['title'];
            $question->create_date = $row['create_date'];
            $question->question = $row['question'];
            $question->name = $row['name'];
            $question->best_answer = $row['result'];
            $question->answer_count = $row['hariult_count'];
            $questions[] = $question;
        }
        self::close_database();
        return $questions;
    }

    public function save()
    {
        self::connect_to_database();
        if ($this->getId()){
            $sql = "UPDATE asuult SET question='".$this->getQuestion()."',
                    title='".$this->getTitle()."' WHERE id=".$this->getId();
        } else {
            $sql = "INSERT INTO asuult
                        (id, title, create_date, question, name, result)
                    VALUES (NULL, '".$this->getTitle()."' , '".date("Y-m-d
              H:i:s")."', '".$this->getQuestion()."' , '".$this->getName()."',
                0 )";
        }
        $r = mysql_query($sql);
        $this->setId($r);
        self::close_database();
    }

    public function delete()
    {
        parent::connect_to_database();
        $sql = "DELETE FROM hariult WHERE asuult_id=".$this->getId();
        $result = mysql_query($sql);
        $sql = "DELETE FROM asuult WHERE id=".$this->getId(); //asuult ustgah
        $result = mysql_query($sql);
        parent::close_database();
    }

    static public function getById($id)
    {
        // get from database by id
        // if no record in database return null
        self::connect_to_database();
        $sql = "SELECT * FROM asuult WHERE id = ".$id;
        $r = mysql_query($sql);
        while ($values = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->setId($values['id']);
            $question->setName($values['name']);
            $question->setTitle($values['title']);
            $question->setQuestion($values['question']);
            $question->setBestAnswer($values['result']);
            $question->setDate($values['create_date']);
        }
        self::close_database();
        return $question;
    }
}


class Answer extends Model
{
    protected $best;
    protected $id;
    protected $name;
    protected $create_date;
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
        $this->create_date = $v;
        return $this;
    }

    public function getDate()
    {
        return $this->create_date;
    }

    public function setName($v)
    {
        $this->name = mysql_escape_string($v);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAnswer($v)
    {
        $this->answer = mysql_escape_string($v);
        return $this;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setBest($v)
    {
        $this->best = $v;
        return $this;
    }

    public function getBest()
    {
        return $this->best;
    }

    public function isBest()
    {
        if($this->best == 1) return true;
        else return false;
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

    static public function getAnswers($question_id)
    {
        self::connect_to_database();
        $sql = "SELECT * FROM hariult WHERE asuult_id = '".$question_id."'
                ORDER BY best DESC";
        $answers = array();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $answer = new Answer();
            $answer->id = $row['id'];
            $answer->create_date = $row['create_date'];
            $answer->answer = $row['answer'];
            $answer->name = $row['name'];
            $answer->question_id = $row['asuult_id'];
            $answer->best = $row['best'];
            $answers[] = $answer;
        }
        self::close_database();
        return $answers;
    }

    public function getQuestion()
    {
        return Question::getById($this->getQuestionId());
    }

    public function save()
    {
        self::connect_to_database();
        $sql = "INSERT INTO hariult (id, answer, name, create_date, asuult_id, best)
            VALUES (NULL, '".$this->getAnswer()."', '".$this->getName()."',
                '".date("Y-m-d H:i:s")."', '".$this->getQuestionId()."', '0')";
        $r = mysql_query($sql);
        self::close_database();
    }

    public function best($question_id, $answer_id)
    {
        self::connect_to_database();
        $sql = "UPDATE asuult SET result='$answer_id' WHERE id='".$question_id."'";
        mysql_query($sql);
        $sql = "UPDATE hariult SET best='0' WHERE asuult_id='".$question_id."'";
        mysql_query($sql);
        $sql = "UPDATE hariult SET best='1' WHERE id='".$answer_id."'";
        mysql_query($sql);
        self::close_database();
    }

    public function delete()
    {
        self::connect_to_database();
        $sql = "DELETE FROM hariult WHERE id=".$this->getId();
        mysql_query($sql);
        self::close_database();
    }
}
?>
