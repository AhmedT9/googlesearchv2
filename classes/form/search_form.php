<?php
// Einbinden der notwendigen Moodle-Formularbibliothek
require_once("$CFG->libdir/formslib.php");

// Definition der Formularklasse für den Google-Suchblock v2, die von moodleform erbt
class block_googlesearchv2_form extends moodleform {
    // Hinzufügen von Elementen zum Formular
    public function definition() {
        global $CFG; // Zugriff auf globale Konfiguration
        global $PAGE; // Zugriff auf die globale PAGE-Instanz, um Anforderungen, wie CSS, zu handhaben

        // Einbinden der CSS-Datei für das Formular
        $PAGE->requires->css(new moodle_url('/blocks/googlesearchv2/classes/form/styles.css'));

        $mform = $this->_form; // Kurzform, um auf das Formularobjekt zuzugreifen

        // Hinzufügen eines Textfeldes für die Suchanfrage
        // Die Funktion get_string wird hier mit einem leeren Schlüssel aufgerufen, was unüblich ist und normalerweise einen Beschreibungstext liefern sollte
        $mform->addElement('text', 'search_query', get_string('', 'block_googlesearchv2'), array('class' => 'my-custom-input', 'placeholder' => 'Suchbegriff eingeben'));
        // Festlegen des Typs des Suchfeldes, um sicherzustellen, dass keine HTML-Tags übermittelt werden
        $mform->setType('search_query', PARAM_NOTAGS);

        // Hinzufügen eines Absendebuttons für die Suchanfrage
        $mform->addElement('submit', 'submitbutton', get_string('suchen', 'block_googlesearchv2'), array('class' => 'my-custom-submit'));
    }
}

