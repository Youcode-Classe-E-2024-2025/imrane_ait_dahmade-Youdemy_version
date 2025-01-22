<?php
require_once __DIR__ . "/../config/configu.php";
require_once __DIR__ . "/../config/connection.php";

class TagsModal{
    private PDO $conn;

    public function __construct()
    {
        $this->conn =DatabaseConnection::getInstance()->getConnection();
    }
    public function GetAllTags(){
        $requet = "SELECT * FROM Tag ;";
        $stmt =$this->conn->prepare($requet);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function AjouterTagsCour($Tags,$IdCour){
        foreach($Tags as $tag){
        $requet = "INSERT INTO CourTag (IdCour,IdTag) VALUES (:IdCour,:IdTag);";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute([
            ':IdCour' => $IdCour,
            ':IdTag' => $tag
        ]);
    }


    }
    public function AfficherTagsCour($idCour){
        $requet = "SELECT courtags.IdCour ,tag.IdTag , tag.NomTag FROM tag join courtags ON courtags.IdTag = tag.IdTag AND courtags.IdCour = :id";
        $stmt = $this->conn->prepare($requet);
    $stmt->execute([
            ':id' =>$idCour
        ]);
      return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>