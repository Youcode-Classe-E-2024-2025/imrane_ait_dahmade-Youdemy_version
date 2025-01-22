<?php

class Categorie {
    private string $nomCategorie;
    private int $id;

    public function __construct(string $nomCategorie ,int $id) {
        $this->nomCategorie = $nomCategorie;
        $this->id = $id;
    }

    public function getNomCategorie(): string {
        return $this->nomCategorie;
    }
    public function getId(): int {
        return $this->id;
    }
}

?>