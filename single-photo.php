<?php get_header(); ?>


<?php get_template_part('contact');?>

<div class="container">
    <?php if (have_posts()): ?>
        <?php while (have_posts()):
            the_post(); ?>
            <div class="post">

                <div class="post-info">

                    <h1 class="post-title">
                        <?php the_title(); ?>
                    </h1>
                    <div class="post-details">
                        <p>Référence : <span class="reference" id="ref-photo">
                                <?php echo get_field('reference'); ?>
                            </span></p>
                        <p>Categorie :
                            <?php echo strip_tags(get_the_term_list($post->ID, 'categorie')); ?>
                        </p>
                        <p>Format :
                            <?php echo strip_tags(get_the_term_list($post->ID, 'format')); ?>
                        </p>
                        <p>Type :
                            <?php echo get_field('type'); ?>
                        </p>
                        <p>Année :
                            <?php the_date(' Y'); ?>
                        </p>
                    </div>

                </div>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>


    <div class="sous_partie">
        <p>Cette photo vous intéresse ? </p>
        <button class="contact-btn">Contact</button>

        <div class="arrow-container">
            <div class="arrows">
                <div class="arrows-wrapper">
                    <div class="arrow-left">
                        <?php
                        $previous_post = get_previous_post();
                        $next_post = get_next_post();

                        if ($previous_post) {
                            $previous_post_link = get_permalink($previous_post);
                            echo '<a href="' . $previous_post_link . '"><img src="' . get_template_directory_uri() . '/assets/Line-6.png" alt="Précédent"></a>';
                        }
                        ?>
                    </div>
                    <div class="arrow-right">
                        <?php

                        if ($next_post) {
                            $next_post_link = get_permalink($next_post);
                            echo '<a href="' . $next_post_link . '"><img src="' . get_template_directory_uri() . '/assets/Line-7.png" alt="Suivant"></a>';
                        }
                        ?>
                    </div>
                </div>
                <div class="thumbnail-box">
                    <?php
                    if ($previous_post) {
                        echo '<div class="previous-thumbnail">' . get_the_post_thumbnail($previous_post->ID, 'thumbnail') . '</div>';
                    }
                    if ($next_post) {
                        echo '<div class="next-thumbnail">' . get_the_post_thumbnail($next_post->ID, 'thumbnail') . '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</div>
<div class="photoapp">
    <p>VOUS AIMEREZ AUSSI</p>
    <div class="galerie-container">
        <?php
        $categorie = strip_tags(get_the_term_list($post->ID, 'categorie'));
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $morePhotos = new WP_Query(
            array(
                'post_type' => 'photo',
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 2,
                'paged' => $paged,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'slug',
                        'terms' => $categorie,
                    ),
                ),

            )
        );

        $nombreImagesSimilaires = $morePhotos->post_count;
        if ($nombreImagesSimilaires > 0) {
            while ($morePhotos->have_posts()):
                $morePhotos->the_post();
                ?>
                <div class="overlay-image">
                    <div class="test">
                        <?php the_content();
                        ?>
                    </div>

                    <div class="hover">
                        <img class="full_screen" data-image="<?php echo get_the_post_thumbnail_url(); ?>"
                            src="<?php echo get_template_directory_uri(); ?>/assets/fullscreen.png" alt="full_screen">
                        <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                            <img class="eye" src="<?php echo get_template_directory_uri(); ?>/assets/eye.png" alt="eye">
                        </a>
                        <div class="texte">
                            <div>
                                <?php the_title(); ?>
                            </div>
                            <div style='display:none'>
                                <?php echo get_field('reference'); ?>
                            </div>
                            <div class="right_now">
                                <?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        } else {
            echo '<p class="texte">Il n\'y a plus d\'autres photos à afficher dans cette catégorie.</p>';
        }
        ?>
    </div>
    <div class="btnallphotos">
        <a href="<?php echo home_url() ?>"><button class="lienacc">Toutes les photos </button></a>
    </div>
</div>

<?php get_footer(); ?>