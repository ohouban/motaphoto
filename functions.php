<?php


function theme_enqueue_styles()
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'motaphoto-js',get_stylesheet_directory_uri(). '/js/script.js' );
    wp_enqueue_script( 'motaphoto-lightbox-js',get_stylesheet_directory_uri(). '/js/lightbox.js' );
    wp_enqueue_script( 'motaphoto-contact-js',get_stylesheet_directory_uri(). '/js/contact.js' );
    wp_enqueue_style('motaphoto-css', get_stylesheet_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('motaphoto-lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.css', array(), '1.0', 'all');
    wp_enqueue_style('motaphoto-contact-css', get_stylesheet_directory_uri() . '/css/contact.css', array(), '1.0', 'all');
    wp_enqueue_style('motaphoto-single-photo-css', get_stylesheet_directory_uri() . '/css/single-photo.css', array(), '1.0', 'all');

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@1,400;1,700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function motaphoto_supports(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}

function motaphoto_register_assets(){
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

function motaphoto_menu_class($classes){
    $classes[] = 'nav-item';
    return $classes;
}

function motaphoto_menu_link_class($attrs){
    $attrs['class'] = 'nav-link';
    return $attrs;
}

add_action('after_setup_theme','motaphoto_supports');
add_action('wp_enqueue_script','motaphoto_register_assets');
add_filter('nav_menu_css_class', 'motaphoto_menu_class');
add_filter('nav_menu_link_attributes', 'motaphoto_menu_link_class');

function add_cors_http_header(){
    header('Access-Control-Allow-Origin: *');
    }
add_action('init','add_cors_http_header');

function filtre(){
  $filtrajax = new WP_Query([
    'post_type' => 'photo',
    'orderby'  => 'date',
    'order' => $_POST['post_ordre'],
    'paged' => $_POST['paged'],
    'posts_per_page' => 12,
    'tax_query' => array(
      $_POST['categorie'] !="all" ?
      array(
         'taxonomy' =>'categorie' ,
         'field'    => 'slug',
         'terms'    => $_POST['categorie'],
      )
      :'',
      $_POST['post_format'] !="all" ?
      array(
        'taxonomy' => 'format' ,
        'field'    => 'slug',
        'terms'    => $_POST['post_format'],
      )
      :'',
    )
  ]);

  if($filtrajax->have_posts()) : 
    while($filtrajax->have_posts()) : 
      $filtrajax->the_post();?>       
            <div class="overlay-image">
                  <?php the_content(); ?>
                <div class=hover>
                   <img class="full_screen" data-image="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri(); ?>./assets/fullscreen.png" alt="full_screen">
                   <a href="<?php echo get_the_permalink(get_the_ID());?>">
                     <img class="eye" src="<?php echo get_template_directory_uri(); ?>./assets/eye.png" alt="eye">
                   </a>
                   <div class="texte">
                     <div> <?php the_title(); ?></div>
                      <div class="right_now"><?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie'));?></div>
                   </div>
                </div>  
           </div>
    <?php endwhile; ?>
  <?php endif; 
    wp_reset_postdata();

    die();
}
add_action('wp_ajax_filtre', 'filtre');
add_action('wp_ajax_nopriv_filtre', 'filtre');
?>

<?php
function ajoutCategorie(){
if($terms = get_terms(array(
  'taxonomy' =>'categorie' ,
  'field'    => 'slug',
 'terms'    => $_POST['categorie'],
)))
foreach ($terms as $term){
  echo '<option  value="'.$term->slug.'">'.$term ->name.'</option>';
}
}

function ajoutFormat(){
  if($terms = get_terms(array(
    'taxonomy' =>'format' ,
    'field'    => 'slug',
   'terms'    => $_POST['post_format'],
  )))
  foreach ($terms as $term){
    echo '<option  value="'.$term->slug.'">'.$term ->name.'</option>';
  }
  }

function ajoutOrderDirection(){
  if ($order_options = (array(
      'DESC' => 'Les plus récentes',
      'ASC' => 'Les plus anciennes',
    )))
    foreach( $order_options as $value => $label ) {
        echo "<option ".selected( $_POST['tri'], $value )." value='$value'>$label</option>";
    }
  }



?>

