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
        <title>Lister les interventions</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li class="active"><a href="#">Lister les interventions</a></li>
                <li><a href="ajouterIntervention.php">Ajouter une intervention</a></li>
            </ul>
            <center class="custom-back">
                <h1>Liste des Interventions</h1>
                <p class="help-block">Pour modifier une intervention, cliquer sur la ligne correspondante.</p>
                <?php
                $ctrl_int = new CtrlIntervention();
                $tab_int = $ctrl_int->listerLesInterventions();
                $vue_int = new VueIntervention($tab_int);
                $vue_int->afficherLesInterventions();
                ?>
            </center>
        </div>
        <?php
        include_once 'footer.php';
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#table").tablesorter();
            });
        </script>
    </body>
</html>


