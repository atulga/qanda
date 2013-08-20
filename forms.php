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
            $fname = 'get'.camelcase($field);
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
        $fname = 'get'.camelcase($field);
        if (!(strlen($this->$fname()) > 0)){
            $this->_errors[$field] = $message;
        }
    }
}


class RegisterForm extends BaseForm
{
    protected $_fields = array('name', 'password', 'password_again');

    public function validate()
    {
        $this->validate_required('name', 'Нэрээ оруулна уу!');
        $this->validate_required('password', 'Нууц үгээ оруулна уу!');
        if ($this->getPasswordAgain()){
            $this->validate_required('password_again', 'Нууц үгээ давтаж оруулна уу!');
            if ($this->getPassword() && $this->getPasswordAgain()){
                if ($this->getPassword() != $this->getPasswordAgain()){
                    $this->_errors['password_again'] = 'Нууц үгээ ижил оруулна уу';
                }
            }
        }
        return count($this->_errors) > 0;
    }

    public function save()
    {
        $user = new User();
        $user->setName($this->getName());
        $user->setPassword($this->getPassword());
        $user->save();
    }

    public function checkUser()
    {
        $user = new User();
        $user = User::getUser($this->getName(), $this->getPassword());
        if ($user->getName() != $this->getName()){
            $this->errors['password'] = 'Нэр, нууц үг буруу байна';
        }
    }
}


class QuestionForm extends BaseForm
{
    protected $_fields = array('title', 'question', 'id');

    public function validate()
    {
        $this->validate_required('title', 'Гарчиг оруулна уу');
        $this->validate_required('question', 'Асуулт оруулна уу');

        return count($this->_errors) > 0;
    }

    public function save()
    {
        $question = new Question();
        $question->setId($this->getId());
        $question->setName($this->getName());
        $question->setTitle($this->getTitle());
        $question->setQuestion($this->getQuestion());
        $question->save();
    }
}


class AnswerForm extends BaseForm
{
    protected $_fields = array('name', 'answer', 'question_id');

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
        $answer->setAnswer($this->getAnswer());
        $answer->setQuestionId($this->getQuestionId());
        $answer->save();

        $question = Question::getById($this->getQuestionId());
        $question->updateAnswerCount($this->getQuestionId());
        $question->save();
    }
}
?>
