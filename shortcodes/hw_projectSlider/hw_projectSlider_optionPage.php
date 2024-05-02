<?php
// Funktion zur Registrierung der Einstellungsseite
function hw_projectSlider_page() {
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    wp_enqueue_script('hw-slimSelect', 'https://unpkg.com/slim-select@latest/dist/slimselect.min.js', true);
    wp_enqueue_style('hw-slimSelect', 'https://unpkg.com/slim-select@latest/dist/slimselect.css');
    
    wp_enqueue_script('hw-projectSlider-backend', str_replace($document_root, '', __DIR__) . '/assets/js/backend.js', array('hw-slimSelect'));
    
    // Füge die Einstellungsseite als Untermenüpunkt hinzu
    add_submenu_page(
        'edit.php?post_type=project', // slug der übergeordneten Seite (die du in den URLs des Adminbereichs findest)
        'Projektslider', // Seitentitel
        'Slider', // Menütitel
        'manage_options', // Benutzerberechtigung zum Anzeigen der Seite
        'hw_projectSlider-settings', // Slug der Einstellungsseite
        'hw_projectSlider_page_content' // Callback-Funktion zum Rendern der Seite
    );
}
add_action('admin_menu', 'hw_projectSlider_page');

// Callback-Funktion zum Rendern der Einstellungsseite
function hw_projectSlider_page_content() {
    ?>
    <div class="wrap">
        <h2>Projektslider</h2>
        <form method="post" action="options.php">
            <?php
            // Sicherheitsfeld für WordPress-Einstellungen
            settings_fields('hw_projectSlider-settings-group');
            // Ausgabe der Einstellungsfelder
            do_settings_sections('hw_projectSlider-settings');
            ?>
            <input type="submit" class="button-primary" value="Einstellungen speichern">
        </form>
    </div>
    <?php
}

// Funktion zur Registrierung der Einstellungsfelder und -optionen
function hw_projectSlider_init() {
    // Registriere eine Gruppe von Einstellungen
    register_setting('hw_projectSlider-settings-group', 'hw-generalSider');

    // Füge eine Sektion mit Einstellungsfeldern hinzu
    add_settings_section(
        'hw_projectSlider-settings-section', // ID der Sektion
        'Allgemeiner Slider', // Sektionstitel
        'hw_projectSlider_section_callback', // Callback-Funktion zur Ausgabe von Beschreibungstext
        'hw_projectSlider-settings' // Slug der Einstellungsseite
    );

    // Füge das Multiselect-Feld hinzu
    add_settings_field(
        'hw_projectSlider-multiselect-field', // ID des Einstellungsfelds
        'Projekte', // Feldtitel
        'my_custom_multiselect_field_callback', // Callback-Funktion zur Ausgabe des Felds
        'hw_projectSlider-settings', // Slug der Einstellungsseite
        'hw_projectSlider-settings-section' // ID der Sektion, zu der das Feld gehört
    );
}
add_action('admin_init', 'hw_projectSlider_init');

// Callback-Funktion zur Ausgabe der Sektionsbeschreibung
function hw_projectSlider_section_callback() {
    echo '<p>Bitte Alle Projekte Auswählen, die im Allgemeinen Projektslider angezeigt werden sollen.</p>';
}

// Callback-Funktion zur Ausgabe des Multiselect-Felds
function my_custom_multiselect_field_callback() {
    $selected_projects = get_option('hw-generalSider');
    $projects = get_posts(array(
        'numberposts'      => -1,
        'order'            => 'asc',
        'post_type'        => 'project',
    ));
    
    $htmlString = '';
    if (!empty($projects)) {
        $htmlString .= '<select id="hw-generalSider" multiple name="hw-generalSider[]">';
        foreach ($projects as $key => $project) {
            $selected = (in_array($project->ID, $selected_projects)) ? 'selected' : '';
            $htmlString .= '<option value="' . $project->ID . '"'. $selected.'>' . $project->post_title . '</option>';
        }
        $htmlString .= '</select>';
    }

    echo $htmlString;
}
