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
        $thead = $this->getThead('asc','sort');
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link'],
            'thead' => $thead]);
    }

    public function viewAddUser()
    {
        $view = 'add-user';
        $this->viewAdd($view);
    }


    public function addUser()
    {
        $validate = new Validation();
        $error = $validate->checkValue();
        if (!$error) {
            $infor['name'] = $_POST['name'];
            $infor['password'] = $_POST['password'];
            $infor['email'] = $_POST['email'];
            $infor['activate'] = $_POST['activate'];
            $infor['image'] = $_POST['name'];
            $data['image_tmp'] = $_FILES['avatar']['tmp_name'];
            $data['table'] = $this->table;
            $data['model'] = $this->model;
            $data['pre'] = 'avatar_';
            $this->add($data,$infor);
            header('Location: index.php?controller=UserController&action=index&page=1');
        }
        $this->view(['name' => 'add-user',
                    'error' => $error]);
    }


    public function handle()
    {
        if (isset($_POST['checkbox'])) {
            $this->handleBase($this->table, $this->model,'id');
        }
        header('Location:index.php?controller=UserController&action=index&page=1');
    }

    public function editUser()
    {
        $old = $this->viewEdit($this->table, $this->model, '*');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validate = new Validation();
            $error = $validate->checkValue();
            if (!$error) {
                $infor['name'] = $_POST['name'];
                $infor['email'] = $_POST['email'];
                $infor['password'] = $_POST['password'];
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
                header('Location:index.php?controller=UserController&action=index&page=1');
            }
            else{
                $this->view(['name' => 'edit-user',
                            'infor' => $old,
                            'error' => $error]);
            }
        }
        $this->view(['name' => 'edit-user',
            'infor' => $old]);
    }

    public function searchUser()
    {
        $search = $_GET['search'];
        $order = $_GET['order'];
        $href = "index.php?controller=UserController&action=searchUser&search=$search&order=$order&page=";
        $condition = 'name';
        $userInfor = $this->searchLimit($this->table,$this->model,'name',$href,$order,$condition);
        if(isset($_GET['sort'])){
            $condition = $_GET['sort'];
            $userInfor = $this->searchLimit($this->table, $this->model,'name', $href,$order,$condition);
        }
        $thead = $this->getThead('asc','searchUser');
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link'],
            'thead' => $thead]);
    }

    public function sort()
    {
        $userInfor = array();
        $condition = $_GET['sort'];
        $order = $_GET['order'];
        $href = "index.php?controller=UserController&action=sort&sort=$condition&order=$order&page=";
        $thead = $this->getThead($order,'sort');
        $userInfor = $this->sortLimit($this->model,$this->table,$condition,$order,$href);
        $this->view(['name' => 'list-users',
            'listUser' => $userInfor['infor'],
            'link' => $userInfor['link'],
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
        $thead ="<th width='15%' class='$class'>
                                <a href='index.php?controller=UserController&action=$action&sort=id$search&order=$order&page=1'>ID</a>
                            </th>
                           <th width='30%' class='$class'>
                                <a href='index.php?controller=UserController&action=$action&sort=name$search&order=$order&page=1'>Name</a>
                            </th>
                            <th width='25%' class='$class'>
                                <a href='index.php?controller=UserController&action=$action&sort=activate$search&order=$order&page=1'>Activate</a>
                            </th>
                            <th width='15%' class='$class'>
                                <a href='index.php?controller=UserController&action=$action&sort=time_create$search&order=$order&page=1'>Time Created</a>
                            </th>
                            <th width='15%' class='$class'>
                                <a href='index.php?controller=UserController&action=$action&sort=time_update$search&order=$order&page=1'>Time Updated</a>
                            </th>
                            <th width='10%'>Action</th>";
        return $thead;
    }
}
