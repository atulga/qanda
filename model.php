<?php
class Model
{
    static protected $link;
    public $_values = array();

    static public function connect_to_database()
    {
        self::$link = mysql_connect('localhost', 'root', '');
        mysql_select_db('qanda_db', self::$link);
    }

    static public function close_database()
    {
        mysql_close(self::$link);
    }

    public function __construct()
    {
        foreach ($this->_fields as $field) {
            $this->_values[$field] = null;
        }
    }

    public function camelize($str)
    {
        $str = preg_replace('/_/', ' ', $str);
        $str = ucwords($str);
        $str = preg_replace('/ /', '', $str);
        return $str;
    }

    public function __call($func_name, $args)
    {
        // setter
        if (strpos('set', $func_name) === 0) {
            $arg = $args[0];
            $fields = array();
            foreach ($this->_fields as $field) {
                $fname = 'set'.$this->camelize($field);
                $fields[$fname] = $field;
            }
            if (array_key_exists($func_name, $fields)){
                $field = $fields[$func_name];
                $this->_values[$field] = $arg;
                return $this;
            }

        // getter
        } else {
            $fields = array();
            foreach ($this->_fields as $field) {
                $fname = 'get'.$this->camelize($field);
                $fields[$fname] = $this->_values[$field];
            }
            if (array_key_exists($func_name, $fields)){
                return $fields[$func_name];
            }
        }
    }
}


class Question extends Model
{
    protected $_fields = array(
                    'id', 'name', 'title', 'question', 'created_date',
                    'answers_count', 'best_answer_id'
            );

    public function isAnswered()
    {
        return $this->getBestAnswerId() > 0;
    }

    public function toArray()
    {
        return $this->_values;
    }

    static public function getQuestions()
    {
        $sql = "SELECT a.id, a.title, a.created_date, a.question,
                    a.name, a.best_answer_id, COUNT(h.id) as hariult_count
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
            $question->setCreatedDate($row['created_date']);
            $question->setQuestion($row['question']);
            $question->setName($row['name']);
            $question->setBestAnswerId($row['best_answer_id']);
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
            $answer->setCreatedDate($row['created_date']);
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
                best_answer_id='%s' WHERE id=%s";
            $sql = sprintf($format, $question, $title, $best_answer_id, $id);
        } else {
            $format = "INSERT INTO asuult 
                        (id, title, created_date, question, name,
                        best_answer_id)
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
            $question->setBestAnswerId($values['best_answer_id']);
            $question->setCreatedDate($values['created_date']);
        }
        self::close_database();
        return $question;
    }
}


class Answer extends Model
{
    protected $_fields = array(
                    'id', 'name', 'created_date', 'answer', 'question_id'
            );

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
            $answer->setCreatedDate($values['created_date']);
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
