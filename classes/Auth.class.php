<?php

namespace Auth;

class User
{
    private $id;
    private $username;
    private $db;
    private $user_id;

    private $db_host = "localhost";
    private $db_name = "database";
    private $db_user = "root";
    private $db_pass = "";
    
    private $is_authorized = false;

    public function __construct($username = null, $password = null)
    {
        $this->username = $username;
        $this->connectDb($this->db_name, $this->db_user, $this->db_pass, $this->db_host);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public static function isAuthorized()
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool) $_SESSION["user_id"];
        }
        return false;
    }

    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function getSalt($username) {
        $query = "select salt from users where username = :username limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":username" => $username
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["salt"];
    }
    
    public function getName() {
        $query = "select * from users where id = :id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $_SESSION["user_id"]
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["username"];
    }
    
    public function getPhone() {
        $query = "select * from users where id = :id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $_SESSION["user_id"]
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["phone"];
    }
    
    public function getEmail() {
        $query = "select * from users where id = :id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $_SESSION["user_id"]
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["email"];
    }
    
    public function getCurrentQuestion() {
        $query = "select * from users where id = :id limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":id" => $_SESSION["user_id"]
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["answered"];   
    }

    public function authorize($username, $password, $remember=false)
    {
        $query = "select id, username from users where
            username = :username and password = :password limit 1";
        $sth = $this->db->prepare($query);
        $salt = $this->getSalt($username);

        if (!$salt) {
            return false;
        }

        $hashes = $this->passwordHash($password, $salt);
        $sth->execute(
            array(
                ":username" => $username,
                ":password" => $hashes['hash'],
            )
        );
        $this->user = $sth->fetch();
        
        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;
    }

    public function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function create($username, $password, $phone, $email) {
        $user_exists = $this->getSalt($username);

        if ($user_exists) {
            throw new \Exception("User exists: " . $username, 1);
        }

        $query = "insert into users (username, password, phone, email, salt)
            values (:username, :password, :phone, :email, :salt)";
        $hashes = $this->passwordHash($password);
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':username' => $username,
                    ':phone' => $phone,
                    ':email' => $email,
                    ':password' => $hashes['hash'],
                    ':salt' => $hashes['salt'],
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Ошибка базы данных %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function edit($username, $phone, $email) {

        $query = "update users set username=:username, phone=:phone, email=:email where id = :id";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':id' => $_SESSION["user_id"],
                    ':username' => $username,
                    ':phone' => $phone,
                    ':email' => $email,
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Ошибка базы данных %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }
    
    public function addAnswer($number) {

        $query = "update users set answered=:answered where id = :id";
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':id' => $_SESSION["user_id"],
                    ':answered' => $number,
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Ошибка базы данных %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }

    public function connectdb($db_name, $db_user, $db_pass, $db_host = "localhost")
    {
        try {
            $this->db = new \pdo("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        } catch (\pdoexception $e) {
            echo "ошибка базы данных: " . $e->getmessage();
            die();
        }
        $this->db->query('set names utf8');

        return $this;
    }
}
