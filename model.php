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
        $is_editing = is_numeric($this->getId());

        if ($is_editing){
            $fields = '';
            // Example:
            // $this->_values= array('name' => 'bold', 'created_at' => '2013-09-11 00:00:00');
            foreach ($this->_values as $field => $value){
                $fields .= sprintf($field."='%s', ", $value);
            }
            $fields = rtrim($fields, ", ");
            // Example:
            // $fields = "name='bold', created_at='2013-09-11 00:00:00'";

            $query = "UPDATE %s SET %s WHERE id = ".$this->getId()."";
            $sql = sprintf($query, $this::$_table, $fields);
        } else {
            $field_names = '';
            $field_values = '';
            // Example:
            // $this->_values= array('name' => 'bold', 'created_at' => NULL);
            foreach ($this->_values as $field => $value) {
                if ($field == 'created_date'){
                    $value = date("Y-m-d H:i:s");
                }
                $field_names .= $field.', ';
                $value = mysql_escape_string($value);
                $field_values .= sprintf("'%s', ", $value);
            }
            $field_values = rtrim($field_values, ", ");
            $field_names = rtrim($field_names, ", ");
            // Example:
            // $field_names = "name, created_at";
            // $field_values = "'bold', '2013-09-11 00:00:00'";
            $query = "INSERT INTO %s (%s) VALUES (%s)";
            $sql = sprintf($query, $this::$_table, $field_names, $field_values);
        }
        self::connect_to_database();
        $r = mysql_query($sql);
        self::close_database();
    }

    static public function getById($id)
    {
        $class = get_called_class();

        $sql = sprintf("SELECT * FROM %s WHERE id = %s", $class::$_table, $id);
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
        $sql = sprintf($format, self::$_table, $user_id);
        self::connect_to_database();
        $r = mysql_query($sql);
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

class Pagination
{
    static public function paginate()
    {
        $i = 1;
        $total_page = ceil(Question::getQuestionCount() / 5);
        while($i <= $total_page){
            if (has_get('page')){
                $page = get_param('page');
            } ?>
        <li>|
  <?php if ($page == $i){
            echo $i;
        } else { ?>
            <a href="list?page=<?php echo $i; ?>">
            <?php echo $i; ?>
            </a>
  <?php } ?>
        |</li>
  <?php $i++;
        }
    }
}
?>
