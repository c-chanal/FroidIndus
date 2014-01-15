<?php
/**
 * Classe de controlleur d'appareil(s)
 * 
 * @param $_con : objet-connexion à la base de données
*/
class CtrlAppareil {

    private $_con = null;

    function __construct() {
        $con = ConnectDB();
        $this->_con = $con;
    }

    /*
     * Modifie un appareil
     * Retourne true si la modification à été effectué, sinon false
     */

    public function ModifierAppareil($identifiant, $id_localisation, $date_install) {
        $requete_prepare = $this->_con->prepare('UPDATE appareil SET Localisation_idLocalisation=' . $id_localisation . ', dateInstall=\'' . $date_install . '\' WHERE idAppareil =' . $identifiant);
        $result = $requete_prepare->execute();
        return $result;
    }

    /*
     * Ajouter un appareil
     * Retourne true si l'ajout à été effectué, sinon false
     */

    public function ajouterAppareil($id_localisation, $id_type_app, $reference, $date_install) {
        $date_install = date('Y-m-d', strtotime($date_install));
        if ($date_install != "1970-01-01") {
            $res = $this->_con->prepare('INSERT INTO appareil(Localisation_idLocalisation, TypeAppareil_idTypeAppareil, reference, dateInstall) VALUES (' . $id_localisation . ',' . $id_type_app . ',\'' . $reference . '\',\'' . $date_install . '\')');
            $res->execute();
            return $res;
        }
    }

    /*
     * Retourne la liste de tous les appareils de la base
     */

    public function listerLesAppareils() {
        $requete_prepare = $this->_con->prepare("SELECT a.idAppareil,l.denomination as Localisation,t.designation as Type, a.reference, a.dateInstall FROM appareil as a, localisation as l, typeappareil as t WHERE a.Localisation_idLocalisation = l.idLocalisation AND a.TypeAppareil_idTypeAppareil = t.idTypeAppareil");
        $requete_prepare->execute();

        while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
            $tab[] = new Appareil($lignes->idAppareil, $lignes->Localisation, $lignes->Type, $lignes->reference, $lignes->dateInstall);
        }
        return $tab;
    }

    /*
     * Récupère un appareil de la base selon son identifiant
     */

    public function recupererUnAppareil($identifiant) {
        $requete_prepare = $this->_con->prepare("SELECT a.idAppareil,l.denomination as Localisation,t.designation as Type, a.reference, a.dateInstall FROM appareil as a, localisation as l, typeappareil as t WHERE a.Localisation_idLocalisation = l.idLocalisation AND a.TypeAppareil_idTypeAppareil = t.idTypeAppareil AND a.idAppareil = '$identifiant'");
        if ($requete_prepare->execute()) {
            $lignes = $requete_prepare->fetch(PDO::FETCH_OBJ);
            if ($lignes) {
                $appareil = new Appareil($lignes->idAppareil, $lignes->Localisation, $lignes->Type, $lignes->reference, $lignes->dateInstall);
                return $appareil;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
