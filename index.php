<?php
/**
 * The main template file
*/
get_header(); ?>
	<main>
		<?php tha_content_before(); ?>
		<section class="grid">
				<header>
					<?php tha_content_top(); ?>
					<?php if(get_theme_mod( 'diz-before-content')){?><?php echo get_theme_mod( 'diz-before-content', 'Place your Content here. It will appear above the posts grid.' ); ?><?php }?>
				</header>
				<?php tha_entry_before(); ?>
											
					<!-- The Loop Goes Here-->
					
				<?php //if ( is_home() ) :
    			//			query_posts( 'offset=1' );
	  			//	  	elseif ( is_front_page() ) :
    			//			query_posts( 'offset=0' );
      			//	  endif; 
			        query_posts(array(
    					is_front_page(),
						is_home('offset=1'),
										)
							   );
	 	  				  if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
 
					<article class="item animatedParent">
             		<a class="teaser animated fadeInUp slow" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="image">
					<?php tha_entry_top(); ?>
					<?php 
						$title=get_the_title();
						$schemaimg='url';
						$id=get_the_ID();
						$cats=get_the_category();
						if(has_post_thumbnail()):
						echo the_post_thumbnail(array(425, 9999),array( 'alt' =>$title, 'itemprop' =>$schemaimg));
						else:
						echo '<img src="https://d3p7wdg430n2je.cloudfront.net/wp-content/uploads/pexels-photo-554609-e1525574269560.jpeg" alt="'; the_title();
						echo '"/>';
						endif;
					?>
					<header><h3><span class="loop-categories"><?php echo $cats[0]->name; ?></span><?php the_title();?></h3></header>
					<span class="teaser-meta-container"><?php if (get_comments_number()==0) { ?><?php } else {?><span class="loop-comments"><?php comments_number('0', '1', '%' );?></span><?php }?></span></a>
					<?php tha_entry_bottom(); ?>
					</article>
				<?php endwhile; endif; ?>	
					<!--The Loop Ends Here-->
										
				<?php tha_entry_after(); ?>
				
				<?php tha_content_bottom(); ?>
		</section>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div id="nav-below" class="navigation">
						<div class="navigation"><p><?php posts_nav_link('<i class="fas fa-arrows-alt-h"></i>','',''); ?></p></div>
					</div><!-- #nav-below -->
				<?php endif; ?>
		<?php tha_content_after(); ?>
	</main>
<?php get_footer(); ?>