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
        <title>Ajouter une Intervention</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li><a href="listerInterventions.php">Lister les interventions</a></li>
                <li class="active"><a href="#">Ajouter une intervention</a></li>
            </ul>
            <center class="custom-back">
                <?php
                if (!empty($_POST['DateDeb']) && !empty($_POST['symptomes']) && isset($_POST['actions']) && isset($_POST['DateFin'])) {
                    if (strtotime($_POST['DateDeb']) <= time() && date('Y-m-d H:i:s', strtotime($_POST['DateDeb'])) != "1970-01-01 00:00:00" && ((strtotime($_POST['DateFin']) <= time() && date('Y-m-d H:i:s', strtotime($_POST['DateFin'])) != "1970-01-01 00:00:00") || $_POST['DateFin'] == "")) {
                        $int = new CtrlIntervention();
                        $int->creerIntervention($_POST['Rep_Inter'], $_POST['Appareil'], $_POST['Technicien'], $_POST['DateDeb'], $_POST['symptomes'], $_POST['actions'], $_POST['DateFin']);
                        header("location:listerInterventions.php");
                    } else {
                        echo "<div class='alert alert-danger'>Les dates renseignées ne sont pas correctes. Assurez-vous de respecter le format de date, et que les dates sont cohérentes.</div>";
                    }
                }
                if (isset($_POST['DateDeb']) && empty($_POST['DateDeb'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner la date du début de l'intervention.</div>";
                }
                if (isset($_POST['symptomes']) && empty($_POST['symptomes'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner les symptomes qui ont causés l'intervention.</div>";
                }
                if (isset($_POST['actions']) && empty($_POST['actions'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner les actions effectuées lors de l'intervention.</div>";
                }
                ?>
                <h1>Ajouter une Intervention</h1>
                <form role="form" method="post" action="ajouterIntervention.php">
                    <div class="form-group">
                        <label for="Rep_Inter">Reprise Intervention précèdente</label>
                        <select class="form-control" id="Rep_Inter" name="Rep_Inter">
                            <option value="0">Non</option>
                            <?php
                            foreach (listerIdInterventions() as $opt) {
                                echo $opt;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Appareil">Appareil</label>
                        <select class="form-control" id="Appareil" name="Appareil">
                            <?php
                            foreach (listerNomAppareils() as $opt) {
                                echo $opt;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Technicien">Technicien</label>
                        <select class="form-control" id="Technicien" name="Technicien">
                            <?php
                            foreach (listerLesTechniciens() as $opt) {
                                echo $opt;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="DateDébut">Date de début</label>
                        <div>
                            <input type="text" class="form-control" id="DateDébut" placeholder="yyyy-mm-dd hh:mm:ss" name="DateDeb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Symptomes">Symptomes</label>
                        <div>
                            <textarea class="form-control" rows="2" id="Symptomes" name="symptomes"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Actions">Actions</label>
                        <div>
                            <textarea class="form-control" rows="2" id="Actions" name="actions"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="DateFin">Date de fin</label>
                        <div>
                            <input type="text" class="form-control" id="DateFin" placeholder="yyyy-mm-dd hh:mm:ss" name="DateFin">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter intervention</button>
                </form>
            </center>
        </div>
        <?php
        include_once 'footer.php';
        ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>



