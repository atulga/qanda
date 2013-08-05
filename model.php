<?php

function open_database_connection()
{
    $link=mysql_connect('localhost', 'root', '');
    mysql_select_db('qanda_db', $link);
    return $link;
}

function close_database_connection($link)
{
    mysql_close($link);
}

function show_all_question()
{
    $link=open_database_connection();
    $result=mysql_query('
        SELECT a.id, a.title, a.create_date, a.question,
            a.name, a.result, COUNT(h.id) as hariult_count
        FROM asuult a
            LEFT JOIN hariult h
            ON a.id=h.asuult_id
        GROUP BY a.create_date DESC', $link);
    $questions=array();
    while($row=mysql_fetch_assoc($result)){
        $questions[]=$row;
    }
    close_database_connection($link);
    return $questions;
}

function show_question_by_id($question_id)
{
    $link=open_database_connection();
    $question_id=mysql_escape_string($question_id);
    $question_id=intval($question_id);
    $query='SELECT * FROM asuult WHERE id = '.$question_id;
    $result=mysql_query($query);
    $row=mysql_fetch_assoc($result);
    close_database_connection($link);
    return $row;
}

function get_answers_by_question($question_id)
{
    $link=open_database_connection();
    $question_id=mysql_escape_string($question_id);
    $sql="SELECT * FROM hariult WHERE asuult_id = '$question_id'
          ORDER BY best DESC";
    $result=mysql_query($sql);
    $answers=array();
    while($row=mysql_fetch_assoc($result)){
        $answers[]=$row;
    }
    close_database_connection($link);
    return $answers;
}

function add_question($name, $title, $question)
{
    $link=open_database_connection();
    $title=mysql_escape_string($title);
    $name=mysql_escape_string($name);
    $question=mysql_escape_string($question);
    $date=date("Y-m-d H:i:s");
    $sql="INSERT INTO asuult
                (id, title, create_date, question, name, result)
        VALUES (NULL, '$title' , '$date', '$question' , '$name', 0 )";
    $result=mysql_query($sql);
    close_database_connection($link);
}

function question_update($title, $question, $question_id = null)
{
    $link=open_database_connection();
    $title=mysql_escape_string($title);
    $question=mysql_escape_string($question);
    $query="UPDATE asuult SET question='$question', title='$title'
            WHERE id='$question_id'";
    $result=mysql_query($query);
    close_database_connection($link);
}

function add_answer($name, $answer, $question_id)
{
    $link=open_database_connection();
    $name=mysql_escape_string($name);
    $answer=mysql_escape_string($answer);
    $question_id=mysql_escape_string($question_id);
    $date=date("Y-m-d H:i:s");
    $sql="INSERT INTO hariult (id, answer, name, create_date, asuult_id, best)
            VALUES (NULL, '$answer', '$name', '$date', '$question_id', '0')";
    $result=mysql_query($sql);
    close_database_connection($link);
}

function delete_answer($answer_id){
    $link=open_database_connection();
    $answer_id=mysql_escape_string($answer_id);
    $sql="DELETE FROM hariult WHERE id='$answer_id'";
    $result=mysql_query($sql);
    close_database_connection($link);
}

function delete_answers($question_id){
    $link=open_database_connection();
    $question_id=mysql_escape_string($question_id);
    $sql="DELETE FROM hariult WHERE asuult_id='$question_id'";
    $result=mysql_query($sql);
    close_database_connection($link);
}

function get_question_by_id($question_id)
{
    $link=open_database_connection();
    $question_id=intval($question_id);
    $query='SELECT * FROM asuult WHERE id = '.$question_id;
    $result=mysql_query($query);
    $row=mysql_fetch_assoc($result);
    close_database_connection($link);
    return $row;
}

function set_best_answer($question_id, $answer_id){
    $link=open_database_connection();
    $question_id=mysql_escape_string($question_id);
    $answer_id=mysql_escape_string($answer_id);
    $query="UPDATE asuult SET result='$answer_id'
            WHERE id='$question_id'";
    $result=mysql_query($query);
    $query_best_answer="UPDATE hariult SET best='1' WHERE id='$answer_id'";
    $result=mysql_query($query_best_answer);
    close_database_connection($link);
}

function delete_question($question_id){
    $link=open_database_connection();
    $question_id=mysql_escape_string($question_id);
    $query="DELETE FROM asuult WHERE id='$question_id'";
    $result=mysql_query($query);
    close_database_connection($link);
}
?>
