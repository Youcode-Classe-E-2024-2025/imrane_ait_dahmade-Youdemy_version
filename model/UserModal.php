<?php
require_once __DIR__ . "/../config/configu.php";
require_once __DIR__ . "/../config/connection.php";
class UserModal
{

    protected PDO $conn;
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }
    public function AjouterUser(Utilisateur $utilisateur)
    {
        $requet = "INSERT INTO Utilisateur (Nom,Email,PASSWORD,Role) VALUES (:NOM,:EMAIL,:PASSWORD,:ROLE)";

        $stmt = $this->conn->prepare($requet);
        $nom = $utilisateur->getNom();
        $Email = $utilisateur->getEmail();
        $password = $utilisateur->getPassword();
        $role = $utilisateur->getRole()->getRole();

        return $stmt->execute([
            ':NOM' => $nom,
            ':EMAIL' => $Email,
            ':PASSWORD' => $password,
            ':ROLE' => $role
        ]);
    }
    public function login($Email, $password)
    {
        $requet = "SELECT * FROM Utilisateur WHERE Email = :email AND StatutInscription = 'activer'";

        $stmt = $this->conn->prepare($requet);
        $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
        $stmt->execute();
        // $stmt->bindParam(':activer', $active, PDO::PARAM_STR);
        $user =  $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PASSWORD'])) {
            $role = new Role($user['Role']);
          
            $creeUser = new Utilisateur(
                $user['Nom'],
                $user['Email'],
                $user['PASSWORD'],
                $role
            );
           
          
            if (isset($user['Id'])) {
                $creeUser->setId($user['Id']) ;  // Assurez-vous que l'ID est défini correctement dans votre modèle
            }
          
        
           
         
           
            return $creeUser; 
        } 
        return null ;
    }
    public function SelectUser($id){
        $requet = "SELECT * FROM utilisateur WHERE Id = :id ";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function AffichagesUser(){  
        $requet = "SELECT * FROM Utilisateur ";
        $stmt = $this->conn->prepare($requet);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
}
