<?php

class controllerCategorie{
    private CategorieModal $CategorieModal;

    public function __construct(CategorieModal $CategorieModal)
    {
        $this->CategorieModal = $CategorieModal;
    }

    public function GetAllCategories(): array{
        
        $categories = [];
        $CategorieData = $this->CategorieModal->GetAllCategories();
        foreach($CategorieData as $categorie){
            $Categorie = new Categorie($categorie['NomCategorie'],$categorie['id']);
        
            $categories[] = $categorie;
        }
        return $categories;
    }
    
}

?>