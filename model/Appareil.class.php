<?php
/**
 * Classe appareil
 * 
 * @param $_id : objet-connexion à la base de données
 * @param $_localisation : 
*/
class Appareil extends Entite{

    protected $_id;
    protected $_localisation;
    protected $_type;
    protected $_reference;
    protected $_dateInstall;

    public function __construct($id, $Localisation, $Type, $reference, $dateInstall) {
        $this->_id = $id;
        $this->_localisation = $Localisation;
        $this->_type = $Type;
        $this->_reference = $reference;
        $this->_dateInstall = $dateInstall;
    }
}
