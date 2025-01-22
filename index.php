<?php

/**
 * Dump and die.
 *
 * @param $var
 * @return void
 */
function dd(...$var)
{
    foreach ($var as $elem) {
        echo '<pre class="codespan">';
        echo '<code>';
        !$elem || $elem == '' ? var_dump($elem) : print_r($elem);
        echo '</code>';
        echo '</pre>';
    }


    die();
}


require_once  "./config/configu.php";
require_once "./config/connection.php";
require_once "./entities/Role.php";
require_once "./controller/Authentification.php";
require_once "./model/UserModal.php";
require_once "./entities/User.php";
require_once "./controller/controllerCour.php";
require_once "./model/CourModal.php";
require_once "./controller/controllerTags.php";
require_once "./model/TagsModal.php";
require_once "./entities/Video.php";
require_once "./entities/Image.php";
require_once "./entities/Cour.php";
require_once "./entities/CourVideo.php";
require_once "./entities/CourDocument.php";



$tags = new TagControlleur(new TagsModal);
$register = new authentification(userModal: new UserModal);
$courRecherche = new CourContrller(new CourModal);




if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // if (!in_array($action, ['login', 'signUp']) && !isset($_SESSION['user'])) {
    //     header('Location: index.php?action=login');
    //     exit;
    // }
    if (isset($_POST['register'])) {
        $RolePost = $_POST['Role'];
        $role = new Role($RolePost);
        $password = password_hash($_POST['Password2'], PASSWORD_DEFAULT);
        $user = new Utilisateur($_POST['Nom'], $_POST['Email'], $password, $role);


        if ($register->signup($user)) {
            header('Location: ./view/page_login.php');
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        var_dump($email);
        $password = $_POST['password'];
        var_dump($password);
        $register->login($email, $password);
    }

    if (isset($_POST['AjouterUnCourVideo'])) {

        // Récupération des données envoyées par le formulaire
        $NomCour = $_POST['NomCour'];
        $Description = $_POST['Description'];
        $Enseignant = $_POST['id'];

        $Categorie = $_POST['Categorie'];
        $TagsArray = $_POST['input-custom-dropdown'];
        $data = json_decode($TagsArray, true);
        $ids = [];
        foreach ($data as $tag) {
            if (isset($tag['id'])) {
                $ids[] = $tag['id'];
               
            }
        }
      

        // Création de l'objet Image à partir des fichiers téléchargés
        $image = new Image(
            $_FILES['Image']['name'],
            $_FILES['Image']['tmp_name'],
            $_FILES['Image']['error']
        );
        // Création de l'objet Video à partir des fichiers téléchargés
        $video = new Video(
            $_FILES['Video']['name'],
            $_FILES['Video']['tmp_name'],
            $_FILES['Video']['error']
        );

        $Enseignant = $register->SelectUser($_POST['id']);
        $roleNew = new Role($Enseignant['Role']);

        $EnseignantNew = new Utilisateur($Enseignant['Nom'],$Enseignant['Email'],$Enseignant['PASSWORD'],$roleNew);
        $EnseignantNew->setId($_POST['id']);
       
       
        if ($image->getImageError() === 0) {
            try {
                $image_ex = pathinfo($image->getImageName(), PATHINFO_EXTENSION);
                $image_ex_lc = strtolower($image_ex);
        
                $allowed_exs_image = array('jpg', 'jpeg', 'png', 'webp');
                
                if (in_array($image_ex_lc, $allowed_exs_image)) {
                  
                    $new_image_name = uniqid("image-", true) . '.' . $image_ex_lc;
        
                  
                    $image_upload_path = 'uploads/images/' . $new_image_name;
        
                    if (!is_dir('uploads/images/')) {
                        mkdir('uploads/images/', 0777, true);
                    }
        
                    
                    if (move_uploaded_file($image->getImageTmpName(), $image_upload_path)) {
                     
                    } else {
                        throw new Exception("Failed to move the uploaded image.");
                    }
                } else {
                    throw new Exception("Invalid image extension: " . $image_ex_lc);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                die();
            }
        }
        
        if ($video->getError()  === 0) {
            try {
                $video_ex = pathinfo($video->getName(), PATHINFO_EXTENSION);
                // echo $video_ex;
                $video_ex_lc = strtolower($video_ex);
                $allowed_exs = array("mp4", 'webm', 'avi', 'flv');
                if (in_array($video_ex_lc, $allowed_exs)) {
                    $new_video_name = uniqid("video-", true) . '.' . $video_ex_lc;
                    $video_upload_path = 'uploads/' . $new_video_name;
                    move_uploaded_file($video->getTmpName(), $video_upload_path);
                    // $video = $video_upload_path;
                    
                }
            } catch (Exception $e) {
                echo "" . $e->getMessage() . "";
                die();
            }
          
        }
        $cour = new CourVideo(
            $NomCour,
            $Description,
            $image_upload_path,
            $Categorie,
            $EnseignantNew,
            $ids,
            $video_upload_path    
        );

        $cour->SetTags($ids);
       
        try {
           if($courRecherche->AjouterCourVideo($cour)){
            header('Location: ./view/page_Enseignant.php?name=' . $_POST['id']);
           }
        } catch (Exception $e) {
            echo ''. $e->getMessage();
        }
    }
    if(isset($_POST['AjouterUnCourDoc'])){
       
        $NomCour = $_POST['NomCour'];
        $Description = $_POST['Description'];
        $Enseignant = $_POST['id'];

        $Markdown = $_POST['Document'];
        $Categorie = $_POST['Categorie'];
        $TagsArray = $_POST['tags-document'];
        $data = json_decode($TagsArray, true);
        $ids = [];
        foreach ($data as $tag) {
            if (isset($tag['id'])) {
                $ids[] = $tag['id'];
               
            }
        }
      

        // Création de l'objet Image à partir des fichiers téléchargés
        $image = new Image(
            $_FILES['Image']['name'],
            $_FILES['Image']['tmp_name'],
            $_FILES['Image']['error']
        );
       
       

        $Enseignant = $register->SelectUser($_POST['id']);
        $roleNew = new Role($Enseignant['Role']);

        $EnseignantNew = new Utilisateur($Enseignant['Nom'],$Enseignant['Email'],$Enseignant['PASSWORD'],$roleNew);
        $EnseignantNew->setId($_POST['id']);
       
       
        if ($image->getImageError() === 0) {
            try {
                $image_ex = pathinfo($image->getImageName(), PATHINFO_EXTENSION);
                $image_ex_lc = strtolower($image_ex);
        
                $allowed_exs_image = array('jpg', 'jpeg', 'png', 'webp');
                
                if (in_array($image_ex_lc, $allowed_exs_image)) {
                  
                    $new_image_name = uniqid("image-", true) . '.' . $image_ex_lc;
        
                  
                    $image_upload_path = 'uploads/images/' . $new_image_name;
                    var_dump($image_upload_path);
        
                    if (!is_dir('uploads/images/')) {
                        mkdir('uploads/images/', 0777, true);
                    }
        
                    
                    if (move_uploaded_file($image->getImageTmpName(), $image_upload_path)) {
                     
                    } else {
                        throw new Exception("Failed to move the uploaded image.");
                    }
                } else {
                    throw new Exception("Invalid image extension: " . $image_ex_lc);
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                die();
            }
        }
        
        $cour = new CourDocument(
            $NomCour,
            $Description,
            $image_upload_path,
            $Categorie,
            $EnseignantNew,
            $ids,
            $Markdown 
        );

        $cour->SetTags($ids);
       
        try {
           if($courRecherche->AjouterCourDocument($cour)){
            header('Location: ./view/page_Enseignant.php?name=' . $_POST['id']);
           }
        } catch (Exception $e) {
            echo ''. $e->getMessage();
        }
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['mot_cle'])) {
        $mot_cle = $_GET['mot_cle'];


        if (isset($_GET['mot_cle']) && !empty($_GET['mot_cle'])) {
            $mot_cle = $_GET['mot_cle'];
            $cours = $courRecherche->rechercheController($mot_cle);
            if ($cours) {
                include_once __DIR__ . "/view/page_recherche.php";
                return $cours;
            } else {
                echo "Aucun résultat trouvé pour : " . htmlspecialchars($mot_cle);
            }
        }
    }
    if(isset($_GET['InscripterDansUnCour'])){

         $courRecherche->InscriptionCourEtudiant($_GET['IdCour'],$_GET['IdName']);

    }
    if(isset($_GET['suprimerCourMesCours'])){
       $courRecherche->SuprimerCourinscrepterEtudiant($_GET['IdCour'],$_GET['IdName']);
     
    }
}





// header('Location: /view/home_page.php');
