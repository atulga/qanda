<?php
class Paginator
{
    public $model_name;
    public $current_page;
    public $one_page_per;
    public $pages = array();

    public function __construct($model_name, $current_page = 1, $one_page_per=5)
    {
        $this->model_name = $model_name;
        $this->current_page = $current_page;
        $this->one_page_per = $one_page_per;

        global $em;
        $result = $em->getRepository($this->model_name)
            ->findAll();
        $count = count($result);

        $total_page = ceil($count / $this->one_page_per);
        for ($i = 0; $i < $total_page; $i++){
            $this->pages[$i] = $i+1;
        }
    }

    public function fetch()
    {
        global $em;
        $filter = array();
        $order = array('createdDate' => 'DESC');
        $offset = ($this->current_page -1) * $this->one_page_per;
        $questions = $em->getRepository($this->model_name)
            ->findBy($filter, $order, $this->one_page_per, $offset);
        return $questions;
    }

}

function logged_in()
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
