<?php

class Cour
{
    private int $idCour;
    private string $nomCour;
    private string $description;
    private string $image;
    private string $categorie;
    private \DateTime $dateCreation;
    private Utilisateur $enseignant;
    private array $tags;

    public function __construct(

        string $nomCour,
        string $description,
        string $image,
        string $categorie,
        Utilisateur $enseignant,
        array $tags
    ) {
        
        $this->nomCour = $nomCour;
        $this->description = $description;
     
        $this->image = $image;
     
        $this->categorie = $categorie;
        $this->dateCreation = new \DateTime();
        $this->enseignant = $enseignant;
        $this->tags = $tags;
    }


    public function getNomCour(): string
    {
        return $this->nomCour;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

  
    public function getImage(): string
    {
        return $this->image;
    }

  

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    public function getEnseignant(): Utilisateur
    {
        return $this->enseignant;
    }
    public function gettag(): array
    {
        return $this->tags;
    }
    public function SetId($idCour){
        $this->idCour =$idCour;
    }
    public function SetTags($tags){
        $this->tags = $tags;
    }
}
