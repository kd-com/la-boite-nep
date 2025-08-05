<?php 

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' ); 

function my_enqueue_assets() { 

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');

}
// Enqueue Swiper.js Library
      function dp_carousel(){
        wp_enqueue_script( 'your-swiper-js-slug', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [] , '7.4.1', true );
        wp_enqueue_style( 'your-swiper-css-slug', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [] , '7.4.1');
       
        
       }
       add_action('init', 'dp_carousel', 99);
	// Déclarer un autre fichier JS
add_action( 'wp_enqueue_scripts', 'custom_enqueue_script' );
      function custom_enqueue_script() {
            wp_enqueue_script( 'script', get_bloginfo( 'stylesheet_directory' ) . '/script.js', 
            array( 'jquery' ), '', true );
      }



// VOIR LA CATEGORIE PRODUIT SUR LA PAGE BOUTIQUE
add_action( 'woocommerce_before_shop_loop_item_title', 'add_categoryname_product_loop', 25);
function add_categoryname_product_loop()
{
    global $product;
    $product_cats = wp_get_post_terms($product->id, 'product_cat');
    $count = count($product_cats);
    foreach($product_cats as $key => $cat)
    {
        echo 
        '
        '.$cat->name.'';
        if($key < ($count-1))
        {
            echo ' ';
        }
        else
        {
            echo ' ';
        }
    }
}

function mytheme_setup_theme_supported_features() {

  // penser à changer les couleurs dans style.scss...

  add_theme_support( 'editor-color-palette',
    array(
      array( 'name' => 'couleur theme 1', 'slug'  => 'couleur_theme_1', 'color' => '#13454A' ),
      array( 'name' => 'couleur theme 2', 'slug'  => 'couleur_theme_2', 'color' => '#2D9697' ),
      array( 'name' => 'couleur theme 3', 'slug'  => 'couleur_theme_3', 'color' => '#CCA13F' ),
      array( 'name' => 'couleur theme 4', 'slug'  => 'couleur_theme_4', 'color' => '#fff'),
    )
  );
}
add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );

// DESACTIVATION DES COULEURS PERSO DANS GUTEMBERG
add_theme_support('disable-custom-colors');
// DESACTIVATION DES DÉGRADÉS
add_theme_support( 'disable-custom-gradients' );
add_theme_support( 'editor-gradient-presets', array() );

// VOIR LA DESCRIPTION COURTE SUR LA PAGE BOUTIQUE
add_action( 'woocommerce_after_shop_loop_item', 'woo_show_excerpt_shop_page', 5 );
function woo_show_excerpt_shop_page() {
	global $product;

	echo $product->post->post_excerpt;
}
// VOIR LE BOUTON AJOUTER AU PANIER SUR LA PAGE BOUTIQUE
function wnc_add_cart_button () {

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
}

add_action( 'after_setup_theme', 'wnc_add_cart_button' );

// LOGO PERSO SUR PAGE CONNEXION ADMIN

function my_custom_login_logo() {
echo '<style type="text/css">
h1 a { background-image:url('.get_bloginfo('stylesheet_directory').'/img/custom-login-logo.png) !important; }
</style>';
}
add_action('login_head', 'my_custom_login_logo');


// ajout bloc sur dashboard wp
// Register our custom dashboard widget.
function kdcom_add_my_dashboard_widget() {
  wp_add_dashboard_widget( 
    "kdcom_guide-utilisation",
    "Un problème, une question ?",
    "kdcom_render_my_dashboard_widget"
  );

  // Force this widget to the top.
  global $wp_meta_boxes;

  // Make a backup of the current instance of our widget.
  $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
  $widget_backup = array( 'kdcom_guide-utilisation' => $normal_dashboard['kdcom_guide-utilisation'] );

  // Now remove the original widget from the array.
  unset( $normal_dashboard['kdcom_guide-utilisation'] );

  // Merge the two arrays together so our widget is at the top.
  $sorted_dashboard = array_merge( $widget_backup, $normal_dashboard );
  $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
// Add the function to the 'wp_dashboard_setup' action to make sure it executes after the theme.
add_action( 'wp_dashboard_setup', 'kdcom_add_my_dashboard_widget' );

// Create the function to output the contents of our Dashboard Widget.
function kdcom_render_my_dashboard_widget () {
  // The code to render your widget goes here...
  echo '<p><strong>Bienvenue sur votre site internet !</strong></p>';
  echo '<p>Vous trouverez sur le lien suivant le guide d\'utilisation pour la gestion de votre site internet<br><a href="https://drive.google.com/file/d/1QI8VUgcHHlLdFSOurW__Y2fZ9Gtvk82B/view?usp=share_link" target="_blank">Télécharger votre guide</a></p>';
  echo '<p>Besoin d\'aide ? Contactez KD-COM <a href="mailto:contact@kd-com.fr">en cliquant ici</a>.</p>';
}

// AJOUT DE TARTEAUCITRON
function kd_tarteaucitron_load() {
  if ( ! is_user_logged_in() )
    wp_enqueue_script( 'tarteaucitron', 'https://cdn.jsdelivr.net/npm/tarteaucitronjs@1.9.9/tarteaucitron.min.js' );
} 
add_action( 'wp_enqueue_scripts', 'kd_tarteaucitron_load' );

// configuration tarteaucitron
function kd_tarteaucitron_config() {
  ?>
    <script type="text/javascript">
        tarteaucitron.init({
        "privacyUrl": "/mentions-legales/", /* Privacy policy url */
        "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */

        "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
        "cookieName": "tarteaucitron", /* Cookie name */
    
        "orientation": "bottom", /* Banner position (top - bottom) */
       
          "groupServices": true, /* Group services by category */
          "serviceDefaultState": "wait", /* Default state (true - wait - false) */
                           
        "showAlertSmall": false, /* Show the small banner on bottom right */
        "cookieslist": false, /* Show the cookie list */
                           
          "closePopup": false, /* Show a close X on the banner */

          "showIcon": false, /* Show cookie icon to manage cookies */
          //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
          "iconPosition": "BottomLeft", /* BottomRight, BottomLeft, TopRight and TopLeft */

        "adblocker": false, /* Show a Warning if an adblocker is detected */
                           
          "DenyAllCta" : true, /* Show the deny all button */
          "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
          "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
                           
        "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

        "removeCredit": false, /* Remove credit link */
        "moreInfoLink": true, /* Show more info link */

          "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
          "useExternalJs": false, /* If false, the tarteaucitron.js file will be loaded */

        //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
                          
          "readmoreLink": "", /* Change the default readmore link */

          "mandatory": true, /* Show a message about mandatory cookies */
          "mandatoryCta": true /* Show the disabled accept button when mandatory on */
        });
    </script>
  <?php
}
add_action('wp_head', 'kd_tarteaucitron_config');

// ajout des services
function kd_tarteaucitron_services() {
  ?>
    <script type="text/javascript">
      
        tarteaucitron.user.googletagmanagerId = 'GTM-M4XPMD9F';
        (tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');

        tarteaucitron.user.gtagUa = 'G-8057RC6GLP';
        // tarteaucitron.user.gtagCrossdomain = ['example.com', 'example2.com'];
        tarteaucitron.user.gtagMore = function () { /* add here your optionnal gtag() */ };
        (tarteaucitron.job = tarteaucitron.job || []).push('gtag');

        tarteaucitron.user.googleadsId = 'AW-11428636863';
        (tarteaucitron.job = tarteaucitron.job || []).push('googleads');
        

    </script>
  <?php 
}
add_action('wp_footer', 'kd_tarteaucitron_services');

// ajout du module slider accueil
//include 'module_admin/slider_accueil.php';
//include 'module_front/slider_page_accueil.php';
// CREATION DU MODULE SLIDER PAGE D'ACCUEIL
function create_slider_accueil() {       


        // SLIDER PAGE D'ACCUEIL

  $labels = array(
    'name' => 'Slider page d\'accueil'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'exclude_from_search' => true, // the important line here!
    'has_archive' => false,
          'show_in_rest' => true, //important !
          'supports' => array('title'),
          'menu_position' => 2,
          'menu_icon' => 'dashicons-tagcloud',

        );
  register_post_type('slider', $args);
}
add_action('init', 'create_slider_accueil' );

include 'module_front/slider_page_accueil.php';

// desactiver gutenberg sur la page d'accueil
function disable_block_editor_for_page_ids( $use_block_editor, $post ) {

  $acf_accueil = 227;
  $excluded_ids = array( $acf_accueil);
  if ( in_array( $post->ID, $excluded_ids ) ) {
    return false;
  }
  return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'disable_block_editor_for_page_ids', 10, 2 );   



?>