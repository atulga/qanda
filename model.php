<?php
class Model
{
    static protected $link;
    protected $_values = array();

    static public function connect_to_database()
    {
        self::$link = mysql_connect('localhost', 'root', '123456');
        mysql_select_db('qanda', self::$link);
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

    public function populate($values)
    {
        foreach ($this->_fields as $field) {
            $this->_values[$field] = $values[$field];
        }
    }

   public function queryFields()
    {
        $fields_name = null;
        foreach ($this->_fields as $field) {
            $fields_name = $fields_name.$field.', ';
        }
        $fields_name = rtrim($fields_name, ", ");
        $fields_name = "(".$fields_name.")";
        return $fields_name;
    }

    public function __call($func_name, $args)
    {
        // setter
        if ($args) {
            $arg = $args[0];
            $fields = array();
            foreach ($this->_fields as $field) {
                $fname = 'set'.camelcase($field);
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
                $fname = 'get'.camelcase($field);
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
    static $_table = 'asuult';


    protected $_fields = array(
                    'id',
                    'title',
                    'created_date',
                    'question',
                    'best_answer_id',
                    'answer_count',
                    'user_id'
            );

    public function isAnswered()
    {
        return $this->getBestAnswerId() > 0;
    }

    public function toArray()
    {
        return $this->_values;
    }

    static public function getQuestionCount()
    {
        $sql = sprintf("SELECT COUNT(id) FROM %s", self::$_table);
        self::connect_to_database();
        $row = mysql_fetch_array(mysql_query($sql));
        self::close_database();
        $row_count = $row[0];
        return $row_count;
    }

    static public function getQuestions($page)
    {
        $one_page_rows = 5;
        $page = ($page -1) * $one_page_rows;
        $format = "SELECT * FROM %s ORDER BY created_date DESC LIMIT %s, %s";
        $sql = sprintf($format, self::$_table, $page, $one_page_rows);
        $questions = array();
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->populate($row);
            $questions[] = $question;
        }
        self::close_database();
        return $questions;
    }

    public function updateAnswerCount()
    {
        return Answer::updateAnswerCountByQuestionId($this->getId());
    }

    public function getAnswers()
    {
        return Answer::getAnswersByQuestionId($this->getId());
    }
    public function save()
    {
        $is_editing = is_numeric($this->getId());
        $question = mysql_escape_string($this->getQuestion());
        $title = mysql_escape_string($this->getTitle());
        $date = date("Y-m-d H:i:s");
        $user_id = mysql_escape_string($this->getUserId());
        $id = $this->getId();
        $best_answer_id = $this->getBestAnswerId();
        $answer_count = $this->getAnswerCount();
        $user_id = $_SESSION['id'];
        if ($is_editing){
           $format = "UPDATE %s SET question='%s', title='%s',
                        best_answer_id='%s', answer_count='%s' WHERE id=%s";
                $sql = sprintf($format, self::$_table, $question, $title, $best_answer_id,
                        $answer_count, $id);
                        }else {
            $format = "INSERT INTO %s ".$this->queryFields()."
                       VALUES (NULL, '%s', '%s', '%s', 0, 0, '%s')";
            $sql = sprintf($format, self::$_table, $title, $date,
                $question, $user_id);
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
        Answer::AnswersdeleteByQuestionId($this->getId());
        
        self::connect_to_database();
        $format = "DELETE FROM %s WHERE id=%s";
        $sql = sprintf($format, self::$_table, $this->getId());
        mysql_query($sql);
        self::close_database();
    }

    static public function getById($id)
    {
        $format = "SELECT * FROM %s WHERE id = %s";
        $sql = sprintf($format, self::$_table, $id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        $question = new Question();
        $question->populate($values);
        self::close_database();
        return $question;
    }
}


class Answer extends Model
{
    static $_table = 'hariult';

    protected $_fields = array(
                'id',
                'answer',
                'created_date',
                'question_id',
                'user_id'
            );

    public function getQuestion()
    {
        return Question::getById($this->getQuestionId());
    }

    public function save()
    {
        $answer = mysql_escape_string($this->getAnswer());
        $user_id = $_SESSION['id'];
        $date = date("Y-m-d H:i:s");
        $question_id = $this->getQuestionId();
        $format = "INSERT INTO %s ".$this->queryFields()."
                    VALUES (NULL, '%s', '%s','%s', '%s')";
        $sql = sprintf($format, self::$_table, $answer, $date, $question_id, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }

    static public function updateAnswerCountByQuestionId($question_id)
    {
        $format = "SELECT COUNT(id) FROM %s WHERE question_id=%s";
        $sql = sprintf($format, self::$_table, $question_id);
        self::connect_to_database();
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
        $count = $row[0];
        self::close_database();
        self::setAnswerCount($count);
        return $count;
    }

    static public function getAnswersByQuestionId($question_id)
    {
        $format = "SELECT * FROM %s WHERE question_id = '%s'
                   ORDER BY created_date ASC";
        $sql = sprintf($format, self::$_table, $question_id);
        $answers = array();
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($row = mysql_fetch_array($r))
        {
            $answer = new Answer();
            $answer->populate($row);
            $answers[] = $answer;
        }
        self::close_database();
        return $answers;
    }

    static public function getById($id)
    {
        $format = "SELECT * FROM %s WHERE id = %s";
        $sql = sprintf($format, self::$_table, $id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        $answer = new Answer();
        $answer->populate($values);
        self::close_database();
        return $answer;
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

    public function AnswersdeleteByQuestionId($question_id)
    {
        $format = "DELETE FROM %s WHERE question_id=%s";
        $sql = sprintf($format, self::$_table, $question_id);
        self::connect_to_database();
        mysql_query($sql);
        self::close_database();
    }
}


class User extends Model
{
    static $_table = 'user';

    protected $_fields = array('id', 'name', 'password');

    public function save()
    {
        $name = mysql_escape_string($this->getName());
        $password = mysql_escape_string($this->getPassword());
        $format = "INSERT INTO %s %s VALUES (NULL, '%s', '%s')";
        $sql = sprintf($format, $this->_table,$this->queryFields(), $name, $password);
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }

    static public function getByName($name)
    {
        $name = mysql_escape_string($name);
        $format = "SELECT * FROM %s WHERE name='%s'";
        $sql = sprintf($format, self::$_table, $name);
        self::connect_to_database();
        $result = mysql_query($sql);
        $user = new User();
        while ($values = mysql_fetch_array($result))
        {
            $user->setName($values['name']);
        }
        self::close_database();
        return $user;
    }

    static public function getUser($name, $password=null)
    {
        $name = mysql_escape_string($name);
        $password = mysql_escape_string($password);
        $format = "SELECT * FROM %s WHERE name='%s' AND password='%s'";
        $sql = sprintf($format, self::$_table,$name, $password);
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        $user = new User();
        $user->populate($values);
        self::close_database();
        return $user;
    }

    static public function getUserNameById($user_id)
    {
        $format = "SELECT name FROM %s WHERE id=%s";
        $sql = sprintf($format, self::$_table, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($values = mysql_fetch_array($r))
        {
            $user_name = $values['name'];
        }
        self::close_database();
        return $user_name;
    }
}
?>
