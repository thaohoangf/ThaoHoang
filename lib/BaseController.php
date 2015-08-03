<?php
session_start();
define('PER_PAGE',3);
class BaseController{

    public function view($data = array()){
//        var_dump($data);
        extract($data);
        return require_once ('View/'.$name.'.php');
    }

    public function indexBase($table,$model,$href)
    {
            $data = array();
            $model = new $model();
            $currentPage = $_GET['page'];
            $totalRecord = $model->countAll($table);
            $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
            $offset = $pagination->getOffset();
            $link = $pagination->paginationPanel($href);
            $data['infor'] = $model->getLimit($table,$offset,PER_PAGE);
            $data['link'] = $link;
            return $data;
    }

    public function viewAdd($view)
    {
        $this->view(['name' => $view]);
    }

    public function add($data = array(),$infor = array())
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
//            var_dump($_POST);
            if (isset($_POST['create'])) {
                $model = new $data['model'];
                $infor['image'] = $data['pre'] . $infor['name'];
                $model->insert($data['table'], $infor);
                move_uploaded_file($data['image_tmp'],'upload/'.$infor['image'] .'.jpg');
            }
        }
    }

    public function handleBase($table,$model)
    {
        $model = new $model;
        $condition = $_POST['checkbox'];
        if (isset($_POST['delete'])) {
            foreach ($condition as $id) {
                $model->delete($table,$id);
            }
        } else
            if (isset($_POST['activate'])) {
                foreach ($condition as $id) {
                    $model->activate($table,$id);
                }
            }
    }

    public function viewEdit($table,$model,$select)
    {
        $model = new $model($table);
        $oldInfor = '';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $model->getBy($table,$select,'id',$id);
            $oldInfor = $result->fetch_assoc();
        }
        return $oldInfor;
    }


    public function searchLimit($table,$model,$column, $href)
    {
        $condition = $_GET['search'];
        $currentPage = $_GET['page'];
        $record = new $model;
        $totalRecord = $record->countSearch($table,$column,$condition);
        $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
        $offset = $pagination->getOffset();
        $data['infor'] = $record->searchLimit($table,$column,$condition,$offset,PER_PAGE);
        $data['link'] = $pagination->paginationPanel($href);
        return $data;
    }


    public function edit($infor=array(),$data = array())
    {
        $model = new $data['model'];
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['update'])) {
                $_SESSION['username'] = $infor['name'];
                if($_FILES['avatar']['name']) {
                    if (file_exists('upload/avatar_' . $infor['name'] . '.jpg')) {
                        unlink('upload/avatar_' . $infor['name'] . '.jpg');
                    }move_uploaded_file($data['image_tmp'], 'upload/avatar_' . $infor['name'] . '.jpg');
                }else rename('upload/'.$data['old_image'] . '.jpg','upload/avatar_'.$infor['name'] . '.jpg');

                $model->update($data['table'],$infor,$id);
            }
        }
    }

    public function sortLimit($model,$table,$condition,$order,$href)
    {
        $data = array();
        $model = new $model;
        $currentPage = $_GET['page'];
        $totalRecord = $model->countAll($table);
        $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
        $link = $pagination->paginationPanel($href);
        $offset = $pagination->getOffset();
        $data['infor'] = $model->sortBy($table,$condition,$order,$offset,PER_PAGE);
        $data['link'] = $link;
        return $data;
    }
}