<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">FroidIndus</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <?php
        if (isset($_SESSION['nom'])) {
            echo '<ul class="nav navbar-nav">
                    <li><a href="listerAppareils.php">Gérer les appareils</a></li>
                    <li><a href="listerInterventions.php">Gérer les interventions</a></li>
                  </ul>';
        }
        ?>
        <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION['nom'])) {
                echo '
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connecté en tant que ' . $_SESSION['nom'] . ' <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="deconnexion.php"><span class="glyphicon glyphicon-off" style="margin:0px 3px 0px 3px;"></span>Déconnexion</a></li>
                            </ul>
                        </li>
                                ';
            } else {
                echo '
                            <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Connexion <b class="caret"></b></a>
                        <form class = "dropdown-menu" role = "form" method="post" style="padding: 5px;">
                        <div class = "form-group">
                        <label for = "exampleInputEmail1">Identifiant</label>
                        <input type = "text" class = "form-control connexion" id = "exampleInputEmail1" placeholder = "Identifiant" name="id">
                        </div>
                        <div class = "form-group">
                        <label for = "exampleInputPassword1">Mot de passe</label>
                        <input type = "password" class = "form-control connexion" id = "exampleInputPassword1" placeholder = "Mot de passe" name="mdp">
                        </div>
                        <button type = "submit" class = "btn btn-primary">Connexion</button>
                        </form>
                        </li>
                        ';
            }
            ?>
        </ul>
    </div>
</nav>
