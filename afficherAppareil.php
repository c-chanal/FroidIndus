<!DOCTYPE html>
<?php
session_start();
include_once 'fct_Utiles.php';
if(!isset($_SESSION['nom'])){
    header("location:index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Afficher un appareil</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li><a href="listerAppareils.php">Lister les appareils</a></li>
                <li><a href="ajouterAppareil.php">Ajouter un appareil</a></li>
            </ul>
            <center class="custom-back">
                <?php
                if(!empty($_POST['DateInstall'])) {
                    if(strtotime($_POST['DateInstall'])<= time() && date('Y-m-d', strtotime($_POST['DateInstall']))!= "1970-01-01") {
                        $ctr_app = new CtrlAppareil();
                        if(!empty($_GET['id'])) {
                        $ctr_app->ModifierAppareil($_GET['id'], $_POST['Localisation'], $_POST['DateInstall']);
                        header("location:listerAppareils.php");
                        } else {
                            echo "<div class='alert alert-danger'>Aucun appareil à modifier.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Date au mauvais format, ou date incohérente.</div>";
                    }
                }
                if(isset($_POST['DateInstall']) && empty($_POST['DateInstall'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner une nouvelle date d'installation.</div>";
                }
                
                
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $ctrl_app = new CtrlAppareil();
                    $app = $ctrl_app->recupererUnAppareil($id);
                    if ($app) {
                        echo '<h1>Appareil n&deg; ' . $id . '</h1>';
                        $vue_app = new VueAppareil($app);
                        $vue_app->AfficherAppareil();
                        $vue_app->AfficherFormModifAppareil();
                    } else {
                        echo '<h1>L\'appareil recherché n\'existe pas</h1>';
                    }
                } else{
                    echo '<h1>Pas d\'appareil recherché</h1>';
                }
                ?>
            </center>
        </div>
        <?php
        include_once 'footer.php';
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

