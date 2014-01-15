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
        <title>Ajouter un appareil</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container custom-back">
            <ul class="nav nav-pills">
                <li><a href="listerAppareils.php">Lister les appareils</a></li>
                <li class="active"><a href="#">Ajouter un appareil</a></li>
            </ul>

            <center class="custom-back">
                <?php
                if (!empty($_POST['Reference']) && !empty($_POST['DateInstall'])) {
                    if (strtotime($_POST['DateInstall']) <= time() && date('Y-m-d', strtotime($_POST['DateInstall'])) != "1970-01-01") {
                        $ap = new CtrlAppareil();
                        $ap->ajouterAppareil($_POST['Localisation'], $_POST['Type'], $_POST['Reference'], $_POST['DateInstall']);
                        header("location:listerAppareils.php");
                    } else {
                        echo "<div class='alert alert-danger'>La date d'installation n'est pas correcte.</div>";
                    }
                }
                if (isset($_POST['Reference']) && empty($_POST['Reference'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner la Référence de l'appareil.</div>";
                }
                if (isset($_POST['DateInstall']) && empty($_POST['DateInstall'])) {
                    echo "<div class='alert alert-danger'>Veuillez renseigner la date d'installation de l'appareil.</div>";
                }
                ?>
                <h1>Ajouter un Appareil</h1>
                <form role="form" method="post" action="ajouterAppareil.php">
                    <div class="form-group">
                        <label for="Localisation">Localisation</label>
                        <select class="form-control" id="Localisation" name="Localisation">
                            <?php
                            foreach (listerLesLocalisations() as $opt) {
                                echo $opt;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Type">Type Appareil</label>
                        <select class="form-control" id="Type" name="Type">
                            <?php
                            foreach (listerLesTypes() as $opt) {
                                echo $opt;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputReference">Reference</label>
                        <div>
                            <input type="text" class="form-control" id="inputReference" placeholder="Référence" name="Reference">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDate">Date d'installation</label>
                        <div>
                            <input type="text" class="form-control" id="inputDate" placeholder="yyyy-mm-dd" name="DateInstall">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter appareil</button>
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



