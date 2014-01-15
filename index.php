<!DOCTYPE html>
<?php
session_start();
include_once 'fct_Utiles.php';
if (isset($_POST['id']) && isset($_POST['mdp']) && $_POST['id'] != "" && $_POST['mdp'] != ""){
    $auth = authentification($_POST['id'], hash ("sha512", $_POST['mdp']));
}
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>FroidIndus</title>
    </head>
    <body>
        <?php
        include_once 'navbar.php';
        ?>
        <div class="container">
            <center>
                <?php
                if (isset($_SESSION['nom'])) {

                    echo "
                        <div class='jumbotron'>
                            <h1>Bienvenue, " . $_SESSION['nom'] . "</h1>
                            <p>Que voulez-vous faire aujourd'hui?</p>" . '
                            <div class="btn-group btn-group-lg">
                                <a class="btn btn-primary" href="listerAppareils.php">Gérer les appareils</a>
                                <a class="btn btn-primary" href="listerInterventions.php">Gérer les interventions</a>
                                <a class="btn btn-primary" href="timePicker.php">TimePicker</a>
                            </div>
                        </div>
                    ';
                } else {
                    if (isset($auth) && !$auth) {
                        echo '<div class="alert alert-danger">Erreur lors de l\'authentification.</div>';
                    }
                    echo "
                    <div class='jumbotron'>
                        <h1>FroidIndus</h1>
                        <p>Bienvenue sur FroidIndus. Pour accéder à l'ensemble du contenu disponible, veuillez vous connecter.</p>
                        <p>Froid'Indus est une entreprise assurant la gestion et la maintenance de systèmes de froid industriel pour ses clients : des grandes surfaces, des entreprises de l'industrie agro-alimentaire, des PME du secteur artisanal.</p>
                    </div>
                    ";
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

