<?php
class Model
{
    static protected $link;
    protected $_values = array();

    static public function connect_to_database()
    {
        global $db_config;
        self::$link = mysql_connect(
            $db_config['hostname'],
            $db_config['username'],
            $db_config['password']
        );
        mysql_select_db($db_config['database'], self::$link);
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
    
    public function save()
    {
        $answer = mysql_escape_string($this->getAnswer());
        $user_id = $_SESSION['id'];
        $date = date("Y-m-d H:i:s");
        $question_id = $this->getQuestionId();
        $is_editing = is_numeric($this->getId());
        $s = '';
        foreach ($this->_values as $key => $value)
        {
            $s .= sprintf($key."='%s', ", $value);
        }
        $s = substr($s, 0, -2); 
        if(isset($user_id) && $is_editing)
        {
            $uformat = "UPDATE %s SET %s WHERE id = ".$this->getId().""; 
            $sql = sprintf($uformat, $this::$_table, $s);
        }
        if(!$is_editing)
        { 
            $iformat = "INSERT INTO %s ".$this->queryFields()." VALUES '%s'";
            $sql = sprintf($iformat, $this::$_table, $this->_values); echo($sql); die();
        }
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database(); 
    }

    static public function getById($id)
    {
        $class = get_called_class();
      
        $sql = sprintf("SELECT * FROM %s WHERE id = %s", $class::$_table, $id);
       // var_dump($sql); die;
        self::connect_to_database();
        $r = mysql_query($sql);      
        $values = mysql_fetch_array($r); 
        $obj = new $class;
        $obj->populate($values);
        self::close_database();
        return $obj;
    }
}

class Question extends Model
{
    static public $_table = 'asuult';
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
        return Answer::getCountByQuestionId($this->getId());
    }

    public function getAnswers()
    {
        return Answer::getByQuestionId($this->getId());
    }
    public function delete()
    {
        Answer::deleteByQuestionId($this->getId());
        self::connect_to_database();
        $format = "DELETE FROM %s WHERE id=%s";
        $sql = sprintf($format, self::$_table, $this->getId());
        mysql_query($sql);
        self::close_database();
    }

    static public function getLastFiveQuestionsByUserId($user_id)
    {
        $format = "SELECT * FROM %s where user_id=%s order by
            created_date desc limit 5";
        $sql = sprintf($format, self::$_table, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $questions = array();
        while ($values = mysql_fetch_array($r))
        {
            $question = new Question();
            $question->populate($values);
            $questions[] = $question;
        }
        self::close_database();
        return $questions;
    }

    static public function getQuestionCountByUserId($user_id){
        $format = "SELECT COUNT(question) FROM %s WHERE user_id=%s";
        $sql = sprintf($format, self::$_table, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        self::close_database();
        $question_count = $values[0];
        return $question_count;
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
            $answer = new Answer();
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

    static public function getAnswerCountByUserId($user_id){
        $format = "SELECT COUNT(answer) FROM %s WHERE user_id=%s";
        $sql = sprintf($format, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql) or die;
        $values = mysql_fetch_array($r);
        self::close_database();
        $answer_count = $values[0];
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
        $format = "SELECT * FROM %s WHERE user_id=%s ORDER BY
            created_date DESC LIMIT 5";
        $sql = sprintf($format, self::$_table, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $answers = array();
        while ($values = mysql_fetch_array($r))
        {
            $answer = new Answer();
            $answer->populate($values);
            $answers[] = $answer;
        }
        self::close_database();
        return $answers;
    }
}

class User extends Model
{
    protected $_fields = array('id', 'name', 'password', 'nickname', 'description');

    static $_table = 'user';

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
