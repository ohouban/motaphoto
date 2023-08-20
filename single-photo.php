<?php get_header(); ?>
<div class="container">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
      <div class="post">
			<div class="post-info">
        		<p>
					<h1 class="post-title"><?php the_title(); ?></h1>
					Référence : <span id="ref-photo"> <?php echo get_field ('reference');?></span><br>
					Categorie : <?php echo strip_tags(get_the_term_list($post->ID, 'categorie'));?><br>
					Format : <?php echo strip_tags(get_the_term_list($post->ID, 'format' ));?><br>
					Type :  <?php echo get_field('type');?><br>
       			 	Année :<?php the_date(' Y'); ?><br>
       	 		</p>
			</div>
        	<div class="post-content">
          		<?php the_content(); ?>
       	   </div>
      </div>

	  <div class="sous_partie">
			<p>Cette photo vous intéresse ?
				<input type="button" value="Contact" id="lienmodale">
			</p>
			<div class="carr">
				<?php the_post_thumbnail(); ?>
				<p class="carrousel">
					<?php $prevPost = get_previous_post();
					$prevLink = get_permalink($prevPost);?>
					<a href="<?php echo $prevLink; ?>">
						<img class="arrow_left" src="<?php echo get_template_directory_uri(); ?>/assets/arrow_left.png" alt="fleche_gauche">
					</a>
					<?php $prevNext = get_next_post();
					$prevLinkNext = get_permalink($prevNext);?>
					<a href="<?php echo $prevLinkNext; ?>">
						<img class="arrow_right" src="<?php echo get_template_directory_uri(); ?>/assets/arrow_right.png" alt="fleche_droite">
					</a>
				</p>
			</div>
	  </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
  	<div class="debphoto">
  		<p>VOUS AIMEREZ AUSSI</p>
				<div>
                    
				</div>
				<a href="<?php echo home_url()?>"><button id="lienacc">Toutes les photos </button></a>
	</div>

    
<?php get_footer(); ?>