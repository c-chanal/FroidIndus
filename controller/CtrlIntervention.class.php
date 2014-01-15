<?php
/**
 * Classe de controlleur d'intervention(s)
 * 
 * @param $_con : objet-connexion à la base de données
*/
class CtrlIntervention {

    private $_con = null;

    function __construct() {
        $con = ConnectDB();
        $this->_con = $con;
    }

    /*
     * Retourne la liste de toutes les interventions de la base
     */

    public function listerLesInterventions() {
        $requete_prepare = $this->_con->prepare("SELECT i.idIntervention AS id, i.Intervention_idIntervention AS precint, ty.designation as Appareil, t.nom AS technicien, i.dateDebut, i.symptomes, i.actions, i.dateFin
FROM intervention AS i
LEFT JOIN appareil AS a ON i.Appareil_idAppareil = a.idAppareil
LEFT JOIN typeappareil AS ty ON a.TypeAppareil_idTypeAppareil = ty.idTypeAppareil, technicien AS t
WHERE i.Technicien_idTechnicien = t.idTechnicien
ORDER BY id");
        $requete_prepare->execute();

        while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
            $tab[] = new Intervention($lignes->id, $lignes->precint, $lignes->Appareil, $lignes->technicien, $lignes->dateDebut, $lignes->symptomes, $lignes->actions, $lignes->dateFin);
        }
        return $tab;
    }

    /*
     * Créer une intervention
     * Retourne true si l'ajout à été effectué, sinon false
     */
    
    public function creerIntervention($intervention_id_intervention = 0, $id_appareil, $id_technicien, $date_debut, $symptomes, $actions = null, $date_fin = null) {
        $date_debut = date('Y-m-d H:i:s', strtotime($date_debut));
        $date_fin = date('Y-m-d H:i:s', strtotime($date_fin));;
        if($date_fin == "1970-01-01 00:00:00"){
            $res = $this->_con->prepare('INSERT INTO intervention(Intervention_idIntervention, Appareil_idAppareil, Technicien_idTechnicien, dateDebut, symptomes, actions) VALUES (' . $intervention_id_intervention . ',' . $id_appareil . ',' . $id_technicien . ',\'' . $date_debut . '\',\'' . $symptomes . '\',\'' . $actions . '\')');
        }else{
            $res = $this->_con->prepare('INSERT INTO intervention(Intervention_idIntervention, Appareil_idAppareil, Technicien_idTechnicien, dateDebut, symptomes, actions, dateFin) VALUES (' . $intervention_id_intervention . ',' . $id_appareil . ',' . $id_technicien . ',\'' . $date_debut . '\',\'' . $symptomes . '\',\'' . $actions . '\',\'' . $date_fin . '\')');
        }   
        $res->execute();
        return $res;
    }

    /*
     * Modifie une intervention
     * Retourne true si la modification à été effectué, sinon false
     */

    public function modifierIntervention($identifiant, $intervention_id_intervention, $actions, $date_fin) {
       if($date_fin == "") {
           $requete_prepare = $this->_con->prepare('UPDATE intervention SET Intervention_idIntervention=' . $intervention_id_intervention . ', actions=\'' . $actions . '\', dateFin=NULL WHERE idIntervention =' . $identifiant);
       } else {
           $requete_prepare = $this->_con->prepare('UPDATE intervention SET Intervention_idIntervention=' . $intervention_id_intervention . ', actions=\'' . $actions . '\', dateFin=\'' . $date_fin . '\' WHERE idIntervention =' . $identifiant);
       }
        $result = $requete_prepare->execute();
        return $result;
    }
    
    /*
     * Récupère une intervention de la base selon son identifiant
     */

    public function recupererUneIntervention($identifiant) {
        $requete_prepare = $this->_con->prepare("SELECT i.idIntervention AS id, i.Intervention_idIntervention AS precint, ty.designation as Appareil, t.nom AS technicien, i.dateDebut, i.symptomes, i.actions, i.dateFin
FROM intervention AS i
LEFT JOIN appareil AS a ON i.Appareil_idAppareil = a.idAppareil
LEFT JOIN typeappareil AS ty ON a.TypeAppareil_idTypeAppareil = ty.idTypeAppareil, technicien AS t
WHERE i.Technicien_idTechnicien = t.idTechnicien
AND i.idIntervention = $identifiant
ORDER BY id");
        if ($requete_prepare->execute()) {
            $lignes = $requete_prepare->fetch(PDO::FETCH_OBJ);
            if ($lignes) {
                $intervention = new Intervention($lignes->id, $lignes->precint, $lignes->Appareil, $lignes->technicien, $lignes->dateDebut, $lignes->symptomes, $lignes->actions, $lignes->dateFin);
                return $intervention;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
