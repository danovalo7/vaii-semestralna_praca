<?php

class DBConn
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'vaii_semestralna_praca');
        $this->DBErrorCheck();

    }

    private function DBErrorCheck()
    {
        if ($this->db->error) {
            die("500 INTERNAL SERVER ERROR: " . $this->db->error);
        }
    }


    private function UserGetData(User $user): User|bool
    {
        $mail = $user->getUserEmail();
        if ($mail==""){
            $mail="x";
        }
        $sql = "SELECT user_id, user_pass, user_email FROM users WHERE user_name = ? OR user_email = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt != false) {
            $name = $user->getUserName();
            $stmt->bind_param("ss", $name, $mail);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows() == 1) {
                    $stmt->bind_result($id, $password, $email);
                    if ($stmt->fetch()) {
                        $stmt->close();
                        return new User($name, $password, $email, $id);
                    }
                }
            }
        }
        return false;
    }

    public function UserRegister(User $user): bool
    {
        if (!$user->validateUser()){
            return false;
        }
        if (!$this->UserGetData($user)) {
            $stmt = $this->db->prepare("INSERT INTO users(user_name, user_pass, user_email) VALUES (?, ?, ?)");
            $username = $user->getUserName();
            $userpass = $user->getUserPass();
            $usermail = $user->getUserEmail();
            $stmt->bind_param('sss', $username, $userpass, $usermail);
            if ($stmt->execute()) {
                $this->DBErrorCheck();
                return true;
            }
        }
        return false;
    }

    public function UserLogin(User $user): int
    {
        $userFromDatabase = $this->UserGetData($user);
        if ($userFromDatabase) {
            if ($user->getUserPass() == $userFromDatabase->getUserPass()) {
                return $userFromDatabase->getUserId();
            }
        }
        return 0;
    }

    public function UserChangePassword($old_password, $new_password, $new_password_again): bool
    {
        if ($new_password !== $new_password_again) {
            return false;
        }
        session_start();
        if (!isset($_SESSION['user_name'])) {
            return false;
        }
        $userdata = $this->UserGetData(new User($_SESSION['user_name']));
        if ($userdata !== false) {
            if ($old_password == $userdata->getUserPass()) {
                $stmt = $this->db->prepare("UPDATE users SET user_pass=? WHERE user_id=?");
                $userId = $userdata->getUserId();
                $stmt->bind_param('ss', $new_password, $userId);
                if ($stmt->execute()) {
                    $this->DBErrorCheck();
                    return true;
                }
            }
        }
        return false;
    }

    public function UserDeleteAccount($user_pass): bool
    {
        session_start();
        if (!isset($_SESSION['user_name'])) {
            return false;
        }
        $userdata = $this->UserGetData(new User($_SESSION['user_name']));
        if ($userdata) {
            if ($user_pass == $userdata->getUserPass()) {
                $stmt = $this->db->prepare("DELETE FROM users WHERE user_id=?");
                $userId = $userdata->getUserId();
                $stmt->bind_param('s', $userId);
                if ($stmt->execute()) {
                    $this->DBErrorCheck();

                    return true;
                }
            }
        }
        return false;
    }
}