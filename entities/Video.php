 
 <?php
 
 class Video
{
    private string $name;
    private string $tmpName;
    private int $error;

    public function __construct(string $name, string $tmpName, int $error)
    {
        $this->name = $name;
        $this->tmpName = $tmpName;
        $this->error = $error;
    }

    // Getter pour le nom
    public function getName(): string
    {
        return $this->name;
    }

    // Getter pour le chemin temporaire
    public function getTmpName(): string
    {
        return $this->tmpName;
    }

    // Getter pour l'erreur
    public function getError(): int
    {
        return $this->error;
    }

    // Vérification si le fichier est valide
    public function isValid(): bool
    {
        return $this->error === UPLOAD_ERR_OK;
    }
   
}

?>