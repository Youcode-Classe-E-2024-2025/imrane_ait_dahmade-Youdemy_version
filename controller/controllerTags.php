<?php


class TagControlleur
{
    private TagsModal $TagsModal;

    public function __construct(TagsModal $TagsModal)
    {
        $this->TagsModal = $TagsModal;
    }

    public function RecoverDataToArrayTags()
    {
        $tags = [];


        $TagsData = $this->TagsModal->GetAllTags();
        foreach ($TagsData as $tag) {
            $tags[] = $tag;
        }
        return $tags;
    }
    public function AjouterTags(Cour $cour){
        
     $tags = $cour->gettag();
     
    }
    public function AfficherTags($id){
        return $this->TagsModal->AfficherTagsCour($id);
    }
   
   
}
?>
