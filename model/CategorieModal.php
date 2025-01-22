<?php


class CategorieModal{

    private $conn ;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }
    public function GetAllCategories(){
        $requet = "SELECT * FROM Categorie ;";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}


?>