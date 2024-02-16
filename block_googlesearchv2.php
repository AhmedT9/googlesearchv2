<?php
// Einbinden der notwendigen Klassendefinition für das Suchformular
require_once(__DIR__ . '/classes/form/search_form.php');

// Definition der Klasse block_googlesearchv2, die von block_base erbt
class block_googlesearchv2 extends block_base {
    // Initialisierungsfunktion des Blocks
    public function init() {
        // Setzen des Titels des Blocks, welcher aus den Sprachdateien geladen wird
        $this->title = get_string('pluginname', 'block_googlesearchv2');
    }

    // Funktion, um den Inhalt des Blocks zu erzeugen
    public function get_content() {
        // Überprüfung, ob der Inhalt bereits gesetzt ist, um Mehrfachverarbeitung zu vermeiden
        if ($this->content !== null) {
            return $this->content;
        }

        // Initialisierung des Inhaltsobjekts
        $this->content = new stdClass;
        $this->content->footer = '';
        $this->content->text = '';

        // Erstellung des Formularobjekts
        $mform = new block_googlesearchv2_form();

        // Anzeigen des Formulars mit Output Buffering, um es in die content->text Variable zu speichern
        ob_start();
        $mform->display();
        $this->content->text .= ob_get_clean();

        // Überprüfen, ob das Formular Daten zurückgibt (nach Absenden)
        if ($fromform = $mform->get_data()) {
             // Verarbeiten der Suchanfrage
             $searchQuery = $fromform->search_query;
             // Erstellen der URL für die Google Custom Search API mit dem Suchbegriff
             $url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyCxb8_Mu7jw70DYI-Xm3lfNNwCpPHZ0lQI&cx=12fb0aa4804a0447e&q=" . urlencode($searchQuery);
             // Konfiguration der HTTP-Optionen für die Anfrage
             $contextOptions = [
                 'http' => [
                     'method' => 'GET',  'header' => "Accept: application/json\r\n"
                 ] ];
             // Erstellen des Kontextes für die file_get_contents-Funktion
             $context = stream_context_create($contextOptions);
             // Durchführen der Anfrage und Speichern des Ergebnisses
             $result = file_get_contents($url, false, $context);
             // Dekodieren des JSON-Antworttextes in ein Array
             $searchResults = json_decode($result, true);

              // Überprüfen auf Fehler bei der Anfrage
              if ($result === FALSE) {
                    // Direktes Parsen des HTTP-Antwortcodes aus der $http_response_header-Variable
                    $responseCode = 0;
                    foreach ($http_response_header as $header) {
                        if (preg_match('/^HTTP\/\d+\.\d+ (\d+)/', $header, $matches)) {
                            $responseCode = intval($matches[1]);
                            break;
                        }
                    }

                    // Behandlung von spezifischen HTTP-Antwortcodes
                    if ($responseCode == 429) {
                        $this->content->text .= 'Für heute sind keine Queries mehr vorhanden';
                        return $this->content;
                    } else {
                        $this->content->text .= 'Beim Durchführen der Suche ist ein Fehler aufgetreten';
                        return $this->content;
                    }
                } 

             // Überprüfen, ob die Suchergebnisse Elemente enthalten
             if (!empty($searchResults['items'])) {
                 // Erstellen der HTML-Ausgabe für die Suchergebnisse
                 $html = '<ul class="google-search-results">';
                 foreach ($searchResults['items'] as $item) {
                     // Parsen des continue-Parameters, falls vorhanden, um die tatsächliche URL zu extrahieren
                     if (strpos($item['link'], 'continue=') !== false) {
                         $parsedUrl = parse_url($item['link']);
                         $queryParams = [];
                         parse_str($parsedUrl['query'], $queryParams);
                         if (isset($queryParams['continue'])) {
                             $item['link'] = urldecode($queryParams['continue']);
                         }
                     }
                     // Hinzufügen des Suchergebnisses zur HTML-Ausgabe
                     $html .= '<li><a href="' . htmlspecialchars($item['link']) . '">' . htmlspecialchars($item['title']) . '</a></li>';
                 }
                    $html .= '</ul>';
                    $this->content->text .= $html;
             } else {
                 // Ausgabe, falls keine Suchergebnisse gefunden wurden
                 $this->content->text .= 'Keine Ergebnisse gefunden.';
             }
         }

        // Rückgabe des Inhalts
        return $this->content;
    }
}
