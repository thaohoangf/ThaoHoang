<?php
require 'Model/ProductModel.php';

class ProductController extends BaseController
{
    private $table = 'products';
    private $model = 'ProductModel';

    public function index()
    {
        $href = 'index.php?controller=ProductController&action=index&page=';
        $productInfor = $this->indexBase($this->table,$this->model,$href);
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'] ]);
    }

    public function viewAddProduct()
    {
        $view = 'add-product';
        $this->viewAdd($view);
    }


    public function addProduct()
    {
        $infor['name'] = $_POST['name'];
        $infor['price'] = $_POST['price'];
        $infor['description'] = $_POST['description'];
        $infor['activate'] = $_POST['activate'];
        $infor['image']= $_POST['name'];
        $data['image_tmp'] = $_FILES['product']['tmp_name'];
        $data['table'] = $this->table;
        $data['model'] = $this->model;
        $data['pre'] = 'product_';
        $this->add($data,$infor);
        header('Location: index.php?controller=ProductController&action=index&page=1');
    }

    public function handle()
    {
        if(isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model);
        }
        header('Location:index.php?controller=ProductController&action=index&page=1');
    }

    public function editproduct()
    {
        $old = $this->viewEdit($this->table,$this->model,'*');
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $infor['name'] = $_POST['name'];
            $infor['description'] = $_POST['description'];
            $infor['price'] = $_POST['price'];
            $infor['activate'] = $_POST['activate'];
            date_default_timezone_set('Asia/BangKok');
            $infor['time_update'] = date('y-m-d H:i:s');
            $infor['image'] = 'avatar_' . $_POST['name'];
            $data['old_image'] = $old['image'];
            $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $this->edit($infor, $data);
            header('Location:index.php?controller=ProductController&action=index&page=1');
        }
        $this->view(['name' => 'edit-product',
            'infor' => $old]);
    }

    public function searchProduct()
    {
        $search = $_GET['search'];
        $href = "index.php?controller=ProductController&action=searchpPoduct&search=$search&page=";
        $productInfor = $this->searchLimit($this->table,$this->model,'name',$href);
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'] ]);
    }





    public function sortId()
    {
        $productInfor = array();
        if($_GET['order'] == 'asc') {
            $href = 'index.php?controller=ProductController&action=sortId&order=asc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'id','asc',$href);
        }
        if($_GET['order'] == 'desc') {
            $href = 'index.php?controller=ProductController&action=sortId&order=desc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'id','desc',$href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link']]);
    }


    public function sortProductName()
    {
        $productInfor = array();
        if($_GET['order'] == 'asc') {
            $href = 'index.php?controller=ProductController&action=sortProductName&order=asc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'name','asc',$href);

        }
        if($_GET['order'] == 'desc') {
            $href = 'index.php?controller=ProductController&action=sortProductName&order=desc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'name','desc',$href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link']]);
    }


    public function sortActivate()
    {
        $productInfor = array();
        if($_GET['order'] == 'asc') {
            $href = 'index.php?controller=ProductController&action=sortActivate&order=asc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'activate','asc',$href);

        }
        if($_GET['order'] == 'desc') {
            $href = 'index.php?controller=ProductController&action=sortActivate&order=desc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'activate','desc',$href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link']]);
    }

    public function sortTimeCreate()
    {
        $productInfor = array();
        if($_GET['order'] == 'asc') {
            $href = 'index.php?controller=ProductController&action=sortTimeCreate&order=asc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'time_create','asc',$href);

        }
        if($_GET['order'] == 'desc') {
            $href = 'index.php?controller=ProductController&action=sortTimeCreate&order=desc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'time_update','desc',$href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link']]);
    }

    public function sortTimeUpdate()
    {
        $productInfor = array();
        if($_GET['order'] == 'asc') {
            $href = 'index.php?controller=ProductController&action=sortTimeUpdate&order=asc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'time_update','asc',$href);

        }
        if($_GET['order'] == 'desc') {
            $href = 'index.php?controller=ProductController&action=sortTimeUpdate&order=desc&page=';
            $productInfor = $this->sortLimit($this->model,$this->table,'time_update','desc',$href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link']]);
    }
}