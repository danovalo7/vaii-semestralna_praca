<?php

require "User.php";
require "DBConn.php";

class App
{
    private $storage;

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
            $id = $this->storage->UserLogin($_POST['user_name'], $_POST['user_pass']);
            if ($id != 0){
                session_start();
                $_SESSION["logged_in"] = true;
                $_SESSION["user_id"] = $id;
                $_SESSION["user_name"] = $_POST["user_name"];
                header("location: index.php");
            } else {
                echo "Incorrect credentials.";
            }
            echo "lol";
        }
    }
}