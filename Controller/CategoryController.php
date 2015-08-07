<?php
require_once 'Model/CategoryModel.php';
/**
 * Created by PhpStorm.
 * User: Thao
 * Date: 8/6/2015
 * Time: 18:35
 */
class CategoryController extends BaseController
{
    private $table = 'categories';
    private $model = 'CategoryModel';
    private $rule = array('name' => array('required','min','max','name'),
        'price' => array('price'));


    public function index()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $order = $_GET['order'];
            $href = "index.php?controller=CategoryController&action=index&search=$search&order=$order&page=";
            $condition = 'name';
            $categoryInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            if (isset($_GET['sort'])) {
                $condition = $_GET['sort'];
                $categoryInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            }
        } elseif (isset($_GET['sort'])) {
            $condition = $_GET['sort'];
            $order = $_GET['order'];
            $href = "index.php?controller=CategoryController&action=index&sort=$condition&order=$order&page=";
            $categoryInfor = $this->sortLimit($this->model, $this->table, $condition, $order, $href);
        }elseif(isset($_POST['delete']) || isset($_POST['activate'])){
            $this->handle();
        }

        else {
            $href = 'index.php?controller=CategoryController&action=index&page=';
            $categoryInfor = $this->indexBase($this->table, $this->model, $href);
        }
        $this->view(['name' => 'list-categories',
            'listCategory' => $categoryInfor['infor'],
            'link' => $categoryInfor['link']]);
    }


    public function viewAddCategory()
    {
        $view = 'add-category';
        $this->viewAdd($view);
    }


    public function addCategory()
    {
        $validate = new Validation($this->rule);
        $error = $validate->checkValue();
        $infor['name'] = $_POST['name'];
        $infor['activate'] = $_POST['activate'];
        $data['table'] = $this->table;
        $data['model'] = $this->model;
        $page = $this->add($data, $infor);
        header('Location: index.php?controller=CategoryController&action=index&page=' . $page);
    }

    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model, 'id');
        }
        header('Location:index.php?controller=CategoryController&action=index&page='.$_SESSION['page']);
        exit;
    }

    public function editCategory()
    {
        $old = $this->getOldEdit($this->table, $this->model, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $infor['name'] = $_POST['name'];
            $infor['activate'] = $_POST['activate'];
            date_default_timezone_set('Asia/BangKok');
            $infor['time_update'] = date('y-m-d H:i:s');
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $this->edit($infor, $data);
            header('Location:index.php?controller=CategoryController&action=index&page='.$_SESSION['page']);
        }
        $this->view(['name' => 'edit-category',
            'infor' => $old]);
    }


}