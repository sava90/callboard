<?php
namespace Model;

use Base\TableModel;
use PDO;

class AdModel extends TableModel
{
    public function __construct($adId = 0)
    {
        parent::__construct();
        $this->table = $this->adsTable;

        $this->getFields();
        if ($adId != 0) {
            $this->fill($adId);
        }
    }

    public function getAdData($adId)
    {
        $query = "SELECT * FROM {$this->table} WHERE adId = :adId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':adId', $adId, PDO::PARAM_INT);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField;
    }

    public function getFullAdData($adId)
    {
        $query = "SELECT a.*, u.* FROM {$this->table} AS a LEFT JOIN {$this->usersTable} AS u ON u.userId = a.userId WHERE a.adId = :adId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':adId', $adId, PDO::PARAM_INT);
        self::$stmt->execute();
        $dbField = self::$stmt->fetch(PDO::FETCH_OBJ);

        return $dbField;
    }

    public function getAds()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY adId DESC";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->execute();
        $dbFields = self::$stmt->fetchAll(PDO::FETCH_OBJ);

        return $dbFields;
    }


    public function insert($userId, $title, $text)
    {
        $query = "INSERT INTO {$this->table} (userId, title, body) VALUES (:userId, :title, :body)";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        self::$stmt->bindParam(':title', $title, PDO::PARAM_STR);
        self::$stmt->bindParam(':body', $text, PDO::PARAM_STR);
        self::$stmt->execute();

        return self::$conn->lastInsertId();
    }

    public function updateFileName($adId, $fileName)
    {
        $query = "UPDATE {$this->table} SET fileName = :fileName WHERE adId = :adId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':adId', $adId, PDO::PARAM_INT);
        self::$stmt->bindParam(':fileName', $fileName, PDO::PARAM_STR);
        self::$stmt->execute();
        $errorCode = (int)self::$conn->errorCode();

        return $errorCode ? false : true;
    }

    public function update($adId, $title, $text)
    {
        $query = "UPDATE {$this->table} SET title = :title, body = :body WHERE adId = :adId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':adId', $adId, PDO::PARAM_INT);
        self::$stmt->bindParam(':title', $title, PDO::PARAM_STR);
        self::$stmt->bindParam(':body', $text, PDO::PARAM_STR);
        self::$stmt->execute();
        $errorCode = (int)self::$conn->errorCode();

        return $errorCode ? false : true;
    }

    public function delete($adId)
    {
        $query = "DELETE FROM {$this->table} WHERE adId = :adId";
        self::$stmt = self::$conn->prepare($query);
        self::$stmt->bindParam(':adId', $adId, PDO::PARAM_INT);

        return (int)self::$stmt->execute();
    }
}
