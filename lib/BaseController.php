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
            if (isset($_POST['create'])) {
                $model = new $data['model'];
                $total = $model->countAll($data['table']);
                if($total % PER_PAGE == 0){
                    $page = ceil($total/PER_PAGE) + 1;
                }else $page = ceil($total/PER_PAGE);
                if(isset($infor['image'])) {
                    $infor['image'] = $data['pre'] . $infor['name'];
                    move_uploaded_file($data['image_tmp'], 'upload/' . $infor['image'] . '.jpg');
                }
                $model->insert($data['table'], $infor);

            }
        }
        return $page;
    }

    public function handleBase($table,$model,$column)
    {
        $model = new $model;
        $condition = $_POST['checkbox'];
        if (isset($_POST['delete'])) {
            foreach ($condition as $id) {
                $image = $model->getBy($table,'image',$column,$id);
                $image_name = $image->fetch_assoc();
                if(file_exists('upload/'.$image_name['image'].'.jpg')){
                    echo 'Thao';
                    unlink('upload/'.$image_name['image'].'.jpg');
                }
                $model->delete($table,$id);
            }
        } else
            if (isset($_POST['activate'])) {
                foreach ($condition as $id) {
                    $model->activate($table,$id);
                }
            }

    }

    public function getOldEdit($table,$model,$select)
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


    public function searchLimit($table,$model,$column, $href,$order,$condition)
    {
        $search = $_GET['search'];
        $currentPage = $_GET['page'];
        $record = new $model;
        $totalRecord = $record->countSearch($table,$column,$search);
        $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
        $offset = $pagination->getOffset();
        $data['infor'] = $record->searchLimit($table,$column,$search,$condition,$order,$offset,PER_PAGE);
        $data['link'] = $pagination->paginationPanel($href);
        return $data;
    }


    public function edit($infor=array(),$data = array())
    {
        $model = new $data['model'];
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['update'])) {
                if(isset($infor['image'])) {
                    if ($_FILES['picture']['name']) {
                        if (file_exists('upload/' . $infor['image'] . '.jpg')) {
                            unlink('upload/' . $infor['image'] . '.jpg');
                        }
                        move_uploaded_file($_FILES['picture']['tmp_name'], 'upload/' . $infor['image'] . '.jpg');
                    } else rename('upload/' . $data['old_image'] . '.jpg', 'upload/' . $infor['image'] . '.jpg');
                }
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


    public function sortFilterLimit($model, $table, $condition, $order, $href, $value,$column)
    {
        //$column = 'category_id
        //$condition = ''
//        echo $table;
//        var_dump($value);
//        var_dump($condition);
        $data = array();
        $model = new $model;
        $currentPage = $_GET['page'];
        $totalRecord = $model->countAllFilter($table,$column,$value);
        $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
        $link = $pagination->paginationPanel($href);
        $offset = $pagination->getOffset();
        $data['infor'] = $model->sortByFilter($table,$condition,$order,$offset,PER_PAGE,$value,'category_id');
        $data['link'] = $link;
        return $data;
    }
//    public function sortFilterLimit($model, $table, $condition, $order, $href, $value)
//    {
//        $data = array();
//        $model = new $model;
//        $currentPage = $_GET['page'];
//        $totalRecord = $model->countFilter($table);
//        $pagination = new Pagination($totalRecord,PER_PAGE,$currentPage,$href);
//        $link = $pagination->paginationPanel($href);
//        $offset = $pagination->getOffset();
//        $data['infor'] = $model->sortBy($table,$condition,$order,$offset,PER_PAGE);
//        $data['link'] = $link;
//        return $data;
//    }
}