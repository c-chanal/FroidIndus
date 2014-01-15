<?php

class VueAppareil {

    private $_tabappareils;

    public function __construct($tabAppareils) {
        $this->_tabappareils = $tabAppareils;
    }

    /*
     * Affiche les appareils qui lui sont soumis
     */

    public function AfficherLesAppareils() {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover tablesorter' id='table'>";
        echo "<thead><tr><th>Id</th><th>Localisation</th><th>Type</th><th>Référence</th><th>Date d'installation</th></tr></thead>";
        foreach ($this->_tabappareils as $ln) {
            echo '<tr class="cursor" onclick="document.location.href=\'afficherAppareil.php?id='. $ln->get_id() .'\'">';
            echo '<td>' . $ln->get_id() . '</td>';
            echo '<td>' . $ln->get_localisation() . '</td>';
            echo '<td>' . $ln->get_type() . '</td>';
            echo '<td>' . $ln->get_reference() . '</td>';
            echo '<td>' . $ln->get_dateInstall() . '</td>';
            echo '</tr>';
        }
        echo "</table>"; 
        echo "</div>";
    }

    /*
     * Affiche un appareil en fonction de son identifiant
     */

    public function AfficherAppareil() {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover'>";
        echo "<tr><th>Localisation</th><th>Type</th><th>Référence</th><th>Date d'installation</th></tr>";
        echo '<tr>';
        echo '<td>'.$this->_tabappareils->get_localisation() . '</td>';
        echo '<td>'.$this->_tabappareils->get_type() . '</td>';
        echo '<td>'.$this->_tabappareils->get_reference() . '</td>';
        echo '<td>'.$this->_tabappareils->get_dateInstall() . '</td>';
        echo '</tr>';
        echo "</table>"; 
        echo "</div>";
    }
    
    /*
     * Affiche le formulaire de modification d'un apapreil
     */

    public function AfficherFormModifAppareil() {
        echo '<form role="form" action="afficherAppareil.php?id='.$this->_tabappareils->get_id().'" method="post">';
        echo '<div class="form-group">
                <label for="Localisation">Localisation</label>
                <select class="form-control" id="Localisation" name="Localisation">';
                    foreach (listerLesLocalisations() as $opt){
                        echo $opt;
                    }
        echo '  </select>
              </div>';
        echo '<label>Type Appareil</label>';
        echo '<p>'.  $this->_tabappareils->get_type().'</p>';
        echo '<label>Référence</label>';
        echo '<p>'.  $this->_tabappareils->get_reference().'</p>';
        echo '<div class="form-group">
                <label for="DateFin">Date d\'installation</label>
                <div>
                    <input type="text" class="form-control" name="DateInstall" id="DateInstall" placeholder="yyyy-mm-dd" value="'.$this->_tabappareils->get_dateInstall().'">
                </div>
             </div>';
        echo '<button type="submit" class="btn btn-primary">Modifier appareil</button>';
        echo '</form>';
    }

}
