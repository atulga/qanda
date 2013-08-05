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
        foreach ($this->_fields as $field) {
            $this->_values[$field] = $values[$field];
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
}


class QuestionForm extends BaseForm
{
    protected $_fields = array(
        'name', 'title', 'question',
    );

    /**
     * Returns boolean if it has error
     */
    public function validate()
    {
        if (!(strlen($this->getName()) > 0)){
            $this->_errors['name'] = 'Өөрийн нэрээ оруулна уу';
        }
        if (!(strlen($this->getTitle()) > 0)){
            $this->_errors['title'] = 'Асуултын гарчиг оруулна уу';
        }
        if (!(strlen($this->getQuestion()) > 0)){
            $this->_errors['question'] = 'Асуулт оруулна уу';
        }
        return count($this->_errors) > 0;
    }

    public function save()
    {
        add_question($this->getName(), $this->getTitle(),
                     $this->getQuestion());
    }
}


class AnswerForm extends BaseForm
{
    protected $_fields = array(
        'name', 'answer', 'id'
    );

    public function validate()
    {
        if (!(strlen($this->name) > 0)){
            $this->_errors['name'] = 'Өөрийн нэрээ оруулна уу';
        }
        if (!(strlen($this->answer) > 0)){
            $this->_errors['answer'] = 'Хариултаа оруулна уу';
        }
        return count($this->_errors) > 0;
    }

    public function save()
    {
        add_answer($this->name, $this->answer, $this->id);
    }
}


class QuestionEditForm extends BaseForm
{
    protected $_fields = array(
        'title', 'question', 'id'
    );

    public function validate()
    {
         if (!(strlen($this->title) > 0)){
            $this->_errors['title'] = 'Асуултын гарчиг оруулна уу';
        }
        if (!(strlen($this->question) > 0)){
            $this->_errors['question'] = 'Асуулт оруулна уу';
        }
        return count($this->_errors) > 0;
    }

    public function save()
    {
        question_update($this->title, $this->question, $this->id);
    }
}
?>
