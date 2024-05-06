<?php
add_action('admin_menu', 'rudr_top_lvl_menu');

function rudr_top_lvl_menu()
{
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    // wp_enqueue_style('hw-stimmen-style', plugins_url('/assets/css/stimmen.min.css', __FILE__));
    // wp_enqueue_script('hw-stimmen-script', plugins_url('/assets/js/stimmen.js', __FILE__));
    wp_enqueue_script('hw-medialibrary-script', str_replace($document_root, '', get_stylesheet_directory()) . '/defaultSettings/assets/js/mediaLibrary.js', '', '', true);


    // add_menu_page(
    //     'Felss Career', // page <title>Title</title>
    //     'Felss Career', // link text
    //     'manage_options', // user capabilities
    //     'felss-career', // page slug
    //     'hw_teamOverview_page_content', // this function prints the page content
    //     'dashicons-groups', // icon (from Dashicons for example)
    //     90 // menu position
    // );

    add_submenu_page(
        'edit.php?post_type=person', // slug der übergeordneten Seite (die du in den URLs des Adminbereichs findest)
        'Teamseite', // Seitentitel
        'Teamseite', // Menütitel
        'manage_options', // Benutzerberechtigung zum Anzeigen der Seite
        'hw_teamOverview-settings', // Slug der Einstellungsseite
        'hw_teamOverview_page_content' // Callback-Funktion zum Rendern der Seite
    );
}

function hw_teamOverview_page_content()
{
?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title() ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('hw_felss_career_stimme'); // settings group name
            do_settings_sections('rudr_slider'); // just a page slug
            submit_button(); // "Save Changes" button
            ?>
        </form>
    </div>
<?php
}

add_action('admin_init',  'hw_felss_career_stimme_fields');
function hw_felss_career_stimme_fields()
{

    // I created variables to make the things clearer
    $page_slug = 'rudr_slider';
    $option_group = 'hw_felss_career_stimme';

    // 1. create section
    add_settings_section(
        'hw-teamOverview-break', // section ID
        'Brecher', // title (optional)
        '', // callback function to display the section (optional)
        $page_slug
    );

    // 2. register fields

    // 3. add fields
    for ($i = 0; $i < 4; $i++) {
        // Videos
        register_setting($option_group, 'hw_teamOverview_' . $i);
        register_setting($option_group, 'hw_teamOverview_break_' . $i);
        add_settings_field(
            'hw_teamOverview_' . $i,
            'Brecher ' . ($i + 1),
            'hw_teamOverview_break', // function to print the field
            $page_slug,
            'hw-teamOverview-break', // section ID
            array(
                'class' => 'hello', // for <tr> element
                'name' => 'hw_teamOverview_' . $i, // pass any custom parameters
                'nameBreak' => 'hw_teamOverview_break_' . $i, // pass any custom parameters
            )
        );
    }
}


function hw_teamOverview_break($args)
{
?>
    <div class="hw-teamOverview-break">
        <?php
        printf(
            '<input type="text" id="%s" name="%s" value="%s"/>',
            $args['nameBreak'],
            $args['nameBreak'],
            get_option($args['nameBreak'])
        );
        printf(
            '<input type="button" value="Bild auswählen" class="image-upload-button" data-input="%s" />',
            $args['nameBreak']
        );
        ?>
    </div>
    <?php
    printf(
        '<img width="320" height="auto" data-input="%s" src="%s">',
        $args['nameBreak'],
        get_option($args['nameBreak']),
    );
}
