<?php
require_once 'Model/ProductModel.php';
class ProductController extends BaseController
{
    private $table = 'products';
    private $model = 'ProductModel';

    public function index()
    {
        $href = 'index.php?controller=ProductController&action=index&page=';
        $productInfor = $this->indexBase($this->table, $this->model, $href);
        $thead = $this->getThead('asc','sort');
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'],
            'thead' => $thead]);
    }

    public function viewAddProduct()
    {
        $view = 'add-product';
        $this->viewAdd($view);
    }


    public function addProduct()
    {
        $validate = new Validation();
        $error = $validate->checkValue();
        if (!$error) {
            $infor['name'] = $_POST['name'];
            $infor['description'] = $_POST['description'];
            $infor['price'] = $_POST['price'];
            $infor['activate'] = $_POST['activate'];
            $infor['image'] = $_POST['name'];
            $data['image_tmp'] = $_FILES['product']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $data['pre'] = 'product_';
            $this->add($data,$infor);
            header('Location: index.php?controller=ProductController&action=index&page=1');
        }
        $this->view(['name' => 'add-product',
            'error' => $error]);
    }


    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model,'id');
        }
        header('Location:index.php?controller=ProductController&action=index&page=1');
    }

    public function editProduct()
    {
        $old = $this->viewEdit($this->table, $this->model, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validate = new Validation();
            $error = $validate->checkValue();
            if (!$error) {
                $infor['name'] = $_POST['name'];
                $infor['price'] = $_POST['price'];
                $infor['description'] = $_POST['description'];
                $infor['activate'] = $_POST['activate'];
                date_default_timezone_set('Asia/BangKok');
                $infor['time_update'] = date('y-m-d H:i:s');
                $infor['image'] = 'product_' . $_POST['name'];
                $data['old_image'] = $old['image'];
                $data['table'] = $this->table;
                $data['model'] = $this->model;
                $this->edit($infor, $data);
                header('Location:index.php?controller=ProductController&action=index&page=1');
            }
            else{
                $this->view(['name' => 'edit-product',
                    'infor' => $old,
                    'error' => $error]);
            }
        }
        $this->view(['name' => 'edit-product',
            'infor' => $old]);
    }

    public function searchProduct()
    {
        $search = $_GET['search'];
        $order = $_GET['order'];
        $href = "index.php?controller=ProductController&action=searchProduct&search=$search&order=$order&page=";
        $condition = 'name';
        $productInfor = $this->searchLimit($this->table,$this->model,'name',$href,$order,$condition);
        if(isset($_GET['sort'])){
            $condition = $_GET['sort'];
            $productInfor = $this->searchLimit($this->table, $this->model,'name', $href,$order,$condition);
        }
        $thead = $this->getThead('asc','searchProduct');
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'],
            'thead' => $thead]);
    }

    public function sort()
    {
        $productInfor = array();
        $condition = $_GET['sort'];
        $order = $_GET['order'];
        $href = "index.php?controller=ProductController&action=sort&sort=$condition&order=$order&page=";
        $thead = $this->getThead($order,'sort');
        $productInfor = $this->sortLimit($this->model,$this->table,$condition,$order,$href);
        $this->view(['name' => 'list-products',
            'listProduct' => $productInfor['infor'],
            'link' => $productInfor['link'],
            'thead' => $thead,
        ]);
    }

    public function getThead($order,$action)
    {
        if(!isset($_GET['order']) || $_GET['order']=='desc'){
            $order = 'asc';
            $class = 'sorting_desc';
        } else if($_GET['order']=='asc' ||$_GET['order']!=$order){
            $order = 'desc';
            $class = 'sorting_asc';
        }
        if(!isset($_GET['search'])){
            $search = '';
        }else $search = '&search='.$_GET['search'];
        $thead ="<th width='10%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=id$search&order=$order&page=1'>ID</a>
                            </th>
                           <th width='30%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=name$search&order=$order&page=1'>Product Name</a>
                            </th>
                             <th width='15%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=name$search&order=$order&page=1'>Price</a>
                            </th>
                            <th width='15%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=activate$search&order=$order&page=1'>Activate</a>
                            </th>
                            <th width='10%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=time_create$search&order=$order&page=1'>Time Created</a>
                            </th>
                            <th width='10%' class='$class'>
                                <a href='index.php?controller=ProductController&action=$action&sort=time_update$search&order=$order&page=1'>Time Updated</a>
                            </th>
                            <th width='10%'>Action</th>";
        return $thead;
    }
}
