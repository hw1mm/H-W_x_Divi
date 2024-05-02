<?php
/**
 * The function `hw_enqueue_cripts_loginScreen` is used to enqueue a CSS file for the login screen in
 * WordPress.
 */
function hw_enqueue_cripts_loginScreen()
{
    wp_enqueue_style('hw-login-style', get_stylesheet_directory_uri() . '/loginScreen/assets/css/loginScreen.css');
    ?>
    <style>
        #login h1 a,
        .login h1 a {
            background-image: url(<?php echo et_get_option('divi_logo') ?>);
        }
        </style>

<?php
}
add_action('login_enqueue_scripts', 'hw_enqueue_cripts_loginScreen');


/**
 * The function `hw_logonScreen_logoLink` returns the home URL for the login screen logo link in
 * WordPress.
 * 
 * @param url The  parameter is the URL that you want the logo on the login screen to link to.
 * 
 * @return the home URL of the website.
 */
function hw_logonScreen_logoLink($url)
{
    return get_home_url();
}
add_filter('login_headerurl', 'hw_logonScreen_logoLink');



/**
 * The above PHP code disables the language dropdown on the login page and changes the login header
 * title to "Zur Startseite".
 * 
 * @return The function `hw_login_logo_url_title` is returning the string 'Zur Startseite'.
 */
add_filter('login_display_language_dropdown', '__return_false');
function hw_login_logo_url_title()
{
    return 'Zur Startseite';
}
add_filter('login_headertitle', 'hw_login_logo_url_title');
?>
<a class="hw-login-hwLogo" href="https://hw-brand.com" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_stylesheet_directory_uri() ?>/loginScreen/assets/img/logo_hw_white.webp" alt=""></a>
<?php