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
                $value = mysql_escape_string($value);
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
        // Example:
        // $class = User; $class::$_table = user
        $sql = sprintf("SELECT * FROM %s WHERE id = %s", $class::$_table, $id);
        // $sql = 'select * from user where id=$id'
        self::connect_to_database();
        $r = mysql_query($sql);
        $values = mysql_fetch_array($r);
        $obj = new $class;
        $obj->populate($values);
        self::close_database();
        return $obj;
    }
}

class Paginator
{
    protected $cur_page = 1; // anhnii utga
    protected $tot_page = NULL;
    protected $one_page_per = 5;

    function getPages()
    {
        $arr = array();
        $totpage = ceil(Question::getQuestionCount() / $this->one_page_per);
        for($i=0; $i<$totpage; $i++){
            $arr[$i] = $i+1;
        }
        return $arr;
    }

    function getCurrentPage()
    {
        return $this->cur_page;
    }

    function setCurrentPage($page = 1)
    {
        $this->cur_page = $page;
    }
}
?>
