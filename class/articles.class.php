<?php

class articles {
    private $id;
    private $titre;
    private $resume;
    private $contenu;
    private $etiquette;
    private $publication;
    private $previsualisation;
    private $archive;
    private $creation;
    


    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setTitre($titre){
        $this->titre = $titre;
        return $this;
    }
    
    public function getTitre(){
        return $this->titre;
    }
    
    public function setResume($resume){
        $this->resume = $resume;
        return $this;
    }
    
    public function getResume(){
        return $this->resume;
    }
    
    public function setContenu($contenu){
        $this->contenu = $contenu;
        return $this;
    }
    
    public function getContenu(){
        return $this->contenu;
    }
    
    public function setEtiquette($etiquette){
        $this->etiquette = $etiquette;
        return $this;
    }
    
    public function getEtiquette(){
        return $this->etiquette;
    }
    
    public function setPublication($publication = 0){
        $publication = ($publication == 1 ) ? 1 : 0;
        $this->publication = $publication;
        return $this;
    }
    
    public function getPublication(){
        return $this->publication;
    }
    
    public function setPrevisualisation($previsualisation = 0){
        $previsualisation = ($previsualisation == 1 ) ? 1 : 0;
        $this->previsualisation = $previsualisation;
        return $this;
    }
    
    public function getPrevisualisation(){
        return $this->previsualisation;
    }
    
    public function setArchive($archive = 0){
        $this->archive = $archive;
        return $this;
    }
    
    public function getArchive(){
        return $this->archive;
    }
    
    public function setCreation(DateTime $date ){     
        $this->creation = $date;
        return $this;
    }
    
    public function getCreation(){
        return $this->creation;
    }
}
