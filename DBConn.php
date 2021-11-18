<?php

class DBConn
{
    private $db;
    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'dtb456', 'vaii_semestralna_praca');
        $this->DBErrorCheck();

    }
    private function DBErrorCheck(){
        if ($this->db->error){
            die("DB ERROR: ".$this->db->error);
        }
    }
    private function UserGetAll()
    {
        $result = [];
        $sql = "SELECT * FROM users";
        $dbResult = $this->db->query($sql);
        if ($dbResult->num_rows > 0)
        {
            while ($record = $dbResult->fetch_assoc())
            {
                $result[] = new User($record['user_name'], $record['user_password'], $record['user_email']);
            }
        }
        return $result;
    }

    public function  UserLogin($username, $password){
        $sql = "SELECT user_id, user_name, user_pass FROM users WHERE username = ?";

        if($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows() == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            $stmt->close();
                            return $id;
                        }
                    }
                }
            }
        }
        return 0;
    }

    public function UserRegister(User $user){

        $name = $user->getUserName();
        $mail = $user->getUserEmail();

        $query = "SELECT user_name, user_pass, user_email FROM users WHERE user_name = ? OR user_email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $name, $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();

        if ($result == null)
        {
            $stmt = $this->db->prepare("INSERT INTO users(user_name, user_pass, user_email) VALUES (?, ?, ?)");
            $username = $user->getUserName();
            $userpass = $user->getUserPass();
            $usermail = $user->getUserEmail();
            $stmt->bind_param('sss', $username, $userpass, $usermail);
            if ($stmt->execute()){
                $this->DBErrorCheck();
                return True;
            }
        }
        return False;
    }

}