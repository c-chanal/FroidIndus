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
        <title>Lister les appareils</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li class="active"><a href="#">Lister les appareils</a></li>
                <li><a href="ajouterAppareil.php">Ajouter un appareil</a></li>
            </ul>
            <center class="custom-back">
                <h1>Liste des Appareils</h1>
                <form action="afficherAppareil.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Id" name="id" identifiant="id">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
                <p class="help-block">Pour afficher ou modifier un appareil, cliquer sur la ligne correspondante ou saissisez son identifiant dans la barre de recherche.</p>
                <?php
                $ctrl_app = new CtrlAppareil();
                $tab_app = $ctrl_app->listerLesAppareils();
                $vue_app = new VueAppareil($tab_app);
                $vue_app->AfficherLesAppareils();
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


