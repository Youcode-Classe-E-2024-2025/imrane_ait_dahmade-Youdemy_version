<?php

class authentification
{
    private UserModal $userModal;

    public function __construct(UserModal $userModal)
    {
        $this->userModal = $userModal;
    }
    public function signup(Utilisateur $user)
    {
        $modal = new UserModal;
        return  $modal->AjouterUser($user);
    }
    public function login($email, $password)
    {
        session_start();
        try {
            if (empty($email) && empty($password)) {
                echo "false";
            }

            $user = $this->userModal->login($email, $password);



            if ($user) {
                $_SESSION['NomUser'] = $user->getNom();
                $_SESSION['TypeUser'] = $user->getRole();
                $_SESSION['IdUser'] = $user->getId();


                echo "Login successful! Welcome, " . $user->getNom();

                if ($user->getRole()->getRole() === 'Enseignant') {
                    header('Location: ./view/page_Enseignant.php?name=' . $user->getId());
                    exit();
                } elseif ($user->getRole()->getRole() === 'Administrateur') {
                    header('Location: ./view/page_Administrateur.php?name=' . $user->getId());
                    exit();
                } elseif ($user->getRole()->getRole() === 'Etudiant') {
                    header('Location: ./view/page_Etudiant.php?name=' . $user->getId());
                    //include_once __DIR__ .'/view/page_Etudiant.php?name='. $user->getNom();

                    exit();
                }
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
    public function SelectUser($id)
    {

        $user = $this->userModal->SelectUser($id);

        return  $user;
    }
}
