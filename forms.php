<?php
class QuestionForm
{
    protected $name;
    protected $title;
    protected $question;
    protected $_errors = array();
    protected $_fields = array(
        'name', 'title', 'question',
    );

    /**
     * Returns boolean if it has error
     */
    public function validate()
    {
        if (!(strlen($this->name) > 0)){
            $this->_errors['name'] = 'Өөрийн нэрээ оруулна уу';
        }
        return count($this->_errors) > 0;
    }

    public function populate($values)
    {
        foreach ($this->_fields as $field) {
            $this->$field = $values[$field];
        }
    }

    public function save()
    {
        add_question($this->name, $this->title, $this->question);
    }

    public function __call($func_name, $args)
    {
        $fields = array();
        foreach($this->_fields as $field){
            $fname = 'get'.ucfirst($field);
            $fields[$fname]  = $this->$field;
        }
        if (array_key_exists($func_name, $fields)){
            return $fields[$func_name];
        }
    }

    public function getError($field)
    {
        if (isset($this->_errors[$field])){
            return $this->_errors[$field];
        }
    }
}
?>
