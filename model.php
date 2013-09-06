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
}


class Question extends Model
{
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
        $sql = "SELECT COUNT(id) FROM asuult";
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
        $format = "SELECT * FROM asuult ORDER BY created_date DESC LIMIT %s, %s";
        $sql = sprintf($format, $page, $one_page_rows);
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
            $answer->populate($row);
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
        $user_id = mysql_escape_string($this->getUserId());
        $id = $this->getId();
        $best_answer_id = $this->getBestAnswerId();
        $answer_count = $this->getAnswerCount();
        $user_id = $_SESSION['id'];
        if ($is_editing){
            $format = "UPDATE asuult SET question='%s',
                title='%s', best_answer_id='%s', answer_count='%s' WHERE id=%s";
            $sql = sprintf($format, $question, $title, $best_answer_id,
                $answer_count, $id);
        } else {
            $format = "INSERT INTO asuult ".$this->queryFields()."
                       VALUES (NULL, '%s' , '%s', '%s' ,0 , 0, '%s')";
            $sql = sprintf($format, $title, $date, $question, $user_id);
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
        $values = mysql_fetch_array($r);
        // $classname = get_class($this);  // Question
        // $obj = new $classname();
        $question = new Question();
        $question->populate($values);
        self::close_database();
        return $question;
    }

    static public function getLastQuestionsByUserId($user_id)
    {
        $format = "SELECT * FROM asuult where user_id=%s order by
            created_date desc limit 5";
        $sql = sprintf($format, $user_id);
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
        $format = "SELECT COUNT(question) FROM asuult WHERE user_id=%s";
        $sql = sprintf($format, $user_id);
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
        $format = "INSERT INTO hariult ".$this->queryFields()."
                    VALUES (NULL, '%s', '%s','%s', '%s')";
        $sql = sprintf($format, $answer, $date, $question_id, $user_id);
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
        $values = mysql_fetch_array($r);
        $answer = new Answer();
        $answer->populate($values);
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

    static public function getAnswerCountByUserId($user_id){
        $format = "SELECT COUNT(answer) FROM hariult WHERE user_id=%s";
        $sql = sprintf($format, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        self::close_database();
        $answer_count = $values[0];
        return $answer_count;
    }

    static public function getLastAnswersByUserId($user_id)
    {
        $format = "SELECT * FROM hariult where user_id=%s order by
            created_date desc limit 5";
        $sql = sprintf($format, $user_id);
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

    static public function getById($id)
    {
        $format = "SELECT * FROM user WHERE id = %s";
        $sql = sprintf($format, $id);

        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        $user = new User();
        $user->populate($values);
        self::close_database();
        return $user;
    }

    public function save()
    {
        $name = mysql_escape_string($this->getName());
        $password = mysql_escape_string($this->getPassword());
        $format = "INSERT INTO user %s VALUES (NULL, '%s', '%s', NULL, NULL)";
        $sql = sprintf($format, $this->queryFields(), $name, $password);
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }

    static public function getByName($name)
    {
        $name = mysql_escape_string($name);
        $format = "SELECT * FROM user WHERE name='%s'";
        $sql = sprintf($format, $name);
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
        $format = "SELECT * FROM user WHERE name='%s' AND password='%s'";
        $sql = sprintf($format, $name, $password);
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
        $format = "SELECT name FROM user WHERE id=%s";
        $sql = sprintf($format, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
        while ($values = mysql_fetch_array($r))
        {
            $user_name = $values['name'];
        }
        self::close_database();
        return $user_name;
    }

    public function profileSave()
    {
        $name = mysql_escape_string($this->getNickname());
        $description = mysql_escape_string($this->getDescription());
        $format = "UPDATE user SET nickname = '%s', description = '%s' WHERE id=%s";
        $sql = sprintf($format, $name, $description, $this->getId());
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }
}
?>
