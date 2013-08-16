<?php
class Model
{
    static protected $link;
    protected $_values = array();

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
   /* 
    public function populate($values)
    {
        foreach ($this->_fields as $field) {
            $this->_values[$field] = $values[$field];
        }
    }
    */
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
        if ($args) {
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
                    'id', 
                    'title', 
                    'created_date',
                    'question', 
                    'name', 
                    'best_answer_id',
                    'answer_count' 
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
        $sql = "SELECT * FROM asuult ORDER BY created_date DESC";
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
            $question->setAnswerCount($row['answer_count']);
            $questions[] = $question;
        }
        self::close_database();
        return $questions;
    }

    public function updateAnswerCount()
    {
        self::connect_to_database();
        $format = "SELECT COUNT(id) FROM hariult WHERE question_id=%s";
        $sql = sprintf($format, $this->getId());
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result); 
        $count = $row[0];
        self::close_database();
        $this->setAnswerCount($count);
        return $count;
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
            $answer->setAnswer($row['answer']);
            $answer->setName($row['name']);
            $answer->setCreatedDate($row['created_date']);
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
        $answer_count = $this->getAnswerCount();

        if ($is_editing){
            $format = "UPDATE asuult SET question='%s', title='%s',
                best_answer_id='%s', answer_count=%s WHERE id=%s";
            $sql = sprintf($format, $question, $title, $best_answer_id, $answer_count, $id);
        } else {
            $format = "INSERT INTO asuult 
                        (id, title, created_date, question, name,
                        best_answer_id, answer_count)
                       VALUES (NULL, '%s' , '%s', '%s' ,'%s', 0, 0 )";
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
        self::connect_to_database();
        $id = $this->getId();
        $format = "DELETE FROM hariult WHERE question_id=%s";
        $sql = sprintf($format, $id);
        mysql_query($sql);
        $format = "DELETE FROM asuult WHERE id=%s";
        $sql = sprintf($format, $id);
        mysql_query($sql);
        self::close_database();
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
            $question->setTitle($values['title']);
            $question->setCreatedDate($values['created_date']);
            $question->setQuestion($values['question']);
            $question->setName($values['name']);
            $question->setBestAnswerId($values['best_answer_id']);
            $question->setAnswerCount($values['answer_count']);
        }
        self::close_database();
        return $question;
    }
}


class Answer extends Model
{
    protected $_fields = array(
                'id', 
                'answer', 
                'name', 
                'created_date', 
                'question_id'
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
            $answer->setAnswer($values['answer']);
            $answer->setName($values['name']);
            $answer->setCreatedDate($values['created_date']);
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
