<?php

class Intervention extends Entite{

    protected $_id;
    protected $_idIntervention;
    protected $_idAppareil;
    protected $_idTechnicien;
    protected $_dateDebut;
    protected $_symptomes;
    protected $_actions;
    protected $_dateFin;

    public function __construct($id, $idIntervention, $idAppareil, $idTechnicien, $dateDebut, $symptomes, $actions, $dateFin) {
        $this->_id = $id;
        $this->_idIntervention = $idIntervention;
        $this->_idAppareil = $idAppareil;
        $this->_idTechnicien = $idTechnicien;
        $this->_dateDebut = $dateDebut;
        $this->_symptomes = $symptomes;
        $this->_actions = $actions;
        $this->_dateFin = $dateFin;
    }
}
