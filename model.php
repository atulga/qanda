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
function get_all_posts()
{
    $link = open_database_connection();

    $result = mysql_query('SELECT a.id, a.title, a.createdate, a.mainq,
        a.whoask, a.result, COUNT(h.id)
        as hariult_count 
        FROM asuult a
            LEFT JOIN hariult h
            ON a.id=h.asuultid
        GROUP BY a.createdate DESC', $link);
    $posts=array();
    while($row = mysql_fetch_assoc($result)){
        $posts[] = $row;
    }
    close_database_connection($link);

    return $posts;
}

function get_post_by_id($id)
{
    $link = open_database_connection();

    $id = intval($id);
    $query = 'SELECT * FROM asuult WHERE id = '.$id;
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);
    close_database_connection($link);
    return $row;
}

function get_answer_all_post($id)
{
    $link = open_database_connection();
    $sql = 'SELECT * FROM hariult WHERE asuultid = '.$id;
    $result = mysql_query($sql);
    $answerpost = array();
    while($row = mysql_fetch_assoc($result)){
        $answerpost[] = $row;
    }
    close_database_connection($link);
    return $answerpost;
    
}

function set_new_question($name, $title, $question)
{
    $link = open_database_connection();

    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO asuult 
                (id, title, createdate, mainq, whoask, result) 
        VALUES (NULL, '$title' , '$date', '$question' , '$name', 0 )";
    var_dump($sql);
    $result = mysql_query($sql);
    var_dump($result);

    close_database_connection($link);

}

function save_answer($name, $answer, $questionid)
{
    $link = open_database_connection();

    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO hariult (id, answer, whoanswer, answerdate, asuultid)
        VALUES (NULL, '$answer', '$name', '$date', '$questionid')";
    mysql_query($sql);
}

