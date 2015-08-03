<?php
require_once 'Database.php';
require_once 'Model.php';
class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($username, $password)
    {
        $query = "SELECT id, name, password FROM users WHERE name = '$username' AND password = '$password'";
        $result = $this->cont->query($query);
        if ($result->num_rows > 0) {
            return true;}
        else
            return false;
    }


}
