<?php
include '../lib/Database.php';
include '../lib/Session.php';
Session::checkLogin();
include '../helpers/Format.php';
?>

<?php

class AdminLogin{

    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function adminLogin($adminUser, $adminPass){

        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser)) {
            $loginMsg = "Username can not be empty";
            return $loginMsg;
        }
        else if (empty($adminPass)) {
            $loginMsg = "Password can not be empty";
            return $loginMsg;
        }
        else{
            $adminPass = md5($adminPass);
            $queryLogin = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' && adminPass='$adminPass' ";
            $loginResult = $this->db->select($queryLogin);
            if ($loginResult) {
                $value = $loginResult->fetch_assoc();
                Session::set('login', 'true');
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                Session::set('adminId', $value['adminId']);
                Session::set('adminEmail', $value['adminEmail']);
                header('Location:dashboard.php');
            }
            else{
                $loginMsg = "Username and Password not matched";
                return $loginMsg;
            }
        }


    }

}
