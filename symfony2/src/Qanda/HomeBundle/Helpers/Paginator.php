<?php

namespace Qanda\HomeBundle\Helpers;

class Paginator
{
    public $model_name;
    public $current_page;
    public $one_page_per;
    public $pages = array();

    public function __construct($em, $model_name, $current_page = 1, $one_page_per=5)
    {
        $this->em = $em;
        $this->model_name = $model_name;
        $this->current_page = $current_page;
        $this->one_page_per = $one_page_per;

        $result = $this->em->getRepository($this->model_name)
            ->findAll();
        $count = count($result);

        $total_page = ceil($count / $this->one_page_per);
        for ($i = 0; $i < $total_page; $i++){
            $this->pages[$i] = $i+1;
        }
    }

    public function fetch()
    {
        $filter = array();
        $order = array('createdDate' => 'DESC');
        if ($this->current_page == null) { 
            $this->current_page = 1;
        }
        $offset = ($this->current_page -1) * $this->one_page_per;
        $questions = $this->em->getRepository($this->model_name)
            ->findBy($filter, $order, $this->one_page_per, $offset);
        return $questions;
    }

}
