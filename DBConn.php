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
            die("DB ERROR: " . $this->db->error);
        }
    }


    private function UserGetData($name, $mail = null): bool|array
    {
        if (!isset($mail)) {
            $mail = "x";
        }
        $sql = "SELECT user_id, user_pass, user_email FROM users WHERE user_name = ? OR user_email = ?";
        $stmt = $this->db->prepare($sql);
        if ($stmt != false) {
            $stmt->bind_param("ss", $name, $mail);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows() == 1) {
                    $stmt->bind_result($id, $password, $email);
                    if ($stmt->fetch()) {
                        $stmt->close();
                        $result = [];
                        $result[] = $id;
                        $result[] = $password;
                        $result[] = $email;
                        return $result;
                    }
                }
            }
        }
        return false;
    }

    public function UserRegister(User $user): bool
    {

        if (!$this->UserGetData($user->getUserName(), $user->getUserEmail())) {
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

    public function UserLogin($username, $password): int
    {
        $userdata = $this->UserGetData($username);
        if ($userdata) {
            if ($password == $userdata[1]) {
                return $userdata[0];
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
        $userdata = $this->UserGetData($_SESSION['user_name']);
        if ($userdata !== false) {
            if ($old_password == $userdata[1]) {
                $stmt = $this->db->prepare("UPDATE users SET user_pass=? WHERE user_id=?");
                $stmt->bind_param('ss', $new_password, $userdata[0]);
                if ($stmt->execute()) {
                    $this->DBErrorCheck();
                    return true;
                }
            }
        }
        return false;
    }

    public function UserDeleteAccount($user_pass)
    {
        session_start();
        if (!isset($_SESSION['user_name'])) {
            return false;
        }
        $userdata = $this->UserGetData($_SESSION['user_name']);
        if ($userdata) {
            if ($user_pass == $userdata[1]) {
                $stmt = $this->db->prepare("DELETE FROM users WHERE user_id=?");
                $stmt->bind_param('s', $userdata[0]);
                if ($stmt->execute()) {
                    $this->DBErrorCheck();

                    return true;
                }
            }
        }
        return false;
    }
}