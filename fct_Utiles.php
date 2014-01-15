<?php

/*
 * Connexion à la base de données
 */

function ConnectDB() {
    $PARAM_host = "localhost";
    $PARAM_port = "";
    $PARAM_dbname = "froid_indus";
    $PARAM_user = "root";
    $PARAM_pswd = "";
    try {
        $con = new PDO("mysql:host=$PARAM_host;port=$PARAM_port;dbname=$PARAM_dbname;charset=utf8", $PARAM_user, $PARAM_pswd);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $con;
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur lors de la connexion à la base de données: " . $e->getMessage() . "</div>";
        return false;
    }
}

/*
 * autoload des classes
 */

function __autoload($class_name) {

    if (file_exists('model/' . $class_name . '.class.php'))
        include 'model/' . $class_name . '.class.php';
    else if (file_exists('view/' . $class_name . '.class.php'))
        include 'view/' . $class_name . '.class.php';
    else if (file_exists('controller/' . $class_name . '.class.php'))
        include 'controller/' . $class_name . '.class.php';
}

/**
 * return true si l'authentification a réussi, false sinon
 * @param $id
 * @param $mdp
 * @return boolean
 */

function authentification($id, $mdp) {
    $con = connectDB();
    if ($con) {
        $id = mysql_real_escape_string($id);
        $mdp = mysql_real_escape_string($mdp);
        $requete_prep = $con->prepare("SELECT pswd FROM technicien WHERE identifiant = '$id'");
        if ($requete_prep->execute()) {
            $res = $requete_prep->fetch(PDO::FETCH_OBJ);
            if ($res) {
                if ($mdp == $res->pswd) {
                    $_SESSION['nom'] = ucfirst(strtolower($id));
                    return true;
                }
            }
        }
    }
    return false;
}

/**
 * retourne un tableau des localisations possibles presentes dans la bdd
 * @paramn $id
 * @return 
 */
function listerLesLocalisations($id = 0) {
    $con = connectDB();
    $requete_prepare = $con->prepare("SELECT idLocalisation, denomination FROM localisation");
    $requete_prepare->execute();
    while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
        $tab[] = "<option value='$lignes->idLocalisation'>$lignes->denomination</option>";
    }
    return $tab;
}

/**
 * retourne un tableau des types d'appareils possibles presents dans la bdd
 * @paramn $id
 * @return 
 */
function listerLesTypes() {
    $con = connectDB();
    $requete_prepare = $con->prepare("SELECT idTypeAppareil, designation FROM typeappareil");
    $requete_prepare->execute();
    while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
        $tab[] = "<option value='$lignes->idTypeAppareil'>$lignes->designation</option>";
    }
    return $tab;
}

/**
 * retourne un tableau des interventions possibles presentes dans la bdd
 * @paramn $id
 * @return 
 */
function listerIdInterventions($id = 0) {
    $con = connectDB();
    $requete_prepare = $con->prepare("SELECT idIntervention, Intervention_idIntervention FROM intervention");
    $requete_prepare->execute();
    while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
        if ($id == $lignes->idIntervention && $lignes->Intervention_idIntervention != 0) {
            $tab[] = "<option value='$lignes->idIntervention' selected='selected'>Intervention n°$lignes->Intervention_idIntervention</option>";
        } else {
            $tab[] = "<option value='$lignes->idIntervention'>Intervention n°$lignes->idIntervention</option>";
        }
    }
    return $tab;
}

/**
 * retourne un tableau des localisations possible presentes dans la bdd
 * @paramn $id
 * @return 
 */
function listerNomAppareils() {
    $con = connectDB();
    $requete_prepare = $con->prepare("SELECT a.idAppareil AS id_app, ty.designation AS nom_app FROM appareil AS a, typeappareil AS ty WHERE a.TypeAppareil_idTypeAppareil=ty.idTypeAppareil");
    $requete_prepare->execute();
    while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
        $tab[] = "<option value='$lignes->id_app'>$lignes->nom_app</option>";
    }
    return $tab;
}

/**
 * retourne un tableau des techniciens possibles presents dans la bdd
 * @paramn $id
 * @return 
 */
function listerLesTechniciens() {
    $con = connectDB();
    $requete_prepare = $con->prepare("SELECT idTechnicien, nom FROM technicien");
    $requete_prepare->execute();
    while ($lignes = $requete_prepare->fetch(PDO::FETCH_OBJ)) {
        $tab[] = "<option value='$lignes->idTechnicien'>$lignes->nom</option>";
    }
    return $tab;
}

?>
