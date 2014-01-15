<!DOCTYPE html>
<?php
session_start();
include_once 'fct_Utiles.php';
if (!isset($_SESSION['nom'])) {
    header("location:index.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Modifier une intervention</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li class="active"><a href="listerInterventions.php">Lister les interventions</a></li>
                <li><a href="ajouterIntervention.php">Ajouter une intervention</a></li>
            </ul>
            <center class="custom-back">
                <?php
                if (isset($_POST['actions'])&& isset($_POST['DateFin'])) {
                    if ((strtotime($_POST['DateFin']) <= time() && date('Y-m-d H:i:s', strtotime($_POST['DateFin'])) != "1970-01-01 00:00:00") || $_POST['DateFin']=="") {
                        $ctr_int = new CtrlIntervention();
                        if (!empty($_GET['id'])) {
                            $ctr_int->modifierIntervention($_GET['id'],$_POST['Rep_Inter'], $_POST['actions'], $_POST['DateFin']);
                            header("location:listerInterventions.php");
                        } else {
                            echo "<div class='alert alert-danger'>Aucune intervention à modifier.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Date au mauvais format, ou date incohérente.</div>";
                    }
                }

                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $ctrl_int = new CtrlIntervention();
                    $int = $ctrl_int->recupererUneIntervention($id);
                    if ($int) {
                        echo '<h1>Modifier Intervention n° ' . $id . '</h1>';
                        $vue_int = new VueIntervention($int);
                        $vue_int->AfficherFormModifIntervention();
                    } else {
                        echo '<h1>L\'intervention à modifié n\'existe pas</h1>';
                    }
                } else {
                    echo '<h1>Pas d\'intervention à modifier</h1>';
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


