<?php
require_once 'Model/UserModel.php';
class UserController extends BaseController
{
    private $table = 'users';
    private $model = 'UserModel';
    private $controller = 'UserController';
    private $rule = array(
        'name' => array('required','min','max','name'),
        'password'=> array('required','min','max','password'),
        'email' => array('email')
    );

    public function index()
    {
        $list = array('id', 'name', 'activate', 'time created', 'time updated');
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $order = $_GET['order'];
            $href = "index.php?controller=UserController&action=index&search=$search&order=$order&page=";
            $condition = 'name';
            $userInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            if (isset($_GET['sort'])) {
                $condition = $_GET['sort'];
                $userInfor = $this->searchLimit($this->table, $this->model, 'name', $href, $order, $condition);
            }
        } elseif (isset($_GET['sort'])) {
            $condition = $_GET['sort'];
            $order = $_GET['order'];
            $href = "index.php?controller=UserController&action=index&sort=$condition&order=$order&page=";
            $userInfor = $this->sortLimit($this->model, $this->table, $condition, $order, $href);
        }elseif(isset($_POST['delete']) || isset($_POST['activate'])){
            $this->handle();
        }

        else {
            $href = 'index.php?controller=UserController&action=index&page=';
            $userInfor = $this->indexBase($this->table, $this->model, $href);
        }
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
        $validate = new Validation($this->rule);
        $error = $validate->checkValue();
        $infor['name'] = $_POST['name'];
        $infor['password'] = $_POST['password'];
        $infor['email'] = $_POST['email'];
        $infor['activate'] = $_POST['activate'];
        $infor['image'] = $_POST['name'];
        if (!$error) {
            $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $data['pre'] = 'avatar_';
            $page = $this->add($data, $infor);
            header('Location: index.php?controller=UserController&action=index&page=' . $page);
            exit;
        }
        $this->view(['name' => 'add-user',
            'infor' => $infor,
            'error' => $error]);
    }

    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model, 'id');
        }
        header('Location:index.php?controller=UserController&action=index&page='.$_SESSION['page']);
        exit;
    }

    public function editUser()
    {
        $old = $this->getOldEdit($this->table, $this->model, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validate = new Validation($this->rule);
            $error = $validate->checkValue();
            $infor['name'] = $_POST['name'];
            $infor['email'] = $_POST['email'];
            $infor['password'] = $_POST['password'];
            if (!$error) {
                $infor['activate'] = $_POST['activate'];
                date_default_timezone_set('Asia/BangKok');
                $infor['time_update'] = date('y-m-d H:i:s');
                $infor['image'] = 'avatar_' . $_POST['name'];
                $data['old_image'] = $old['image'];
                $data['table'] = $this->table;
                $data['model'] = $this->model;
                if ($_SESSION['username'] == $old['name']) {
                    $_SESSION['username'] = $_POST['name'];
                }
                $this->edit($infor, $data);
                header('Location:index.php?controller=UserController&action=index&page='.$_SESSION['page']);
                exit;
            } else {
                $infor['image'] = $old['image'];
                $this->view(['name' => 'edit-user',
                    'infor' => $infor,
                    'error' => $error
                ]);
            }
        }
        $this->view(['name' => 'edit-user',
            'infor' => $old]);
    }
}
