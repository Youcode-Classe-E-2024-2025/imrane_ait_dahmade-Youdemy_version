<?php

class Role {
    const ETUDIANT = 'Etudiant';
    const ENSEIGNANT = 'Enseignant';
    const ADMINISTRATEUR = 'Administrateur';

    private $role;

    public function __construct($role) {
        if (!in_array($role, [self::ETUDIANT, self::ENSEIGNANT, self::ADMINISTRATEUR])) {
            throw new InvalidArgumentException("Le rôle {$role} n'est pas valide.");
        }
        $this->role = $role;
    }

    public function getRole(): string {
        return $this->role;
    }
}



?>