<?php

class Technicien extends Entite{
    private $id;
    private $nom;
    
    public function __construct($id, $nom) {
        $this->_id = $id;
        $this->_nom = $nom;
    }
    
}
