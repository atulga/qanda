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
            if (isset($values[$field])) {
                $this->_values[$field] = $values[$field];
            }
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

class LoginForm extends BaseForm
{
    protected $_fields = array('name', 'password');

    public function validate()
    {
        $this->validate_required('name', 'Нэрээ оруулна уу!');
        $this->validate_required('password', 'Нууц үгээ оруулна уу!');
        $user = User::getByName($this->getName());
        if($this->getPassword() != $user->getPassword()){
            $this->_errors['password'] = 'Nuuts vg buruu bn';
        }
        return count($this->_errors) > 0;
    }
}

class RegisterForm extends BaseForm
{
    protected $_fields = array('name', 'password', 'password_again');

    public function validate()
    {
        $this->validate_required('name', 'Нэрээ оруулна уу!');
        $this->validate_required('password', 'Нууц үгээ оруулна уу!');
        $this->validate_required('password_again', 'Нууц үгээ давтаж оруулна уу!');
        if ($this->getPassword() != $this->getPasswordAgain()){
            $this->_errors['password'] = 'Нууц үгээ ижил оруулна уу';
            $this->_errors['password_again'] = 'Нууц үгээ ижил оруулна уу';
        }
        $user = User::getByName($this->getName());
        if ($user){
            if ($user->getName() == $this->getName()){
                $this->_errors['name'] = 'Хэрэглэгчийн нэр давхардсан байна';
            }
        }
        return count($this->_errors) > 0;
    }

    public function save()
    {
        global $em;
        $user = new User();
        $user->setName($this->getName());
        $user->setPassword($this->getPassword());
        $em->persist($user);
        $em->flush();
    }
}

class QuestionForm extends BaseForm
{
    protected $_fields = array('title', 'question', 'id', 'user_id');

    public function validate()
    {
        $this->validate_required('title', 'Гарчиг оруулна уу');
        $this->validate_required('question', 'Асуулт оруулна уу');
        return count($this->_errors) > 0;
    }

    public function save()
    {
        global $em;
        if ($this->getId()) {  //update
            $question = Asuult::getById($this->getId());
        } else {  //add
            $question = new Asuult();
            $question->setUserId($_SESSION['id']);
            $question->setCreatedDate(date_create(date('Y-m-d H:i:s')));
        }

        $question->setTitle($this->getTitle());
        $question->setQuestion($this->getQuestion());
        $em->persist($question);
        $em->flush();
    }
}

class AnswerForm extends BaseForm
{
    protected $_fields = array('answer', 'question_id');

    public function validate()
    {
        $this->validate_required('answer', 'Хариултаа оруулна уу');
        return count($this->_errors) > 0;
    }

    public function save()
    {
        global $em;
        $answer = Hariult::getById($this->getId());
        if (!$answer){
            $answer = new Hariult();
        }
        $answer->setUserId($_SESSION['id']);
        $answer->setAnswer($this->getAnswer());
        $answer->setQuestionId($this->getQuestionId());
        $answer->setCreatedDate(date_create(date('Y-m-d H:i:s')));
        $em->persist($answer);
        $em->flush();
        $question = Asuult::getById($this->getQuestionId());
        $question->setAnswerCount($question->updateAnswerCount($this->getQuestion));
        $em->persist($question);
        $em->flush();
    }
}

class ProfileForm extends BaseForm{

    protected $_fields = array('nickname', 'description', 'id');
    public function validate()
    {
        $this->validate_required('nickname', 'Please enter your name');
        $this->validate_required('description', 'Please enter your description');
        return count($this->_errors) > 0;
    }

    public function save()
    {
        if ($this->getId()) {
          $profile = User::getById($this->getId());
          $profile->setNickname($this->getNickname());
          $profile->setDescription($this->getDescription());
          $profile->save();
        }
    }
}

?>
