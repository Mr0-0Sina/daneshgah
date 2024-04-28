<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'daneshga';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die($e);
        }
    }
    function checkUser($username, $email) {
        try {
            $query = "SELECT COUNT(*) FROM test WHERE username = :username OR email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if($count == 0)
                return true;
            else
                return false;
        } catch(PDOException $e) {
            return false;
        }
    }
    
public function registerUser($username, $fullname, $email, $password) {
    try {
        $query = "INSERT INTO test (username, fullname, email, password) VALUES (:username, :fullname, :email, :password)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return false;
    }
}

public function verifyLogin($username, $password) {
    try {
        $query = "SELECT password FROM test WHERE username = :username";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $hashedPassword = $stmt->fetchColumn();
        if (password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    } catch(PDOException $e) {
        return false;
    }
}

public function getUserInfo($id) {
    try {
        if (is_numeric($id)) {
            $query = "SELECT * FROM test WHERE id = :id";
        } else {
            $query = "SELECT * FROM test WHERE username = :id";
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    } catch(PDOException $e) {
        return null;
    }
}


}

?>
