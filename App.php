<?php

require "User.php";
require "DBConn.php";

class App
{
    private DBConn $storage;

    public function __construct()
    {
        $this->storage = new DBConn();

        if (isset($_POST['register'])) {
            $succ = $this->storage->UserRegister(new User($_POST['user_name'], $_POST['user_pass'], $_POST['user_email']));
            if ($succ) {
                echo "Registration successful.";
            } else {
                echo "Registration failed.";
            }

        }
        if (isset($_POST['login'])) {
            $id = $this->storage->UserLogin(new User($_POST['user_name'], $_POST['user_pass']));
            if ($id != 0){
                session_start();
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $id;
                $_SESSION["user_name"] = $_POST["user_name"];
                header("location: index.php");
            } else {
                echo "Incorrect credentials.";
            }
        }
        if (isset($_POST['change_password'])) {
            $success = $this->storage->UserChangePassword($_POST['user_old_pass'], $_POST['user_pass'], $_POST['user_pass_again']);
            if ($success){
                session_start();
                $_SESSION["logged_in"] = false;
                $_SESSION["user_id"] = null;
                $_SESSION["user_name"] = null;
                header("location: index.php");
            } else {
                echo "Incorrect credentials.";
            }
        }
        if (isset($_POST['delete_account'])) {
            $success = $this->storage->UserDeleteAccount($_POST['user_pass']);
            if ($success){
                session_start();
                $_SESSION["logged_in"] = false;
                $_SESSION["user_id"] = null;
                $_SESSION["user_name"] = null;
                header("location: index.php");
            } else {
                echo "Incorrect credentials.";
            }
        }
    }
}