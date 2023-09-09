<?php get_header() ?>
   <div class="hero">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/nathalie-0.jpeg" alt="Image d'en-tête">
      <div class="hero-content">
         <h1>Photographe Event</h1>
      </div>
   </div>
   <div class="post-filters">
    <div>
        <label for="cat-select">Catégories</label>

     <select name="cat" id="cat-select">
            <option value="all"></option>
         <?php echo ajoutCategorie();?>
     </select>
    </div>
    <div class="adjust">
        <label for="form-select">Formats</label>
        <select name="form" id="form-select">
          <option value="all"></option>
         <?php echo ajoutFormat();?>
        </select>
    </div>
    <div>
     <label for="tri-select">Trier par</label>
     <select name="tri" id="tri-select">
         <option value="ASC"></option>
         <?php echo ajoutOrderDirection();?>
         <option value="DESC"></option>
     </select>
    </div>
</div>
<div class="indexphoto container">
  <?php $args = array(
     'post_type' => 'photo',
     'posts_per_page' => 12,
     'post__not_in' => array (get_the_ID()),
      'paged'=>1);
     $query = new WP_Query( $args );
    ?>
  <?php if($query->have_posts()) : ?>
        <?php while($query->have_posts()) : ?>
            <?php $query->the_post();?>       
            <div class="overlay-image">
                    <?php the_content(); ?>
                    <div class=hover>
                         <img class="full_screen" data-image="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/fullscreen.png" alt="full_screen">
                         <a href="<?php echo get_the_permalink(get_the_ID());?>">
                             <img class="eye" src="<?php echo get_template_directory_uri(); ?>/assets/eye.png" alt="eye">
                         </a>
                         <div class="texte">
                                <div><?php the_title(); ?></div>
                                <div class="reference" style='display:none'><?php echo get_field('reference') ?></div>
                                <div class="right_now"><?php echo strip_tags(get_the_term_list($post->ID, 'categorie'));?></div>
                         </div>
                    </div>
           </div>

       <?php endwhile; ?>

    <?php endif; 
    wp_reset_postdata();?>
</div>
<div class="btn__wrapper">
    <input type="button" Value="Charger plus" class="btn btn__primary" id="load-more">
</div>
   
<?php get_footer() ?>