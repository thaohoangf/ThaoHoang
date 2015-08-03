<?php
require_once "Model/UserModel.php";
class LoginController extends BaseController
{
    private $table = 'users';
    private $model = 'UserModel';


    public function __construct()
    {
        $this->checkLogin();
    }

    public function checkLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['submit'])) {
//                var_dump($_POST);
                $username = $_POST['username'];
                $password = $_POST['password'];
                $usermodel = new $this->model;
//                var_dump($usermodel->checkLogin($username, $password));
                if ($usermodel->checkLogin($username, $password)) {
//                    echo 'Thao';
                    $_SESSION['username'] = $username;
//                    echo 'Thao';
//                    echo $_SESSION['username'];
                    $result = $usermodel->getBy($this->table, 'id', 'name', $username);
                    $row = $result->fetch_assoc();
//                    var_dump($row);
                    $_SESSION['id'] = $row['id'];
                    $this->home();
                } else {
                    $this->login();
                }
            }
        }
    }
    public function home(){
//        echo 'Thao';
        header('Location: index.php?controller=HomeController&action=index');
    }
    public function login()
    {
        $this->view(['view' => 'login']);
    }
}
