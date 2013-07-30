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

function show_all_question()
{
    $link = open_database_connection();
    $result = mysql_query('
        SELECT a.id, a.title, a.createdate, a.question,
            a.name, a.result, COUNT(h.id) as hariult_count
        FROM asuult a
            LEFT JOIN hariult h
            ON a.id=h.asuult_id
        GROUP BY a.createdate DESC', $link);
    $questions=array();
    while($row = mysql_fetch_assoc($result)){
        $questions[] = $row;
    }
    close_database_connection($link);
    return $questions;
}

function show_question_by_id($question_id)
{
    $link = open_database_connection();
    $question_id = intval($question_id);
    $query = 'SELECT * FROM asuult WHERE id = '.$question_id;
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    close_database_connection($link);
    return $row;
}

function get_answers_by_question($question_id)
{
    // TODO $id -> $question_id /hiisen
    // TODO get_answer_all_post -> get_answers_by_question/hiisen
    $link = open_database_connection();
    $sql = 'SELECT * FROM hariult WHERE asuult_id = '.$question_id;
    // TODO asuultid -> asuult_id /hiisen
    $result = mysql_query($sql);
    $answers = array();
    while($row = mysql_fetch_assoc($result)){
        $answers[] = $row;
    }
    close_database_connection($link);
    return $answers;
    
}

function question_add($name, $title, $question)
{
    $link = open_database_connection();
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO asuult
                (id, title, createdate, question, name, result) 
        VALUES (NULL, '$title' , '$date', '$question' , '$name', 0 )";
    $result = mysql_query($sql);
    close_database_connection($link);
}

function edit_question ($question, $r, $question_id)
{
    $link = open_database_connection();
    // TODO max 78 char per line
    /* remove space in line ending: / \+\n  */
    $str = "';DELETE * FROM asuult;'";
    $str = mysql_escape_string($str); // TODO escape string
    // TODO change field names.
    //      mainq -> description
    //      whoask -> name
    //      ...
    // TODO function spacing
    // TODO one naming, not question/asuult/post
    // TODO remove swap files
    // TODO remove unused, unnecessary files
    // TODO add gitignore
    // TODO $questionid -> $question_id
    $sql = "UPDATE asuult SET mainq = '$question', result = '$r' WHERE id = '$questionid'";
    $result = mysql_query($sql);
    close_database_connection($link);
}

function answer_add($name, $answer, $question_id)
{
    $link = open_database_connection();
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO hariult (id, answer, name, createdate, asuult_id)
        VALUES (NULL, '$answer', '$name', '$date', '$question_id')";    mysql_query($sql);
    close_database_connection($link);
}

function delete_answer($answer_id){
    $link = open_database_connection();
    $sql = "DELETE FROM hariult WHERE id='$answer_id'";
    $result = mysql_query($sql);
    close_database_connection($link);
}
