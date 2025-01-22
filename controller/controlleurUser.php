<?php

class ControlleurUser {
    private UserModal $userModal;

    public function __construct($userModal) {
        $this->userModal =$userModal;
    }

    public function AffichageCours()
    {
        $users = $this->userModal->AffichagesUser();
        
        return $users;
    }
}











?>