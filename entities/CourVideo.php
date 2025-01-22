<?php

class CourVideo extends Cour
{
    private string $video;
    private string $pathVideo;
    

    public function __construct(
        string $nomCour,
        string $description,
        string $image,
        string $categorie,
        Utilisateur $enseignant,
        array $tags,
        string $video
    ) {
        parent::__construct($nomCour, $description, $image, $categorie, $enseignant, $tags);
        $this->video = $video;

    }

    public function getVideo(): string
    {
        return $this->video;
    }


    public function setVideo(string $video): void
    {
        $this->video = $video;
    }
}


?>