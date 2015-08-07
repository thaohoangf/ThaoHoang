<?php
require_once 'Model/ProductModel.php';
class ProductController extends BaseController
{
    private $table = 'products';
    private $model = 'ProductModel';
    private $rule = array('name' => array('required','min','max','name'),
        'price' => array('price'));


    public function index()
    {
        $model = new Model();
        $category = $model->getAll('categories','*');
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $order = $_GET['order'];
            $href = "index.php?controller=ProductController&action=index&search=$search&order=$order&page=";
            $condition = 'name';
            $productInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            if (isset($_GET['sort'])) {
                $condition = $_GET['sort'];
                $productInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            }
        } elseif (isset($_GET['sort'])) {
            $condition = $_GET['sort'];
            $order = $_GET['order'];
            $category_id = $_GET['categoryId'];
            if(isset($_GET['categoryId'])){
                $href = "index.php?controller=ProductController&action=index&sort=$condition&order=$order&categoryId=$category_id&page=";
            }
            $href = "index.php?controller=ProductController&action=index&sort=$condition&order=$order&page=";
            $productInfor = $this->sortLimit($this->model, $this->table, $condition, $order, $href);
        }elseif(isset($_POST['delete']) || isset($_POST['activate'])){
            $this->handle();
        }

        else {
            $model = new Model();
            $category = $model->getAll('categories','*');
            $href = 'index.php?controller=ProductController&action=index&page=';
            $productInfor = $this->indexBase($this->table, $this->model, $href);
        }
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'],
            'category' => $category]);
    }


    public function viewAddProduct()
    {
        $model = new Model();
        $category = $model->getAll('categories','*');
        $this->view(['name' => 'add-product',
                    'category' => $category]);
    }


    public function addProduct()
    {
        $validate = new Validation($this->rule);
        $error = $validate->checkValue();
        $infor['name'] = $_POST['name'];
        $infor['description'] = $_POST['description'];
        $infor['price'] = $_POST['price'];
        $infor['activate'] = $_POST['activate'];
        $infor['image'] = $_POST['name'];
        $infor['category_id'] = $_POST['category'];
        if (!$error) {
            $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $data['pre'] = 'product_';
            $page = $this->add($data, $infor);
            header('Location: index.php?controller=ProductController&action=index&page=' . $page);
            exit;
        }
        $this->view(['name' => 'add-product',
            'infor' => $infor,
            'error' => $error]);
    }

    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model, 'id');
        }
        header('Location:index.php?controller=ProductController&action=index&page='.$_SESSION['page']);
        exit;
    }

    public function editProduct()
    {
        $old = $this->getOldEdit($this->table, $this->model, '*');
        $model = new Model();
        $category = $model->getAll('categories', '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validate = new Validation($this->rule);
            $error = $validate->checkValue();
            $infor['name'] = $_POST['name'];
            $infor['price'] = $_POST['price'];
            $infor['description'] = $_POST['description'];
            if (!$error) {
                $infor['activate'] = $_POST['activate'];
                $infor['category_id'] = $_POST['category'];
                date_default_timezone_set('Asia/BangKok');
                $infor['time_update'] = date('y-m-d H:i:s');
                $infor['image'] = 'product_' . $_POST['name'];
                $data['old_image'] = $old['image'];
                $data['table'] = $this->table;
                $data['model'] = $this->model;
                $this->edit($infor, $data);
                header('Location:index.php?controller=ProductController&action=index&page=' . $_SESSION['page']);
                exit;
            } else {
                $infor['image'] = $old['image'];
                $this->view(['name' => 'edit-product',
                    'infor' => $infor,
                    'error' => $error,
                    'category' => $category
                ]);
            }
        }
        $this->view([
            'name' => 'edit-product',
            'infor' => $old,
            'category' => $category
        ]);
    }
}
