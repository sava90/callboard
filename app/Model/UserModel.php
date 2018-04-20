<?php
namespace Model;

use Base\TableModel;
use PDO;

class UserModel extends TableModel
{
    public function __construct($userId)
    {
        parent::__construct();
        $this->table = $this->usersTable;

        $this->getFields();
        if ($userId != 0) {
            $this->fill($userId);
        }
    }

    public function getUserData($userId)
    {
        $query = "SELECT * FROM {$this->table} WHERE userId = :userId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField;
    }

    public function getUsers()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY userId DESC";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->execute();
        $dbFields = self::$stmt->fetchAll(PDO::FETCH_OBJ);

        return $dbFields;
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField;
    }

    public function createAccount($login, $username, $email, $password)
    {
        $query = "INSERT INTO {$this->table} (login, fullName, email, password) VALUES (:login, :fullName, :email, :password)";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':login', $login, PDO::PARAM_STR);
        self::$stmt->bindParam(':fullName', $username, PDO::PARAM_STR);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->bindParam(':password', $password, PDO::PARAM_STR);
        self::$stmt->execute();

        return self::$conn->lastInsertId();
    }

    public function checkDuplicateEmail($email)
    {
        $query = "SELECT userId FROM {$this->table} WHERE email = :email";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':email', $email, PDO::PARAM_STR);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField ? true : false;
    }

    public function updateSettings($userId, $login, $username)
    {
        $query = "UPDATE {$this->table} SET login = :login, fullName = :fullName WHERE userId = :userId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        self::$stmt->bindParam(':login', $login, PDO::PARAM_STR);
        self::$stmt->bindParam(':fullName', $username, PDO::PARAM_STR);
        self::$stmt->execute();
        $errorCode = (int)self::$conn->errorCode();

        return $errorCode ? false : true;
    }
}
