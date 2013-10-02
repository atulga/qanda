<?php
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

function logid_in()
{
    return isset($_SESSION['id']);
}

function has_get($name)
{
    return isset($_GET[$name]);
}

function has_post($param_name)
{
    return isset($_POST[$param_name]);
}

function get_param($name)
{
    return $_GET[$name];
}

function post_param($name)
{
    return $_POST[$name];
}

function uri_is($u)
{
    global $uri_filtered;
    $u = '/qanda/index.php'.$u;
    return $u == $uri_filtered;
}

function redirect($uri)
{
    header('Location:'.$uri);
    exit();
}

function camelcase($str)
{
    $str = strtolower($str);
    $str = preg_replace('/[^a-z]+/', ' ', $str);
    $str = ucwords($str);
    $str = preg_replace('/ /', '', $str);
    return $str;
}
?>
