<footer class="site-footer">
    <nav class="footer-menu">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer',
            'container' => false,
            'menu_class' => 'menu',
        ));
        ?>
        <p class="all-rights">Tous droits réservés</p>
    </nav>
</footer>
