<?php

class User
{
    private string $user_name;
    private string $user_pass;
    private string $user_email;

    public function __construct($user_name, $user_pass, $user_email)
    {
        $this->user_name = $user_name;
        $this->user_pass = $user_pass;
        $this->user_email = $user_email;
    }

    /**
     * @return string
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
     * @return string
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
     * @return string
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

    public function validateUser(): bool
    {
        if (!isset($this->user_name) || $this->user_name == "") {
            return false;
        }
        if (!isset($this->user_pass) || $this->user_pass == "" || strlen($this->user_pass) < 6) {
            return false;
        }
        if (!isset($this->user_email) || $this->user_email == "") {
            return false;
        }
        if (!preg_match("/^\S+@\S+\.\S+$/", $this->user_email)) {
            return false;
        }
        return true;
    }

}