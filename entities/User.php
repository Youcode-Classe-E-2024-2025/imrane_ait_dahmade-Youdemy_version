<?php
class Utilisateur
{
    private int $id;
    private string $nom;
    private string $email;
    private string $password;
    private Role $role;
    private string $statutInscription;
    private \DateTime $dateCreation;

    public function __construct(string $nom, string $email, string $password, Role $role)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role =  $role;
        $this->statutInscription = 'activer'; 
        $this->dateCreation = new \DateTime();
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getStatutInscription(): string
    {
        return $this->statutInscription;
    }

    public function activerInscription(): void
    {
        $this->statutInscription = 'activer';
    }

    public function desactiverInscription(): void
    {
        $this->statutInscription = 'non_activer';
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
}
