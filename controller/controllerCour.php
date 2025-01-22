<?php

class CourContrller
{

    private CourModal $CourModal;

    public function __construct(CourModal $CourModal)
    {
        $this->CourModal = $CourModal;
    }

    public function AffichageCours()
    {
        $Cours = $this->CourModal->affichagesCours();
        return $Cours;
    }
    public function AffichageCoursWithPagination()
    {
        $elementParPage = 4;


        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $Offest = ($page - 1) * $elementParPage;
        $Cours = $this->CourModal->affichagesCoursWithPagination($elementParPage, $Offest);
        $totalCours = $this->CourModal->GetTotalCour();
        $totalPages = ceil($totalCours / $elementParPage);
        return [$Cours, $totalPages, $page];
    }
    public function rechercheController($motcle)
    {

        $totalCours = $this->CourModal->GetTotalCour();

        $elementParPage = 4;
        $totalPages = ceil($totalCours / $elementParPage);

        if ($motcle) {

            $Cours = $this->CourModal->rechercheCour($motcle);
            return $Cours;
        } else {

            echo "echo";
        }
    }

    public function AjouterCourVideo(CourVideo $courVideo)
    {

        $video = $courVideo->getVideo();
        $NomCour = $courVideo->getNomCour();
        $Description = $courVideo->getDescription();
        $image = $courVideo->getImage();
        $Enseignant = $courVideo->getEnseignant();
        $categorie = $courVideo->getCategorie();
        $tags = $courVideo->gettag();
        


        $Cour = new CourVideo($NomCour,$Description,$image,$categorie,$Enseignant,$tags,$video);

        return $this->CourModal->ajouterCour($Cour);
    }
    public function AjouterCourDocument(CourDocument $courDocument){
        return $this->CourModal->ajouterCour($courDocument);
    }
    
    public function AffichageCoursEnseignant($id)
    {

        $Cours = $this->CourModal->affichagesCoursEnseignant($id);
        return $Cours;
    }
    public function AfficheCour($id){
        $cour =$this->CourModal->affichageCour($id);
        
        return $cour;
    }
    public function InscriptionCourEtudiant($idCour,$idUser): void{
     $this->CourModal->AjouterInscriptionBd($idCour,$idUser);
    }
    public function AffichageMesCourEtudiant($idUser){
        return $this->CourModal->AffichageMesCoursEtudiant($idUser);
    }
    public function SuprimerCourinscrepterEtudiant(int  $idUser, int $idCour){
        $this->CourModal->suprimerCourInscreptionEtudiant($idUser,$idCour);
       
    }


}
