<?php

class CourDocument extends Cour
{
    private string $document;

    public function __construct(
        string $nomCour,
        string $description,
        string $image,
        string $categorie,
        Utilisateur $enseignant,
        array $tags,
        string $document // Document spécifique
    ) {
        parent::__construct($nomCour, $description, $image, $categorie, $enseignant, $tags);
        $this->document = $document;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function setDocument(string $document): void
    {
        $this->document = $document;
    }
}


?>