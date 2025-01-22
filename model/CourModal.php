<?php
require_once __DIR__ . "/../config/configu.php";
require_once __DIR__ . "/../config/connection.php";

class CourModal
{

    protected PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

  
  

    public function ajouterCour(Cour $cour)
    {
        if ($cour instanceof CourVideo) {
            return $this->ajouterCourVideo($cour);
        } elseif ($cour instanceof CourDocument) {
            return $this->ajouterCourDocument($cour);
        } else {
            throw new Exception("Type de cours non pris en charge");
        }
    }

    private function ajouterCourVideo(CourVideo $cour)
    {
        $requete = "INSERT INTO cour (NomCour, Description, Video, Image, Categorie, Enseignant) 
                    VALUES (:NomCour, :Description, :Video, :Image, :Categorie, :Enseignant)";
        $stmt = $this->conn->prepare($requete);


        $enseignantId = $cour->getEnseignant()->getId();
      
        $stmt->execute([
            ':NomCour'    => $cour->getNomCour(),
            ':Description'=> $cour->getDescription(),
            ':Video'      => $cour->getVideo(),
            ':Image'      => $cour->getImage(),
            ':Categorie'  => $cour->getCategorie(),
            ':Enseignant' => $enseignantId
        ]);

       $id =  $this->conn->lastInsertId();
      $this->AjouterTagCour($cour->gettag(),$id);
        return $id ; 
    }
    
    private function AjouterTagCour($Tags , $idCour){
        foreach($Tags as $tag){
        $requet = "INSERT INTO courtags (IdCour,IdTag) VALUES (:idcour,:idtag);";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute([
            ':idcour' =>$idCour,
            ':idtag' => $tag
        ]);
    }

    }

    private function ajouterCourDocument(CourDocument $cour)
    {
        $requete = "INSERT INTO cour (NomCour, Description, Document, Image, Categorie, Enseignant) 
                    VALUES (:NomCour, :Description, :Document, :Image, :Categorie, :Enseignant)";
        $stmt = $this->conn->prepare($requete);
        $enseignantId = $cour->getEnseignant()->getId();
        $stmt->execute([
            ':NomCour'    => $cour->getNomCour(),
            ':Description'=> $cour->getDescription(),
            ':Document'   => $cour->getDocument(),
            ':Image'      => $cour->getImage(),
            ':Categorie'  => $cour->getCategorie(),
            ':Enseignant' => $enseignantId
        ]);
        echo "ajouter seccuful";

        return $this->conn->lastInsertId(); 
    }

    public function affichagesCours()
    {
        $requet = "SELECT * FROM Cour  ";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function affichagesCoursWithPagination($Limit, $Offset)
    {
        $requet = "SELECT * FROM Cour LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($requet);
        $stmt->bindParam(':limit', $Limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $Offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function GetTotalCour()
    {
        $requet = " SELECT count(*) from Cour";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function rechercheCour($mot_cle)
    {
        $requet = "SELECT * FROM Cour WHERE NomCour LIKE :MOTCLE OR Categorie LIKE :MOTCLE";
        $stmt = $this->conn->prepare($requet);
        $mot_cle = '%' . $mot_cle . '%';
        $stmt->bindParam(':MOTCLE', $mot_cle, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourne les résultats sous forme de tableau associatif.
    }
    
    public function affichagesCoursEnseignant($id)
    {
       
        $requet = "SELECT * FROM Cour WHERE Enseignant = :id ; ";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute([
            ':id' =>$id,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function affichageCour($idCour)
    {
        $requet = "SELECT * FROM Cour WHERE IdCour = :id  ";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute([
            ':id' =>$idCour
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function AjouterInscriptionBd($idCour,$idUser): void{
       
    // Vérifier si l'étudiant est déjà inscrit à ce cours
    $stmt = $this->conn->prepare('SELECT COUNT(*) FROM inscription WHERE IdUser = :id_user AND IdCour = :id_cour');
    $stmt->execute([
        ':id_user' => $idUser,
        'id_cour' => $idCour
    ]);
 $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Vous êtes déjà inscrit à ce cours.";
        return;
    }

    
    $stmt = $this->conn->prepare('INSERT INTO inscription (IdUser, IdCour) VALUES (:id_user, :id_cour)');
    $stmt->execute([
        ':id_user' => $idUser,
        'id_cour' => $idCour
    ]);
    header('Location: ./view/page_Etudiant.php');    
    }

    public function AffichageMesCoursEtudiant($idUser):array{
       $requet = "SELECT c.* 
          FROM inscription i
          JOIN Cour c ON i.IdCour = c.IdCour
          WHERE i.IdUser = :IdUser";
          $stmt = $this->conn->prepare($requet);
          $stmt->execute([
            ':IdUser' => $idUser
          ]);

        
        
return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function suprimerCourInscreptionEtudiant($IdUser,$IdCour){
        $requet = "DELETE FROM inscription WHERE IdCour = :idCour AND IdUser = :idUser;";
            $stmt = $this->conn->prepare($requet);
            $stmt->execute([
                ':idCour' => $IdCour,
                ':idUser' => $IdUser,
            ]);

        

    }
}

