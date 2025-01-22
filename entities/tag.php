<?php
    class Tag{
        private $IdTag;
        private $NomTag;

        public function __construct($NomTag)
        {
            $this->NomTag = $NomTag;
        }
        public function GetTag(){
                return $this->NomTag ;

        }
        public function GetId(){
            return $this->IdTag;
        }
        
    }

?>