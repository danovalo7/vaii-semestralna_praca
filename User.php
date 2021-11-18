<?php

class User
{
    private $user_name;
    private $user_pass;
    private $user_email;

    public function __construct($user_name, $user_pass, $user_email)
    {
        $this->user_name=$user_name;
        $this->user_pass=$user_pass;
        $this->user_email=$user_email;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * @param mixed $user_name
     */
    public function setUserName($user_name): void
    {
        $this->user_name = $user_name;
    }

    /**
     * @return mixed
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * @param mixed $user_pass
     */
    public function setUserPass($user_pass): void
    {
        $this->user_pass = $user_pass;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email): void
    {
        $this->user_email = $user_email;
    }

}