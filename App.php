<?php

require "User.php";
require "DBConn.php";

class App
{
    private $storage;

    public function __construct()
    {
        $this->storage = new DBConn();

        if (isset($_POST['register']))
        {
            $this->storage->UserRegister(new User($_POST['user_name'], $_POST['user_pass'], $_POST['user_email']));
        }
    }
}