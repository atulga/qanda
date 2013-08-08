<?php

function open_database_connection()
{
    $link = mysql_connect('localhost', 'root', '');
    mysql_select_db('qanda_db', $link);
    return $link;
}

function close_database_connection($link)
{
    mysql_close($link);
}

function get_answers_by_question($question_id)
{
    $link = open_database_connection();
    $question_id = mysql_escape_string($question_id);
    $query = "SELECT * FROM hariult WHERE asuult_id = '$question_id'
              ORDER BY best DESC";
    $result = mysql_query($query);
    $answers = array();
    while($row = mysql_fetch_assoc($result)){
        $answers[] = $row;
    }
    close_database_connection($link);
    return $answers;
}

function get_question_by_id($question_id)
{
    $link = open_database_connection();
    $question_id = mysql_escape_string($question_id);
    $question_id = intval($question_id);
    $query = 'SELECT * FROM asuult WHERE id = '.$question_id;
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    close_database_connection($link);
    return $row;
}

function set_best_answer($question_id, $answer_id)
{
    $link = open_database_connection();
    $question_id = mysql_escape_string($question_id);
    $answer_id = mysql_escape_string($answer_id);
    $query = "UPDATE asuult SET result='$answer_id' WHERE id='$question_id'";
    $result = mysql_query($query);
    $query_best_answer = "UPDATE hariult SET best='1' WHERE id='$answer_id'";
    $result = mysql_query($query_best_answer);
    close_database_connection($link);
}


class Model
{
    protected $result;
    protected $id;
    protected $link;
    protected $questions;

    public function connect_to_database()
    {
        $this->link = mysql_connect('localhost', 'root', '');
        mysql_select_db('qanda_db', $this->link);
        return $this;
    }

    public function close_database()
    {
        mysql_close($this->link);
    }

    public function save($sql)
    {
        $this->connect_to_database();
        $result = mysql_query($sql);
        $id = mysql_insert_id();
        $this->close_database();
        return $id;
    }

    public function delete($sql)
    {
        $this->connect_to_database();
        $result = mysql_query($sql);
        $id = mysql_insert_id();
        $this->close_database();
        return $id;
    }

    public function show($sql)
    {
        $this->connect_to_database();
        $result = mysql_query($sql);
        $questions = array();
        while($row = mysql_fetch_assoc($result)){
            $questions[] = $row;
        }
//        var_dump($questions);
//        exit();
        $this->close_database();
        return $questions;
    }

    public function slug($slug_uri)
    {
    }
}


class Question extends Model
{
    protected $id;
    protected $name;
    protected $title;
    protected $question;
    protected $date;
    protected $slug;

    public function getId()
    {
        return $this->id;
    }

    public function setId($v)
    {
        $this->id = mysql_escape_string($v);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($v)
    {
        $this->name = mysql_escape_string($v);
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($v)
    {
        // $this->slug = convert_to_slug($v);  // "Question about books" -> "question-about-books"
        $this->title = mysql_escape_string($v);
        return $this;
    }

    public function getSlug()
    {
        return $this->slug();
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($v)
    {
        $this->question = mysql_escape_string($v);
        return $this;
    }

    public function setQuestions($v)
    {
        $this->questions = $v;
        return $this;
    }
    
    public function getQuestions()
    {
        return $this->questions;
    }
    
    public function save()
    {
        if ($this->getId()){
            $sql = "UPDATE asuult SET question='".$this->getQuestion()."',
                    title='".$this->getTitle()."' WHERE id=".$this->getId();
        } else {
            $sql = "INSERT INTO asuult
                        (id, title, create_date, question, name, result)
                    VALUES (NULL, '".$this->getTitle()."' , '".date("Y-m-d
              H:i:s")."', '".$this->getQuestion()."' , '".$this->getName()."',
                0 )";
        }
        $this->setId(parent::save($sql));
    }

    public function delete()
    {
        $sql = "DELETE FROM hariult WHERE asuult_id=".$this->getId(); // ustgaj baigaa id tai asuultand hargalzah buh hariultiig ustgah
        parent::delete($sql);
        $sql = "DELETE FROM asuult WHERE id=".$this->getId(); //asuult ustgah
        parent::delete($sql);
    }

    public function show_all()
    {
        $sql = "SELECT a.id, a.title, a.create_date, a.question,
                    a.name, a.result, COUNT(h.id) as hariult_count
                FROM asuult a
                LEFT JOIN hariult h
                ON a.id=h.asuult_id
                GROUP BY a.create_date DESC";
        $this->setQuestions(parent::show($sql));
    }

/*  static public function getById($id)
  {
    $question = new Question();
    // get from database by id
    // if no record in database return null
    $question->setId($values['id']);
    $question->setName($values['name']);
    $question->setTitle($values['title']);
    return $question;
  }
 */
}


class Answer extends Model
{
    protected $best = 1;
    protected $id;
    protected $name;
    protected $answer;
    protected $question_id;

    public function setId($v)
    {
        $this->id = $v;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($v)
    {
        $this->name = mysql_escape_string($v);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAnswer($v)
    {
        $this->answer = mysql_escape_string($v);
        return $this;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setQuestionId($v)
    {
        $this->question_id = $v;
        return $this;
    }

    public function getQuestionId()
    {
    return $this->question_id;
    }

/*
    public function getQuestion()
    {
        return Question::getById($this->getQuestionId());
    }
    */
    public function save()
    {
  /*    if ($this->best) {
        $question = $this->getQuestion();
        $question->setResult($this->getId());
        $question->save();
  }*/
        // TODO
        $sql = "INSERT INTO hariult (id, answer, name, create_date, asuult_id, best)
            VALUES (NULL, '".$this->getAnswer()."', '".$this->getName()."',
              '".date("Y-m-d H:i:s")."', '".$this->getQuestionId()."', '0')";
        parent::save($sql);
    }

    public function delete()
    {
        $sql = "DELETE FROM hariult WHERE id=".$this->getId();
        parent::delete($sql);
    }
}
?>

