<?php

class VueIntervention {

    private $_tabinterventions;

    public function __construct($tabInterventions) {
        $this->_tabinterventions = $tabInterventions;
    }

    /*
     * Affiche les interventions qui lui sont soumis
     */

    public function afficherLesInterventions() {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover tablesorter' id='table'>";
        echo "<thead><tr><th>Id</th><th>Reprise Intervention n°</th><th>Appareil</th><th>Technicien</th><th>Date de début</th><th>Symptomes</th><th>Actions</th><th>Date de fin</th></tr></thead>";
        foreach ($this->_tabinterventions as $ln) {
            echo '<tr class="cursor" onclick="document.location.href=\'modifierIntervention.php?id=' . $ln->get_id() . '\'">';
            echo '<td>' . $ln->get_id() . '</td>';
            echo '<td>' . (($ln->get_idIntervention() == "0") ? "Aucune" : $ln->get_idIntervention()) . '</td>';
            echo '<td>' . $ln->get_idAppareil() . '</td>';
            echo '<td>' . $ln->get_idTechnicien() . '</td>';
            echo '<td>' . $ln->get_dateDebut() . '</td>';
            echo '<td>' . $ln->get_symptomes() . '</td>';
            echo '<td>' . $ln->get_actions() . '</td>';
            echo '<td>' . $ln->get_dateFin() . '</td>';
            echo '</tr>';
        }
    }

    /*
     * Affiche le formulaire de modification d'une intervention
     */

    public function AfficherFormModifIntervention() {
        echo '<form role="form" action="modifierIntervention.php?id='.$this->_tabinterventions->get_id().'" method="post">';
        echo '<div class="form-group">
                <label for="Rep_Inter">Reprise Intervention précèdente</label>
                <select class="form-control" id="Rep_Inter" name="Rep_Inter">
                    <option value="0">Non</option>';
        foreach (listerIdInterventions($this->_tabinterventions->get_id()) as $opt) {
            echo $opt;
        }
        echo '  </select>        
              </div>';
        echo '<label>Appareil</label>';
        echo '<p>' . $this->_tabinterventions->get_idAppareil() . '</p>';
        echo '<label>Technicien</label>';
        echo '<p>' . $this->_tabinterventions->get_idTechnicien() . '</p>';
        echo '<label>Date de début</label>';
        echo '<p>' . $this->_tabinterventions->get_dateDebut() . '</p>';
        echo '<label>Symptomes</label>';
        echo '<p>' . $this->_tabinterventions->get_symptomes() . '</p>';
        echo '<div class="form-group">
                <label for="Actions">Actions</label>
                <div>
                    <textarea class="form-control" rows="2" id="Actions" name="actions">' . $this->_tabinterventions->get_actions() . '</textarea>
                </div>
             </div>';
        echo '<div class="form-group">
                <label for="DateFin">Date de fin</label>
                <div>
                    <input type="text" class="form-control" id="DateFin" name="DateFin" placeholder="yyyy-mm-dd hh:mm:ss" value="' . $this->_tabinterventions->get_dateFin() . '">
                </div>
             </div>';
        echo '<button type="submit" class="btn btn-primary">Modifier intervention</button>';
        echo '</form>';
    }

}
