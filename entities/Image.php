<?php

class Image {
    private $imageName;
    private $imageTmpName;
    private $imageError;

    // Constructeur
    public function __construct($imageName, $imageTmpName, $imageError) {
        $this->imageName = $imageName;
        $this->imageTmpName = $imageTmpName;
        $this->imageError = $imageError;
    }

    // Getter pour imageName
    public function getImageName() {
        return $this->imageName;
    }

    // Getter pour imageTmpName
    public function getImageTmpName() {
        return $this->imageTmpName;
    }

    // Getter pour imageError
    public function getImageError() {
        return $this->imageError;
    }
}


?>