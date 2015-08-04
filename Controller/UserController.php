<?php
require_once 'Model/UserModel.php';
class UserController extends BaseController
{
    private $table = 'users';
    private $model = 'UserModel';

    public function index()
    {
        $href = 'index.php?controller=UserController&action=index&page=';
        $userInfor = $this->indexBase($this->table, $this->model, $href);
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link']]);
    }

    public function viewAddUser()
    {
        $view = 'add-user';
        $this->viewAdd($view);
    }


    public function addUser()
    {
        $infor['name'] = $_POST['name'];
        $infor['password'] = $_POST['password'];
        $infor['email'] = $_POST['email'];
        $infor['activate'] = $_POST['activate'];
        $infor['image'] = $_POST['name'];
        $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
        $data['table'] = $this->table;
        $data['model'] = $this->model;
        $data['pre'] = 'avatar_';
        $this->add($data, $infor);
        header('Location: index.php?controller=UserController&action=index&page=1');
    }

    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model);
        }
        header('Location:index.php?controller=UserController&action=index&page=1');
    }

    public function editUser()
    {
        $old = $this->viewEdit($this->table, $this->model, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $infor['name'] = $_POST['name'];
            $infor['email'] = $_POST['email'];
            $infor['password'] = $_POST['password'];
            $infor['activate'] = $_POST['activate'];
            date_default_timezone_set('Asia/BangKok');
            $infor['time_update'] = date('y-m-d H:i:s');
            $infor['image'] = 'avatar_' . $_POST['name'];
            $data['old_image'] = $old['image'];
            $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $this->edit($infor, $data);
            header('Location:index.php?controller=UserController&action=index&page=1');
        }
        $this->view(['name' => 'edit-user',
            'infor' => $old]);
    }

    public function searchUser()
    {
        $search = $_GET['search'];
        $href = "index.php?controller=UserController&action=searchUser&search=$search&page=";
        $userInfor = $this->searchLimit($this->table, $this->model, 'name', $href);
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link']]);
    }


    public function sort()
    {
        $userInfor = array();
        $condition = $_GET['sort'];
        $order = $_GET['order'];
        $href = "index.php?controller=UserController&action=sort&sort=$condition&order=$order&page=";
        $userInfor = $this->sortLimit($this->model, $this->table, $condition, $order, $href);
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link']]);
    }
}

