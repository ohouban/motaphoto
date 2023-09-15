<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<?php get_template_part('contact');?>

<body>
    <header class="site-header">
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Logo du site">
            </a>
        </div>
                
        <button id="menu-toggle" class="menu-toggle" aria-controls="main-menu" aria-expanded="false" >
            <span class="menu-icon"></span>
            <span class="menu-icon"></span>
            <span class="menu-icon"></span>
        </button>
        <nav class="main-menu">
            <?php
            wp_nav_menu([
                'theme_location' => 'header',
                'container' => false,
                'menu_class' => 'menu',
                ]);
            ?>
            <ul>
            <li><a href="#" id="myBtn" class="contact-btn contact-item" role="button" data-toggle="modal">CONTACT</a></li>
            <ul>
        </nav>
       
    </header>
            

