<?php
require_once "IBase_DAO.php";
class User_DAO implements IBase_DAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        $users = [];
        $this->db->query("SELECT * FROM users");
        $result = $this->db->resultSet();

        foreach ($result as $user) {
            $u = new User($user->id, $user->username, $user->email, $user->registration_date);
            array_push($users, $u);
        }

        return $users;
    }

    public function getById(int $id)
    {
        $user = null;
        $this->db->query("SELECT * FROM users WHERE id LIKE :id");
        $this->db->bind(":id", $id);

        $user = $this->db->single();
        if($user == null){
            return null;
        }
        $u = new User($user->id, $user->username, $user->email, $user->registration_date);

        return $u;
    }

    public function getByName(string $name)
    {
        $users = [];
        $this->db->query("SELECT * FROM users WHERE username LIKE :username");
        $this->db->bind(":username", $name);
        $result = $this->db->resultSet();
        if($result == null) {
            return null;
        }
        foreach ($result as $user) {
            $u = new User($user->id, $user->username, $user->email, $user->registration_date);
            array_push($users, $u);
        }

        return $users;
    }

    public function getByEmail(string $email)
    {
        $user = null;
        $this->db->query("SELECT * FROM users WHERE email LIKE :email");
        $this->db->bind(":email", $email);
        $user = $this->db->single();
        if($user == null) {
            return null;
        }
        $u = new User($user->id, $user->username, $user->email, $user->registration_date);

        return $u;
    }

    public function getByDate(string $date)
    {
        $users = [];
        $this->db->query("SELECT * FROM users WHERE registration_date LIKE :date ");
        $this->db->bind(":date", "%$date%");
        $result = $this->db->resultSet();
        if($result == null) {
            return null;
        }
        foreach ($result as $user) {
            $u = new User($user->id, $user->username, $user->email, $user->registration_date);
            array_push($users, $u);
        }

        return $users;
    }

    public function checkByEmail(string $email)
    {
        $user = null;
        $this->db->query("SELECT * FROM users WHERE email LIKE :email");
        $this->db->bind(":email", $email);

        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }

    }

    public function create($data)
    {
        $this->db->query("INSERT INTO users (username, email, password) VALUES(:username, :email, :password)");
        $this->db->bind(":username", $data["username"]);
        $this->db->bind(":email", $data["email"]);
        $this->db->bind(":password", $data["password"]);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password){
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind(":username", $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $this->db->query("UPDATE users SET password = :newpassword WHERE username = :username");
        $this->db->bind(":newpassword", $data["password"]);
        $this->db->bind(":username", $data["username"]);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($obj)
    {
        $user = $obj;
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(":id", $user->getId());
        $this->db->execute();
    }
}