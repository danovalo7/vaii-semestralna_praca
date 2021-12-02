<?php

class User
{
    private string $user_name;
    private string $user_pass;
    private string $user_email;
    private int $user_id;

    public function __construct($user_name="", $user_pass="", $user_email="", $user_id=0)
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_pass = $user_pass;
        $this->user_email = $user_email;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
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
    public function getUserPass(): string
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
    public function getUserEmail(): string
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

    public function validateUser($name=true,$pass=true,$mail=true): bool
    {
        if ($name && (!isset($this->user_name) || $this->user_name == "")) {
            return false;
        }
        if ($pass && (!isset($this->user_pass) || $this->user_pass == "" || strlen($this->user_pass) < 6)) {
            return false;
        }
        if ($mail && (!isset($this->user_email) || $this->user_email == "" || !preg_match("/^\S+@\S+\.\S+$/", $this->user_email))) {
            return false;
        }
        return true;
    }

}