<?php
class BaseForm
{
    protected $_errors = array();
    protected $_values = array();

    public function __construct()
    {
        foreach ($this->_fields as $field) {
            $this->_values[$field] = null;
        }
    }

    public function populate($values)
    {
        if (gettype($values) == "array"){
            foreach ($this->_fields as $field) {
                $this->_values[$field] = $values[$field];
            }
        } else {
            // TODO
        }
    }

    public function __call($func_name, $args)
    {
        $fields = array();
        foreach($this->_fields as $field){
            $fname = 'get'.ucfirst($field);
            $fields[$fname] = $this->_values[$field];
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

    public function validate_required($field, $message)
    {
        $fname = 'get'.ucfirst($field);
        if (!(strlen($this->$fname()) > 0)){
            $this->_errors[$field] = $message;
        }
    }
}


class QuestionForm extends BaseForm
{
    protected $_fields = array('name', 'title', 'question', 'id');

    public function validate()
    {
        if (!($this->getId())){
            $this->validate_required('name','Нэрээ оруулна уу');
        }
        $this->validate_required('title', 'Гарчиг оруулна уу');
        $this->validate_required('question', 'Асуулт оруулна уу');

        return count($this->_errors) > 0;
    }

    public function save()
    {
        $question = new Question();
        $question->setName($this->getName())
                 ->setTitle($this->getTitle())
                 ->setQuestion($this->getQuestion())
                 ->setId($this->getId());
        $question->save();
    }
}


class AnswerForm extends BaseForm
{
    protected $_fields = array('name', 'answer', 'question_id'); //TODO

    public function validate()
    {
        $this->validate_required('name', 'Өөрийн нэрээ оруулна уу');
        $this->validate_required('answer', 'Хариултаа оруулна уу');

        return count($this->_errors) > 0;
    }

    public function save()
    {
        $answer = new Answer();
        $answer->setName($this->getName());
        $answer->setAnswer($this->getAnswer())
               ->setQuestionId($this->getQuestion_id());
        $answer->save();
    }
}
?>
