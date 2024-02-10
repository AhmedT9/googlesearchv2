
<?php
class block_googlesearchv2 extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_googlesearchv2');
    }

    public function get_content() {
    global $PAGE;
    $PAGE->requires->css(new moodle_url('/blocks/googlesearchv2/styles.css'));

    if ($this->content !== null) {
        return $this->content;
    }

    $this->content = new stdClass;
    $this->content->footer = '';

    $form = '<form action="" method="get">
                <input type="text" name="search_query" placeholder="Suchbegriff eingeben">
                <input type="submit" value="Suchen">
             </form>';

    $this->content->text = $form;

    $searchQuery = isset($_GET['search_query']) ? $_GET['search_query'] : '';

    if (!empty($searchQuery)) {
        $url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyAGMxTcZt71NgJlUNNVauOuQqXJNObGL8o&cx=954542981e8a640fb&q=" . urlencode($searchQuery);

        $contextOptions = [
            'http' => [
                'method' => 'GET',
                'header' => "Accept: application/json\r\n"
            ]
        ];
        $context = stream_context_create($contextOptions);
        $result = file_get_contents($url, false, $context);
        $searchResults = json_decode($result, true);

        if (!empty($searchResults['items'])) {
            $html = '<ul class="google-search-results">';
            foreach ($searchResults['items'] as $item) {
                $html .= '<li><a href="' . htmlspecialchars($item['link']) . '">' . htmlspecialchars($item['title']) . '</a></li>';
            }
            $html .= '</ul>';
            $this->content->text .= $html;
        } else {
            $this->content->text .= 'Keine Ergebnisse gefunden.';
        }
    }

    return $this->content;
}

}
