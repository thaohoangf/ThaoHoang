<?php
require_once "Model/UserModel.php";
//require_once "ProductController.php";
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
                $username = $_POST['username'];
                $password = $_POST['password'];
                $usermodel = new $this->model;
                if ($usermodel->checkLogin($username, $password)) {
                    $_SESSION['username'] = $username;
                    $result = $usermodel->getBy($this->table, 'id', 'name', $username);
                    $row = $result->fetch_assoc();
                    $_SESSION['id'] = $row['id'];
                    $this->home();
                } else {
                    $this->login();
                }
            }
        }
    }
    public function home(){
        header('Location: index.php?controller=UserController&action=index&page=1');
    }

    public function login()
    {
        header('Location: index.php');
    }
}
