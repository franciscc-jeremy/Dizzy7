<?php
/**
 * Archive Template
*/
get_header(); ?>
	<main>
		<?php tha_content_before(); ?>
		<section>
				<header>
					<?php tha_content_top(); ?>
					 <h1 class="archive-title"><?php single_cat_title(''); ?></h1>
			        <?php $category_description = category_description();
					    if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';
				 	?>
				</header>
				<?php tha_entry_before(); ?>
				<div class="entrytext hentry">
						
					
					<!-- The Loop Goes Here-->
					
				<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?> 	
             	<article <?php post_class('teaser animatedParent'); ?>>
					<div class="animated fadeInUp">
					<?php tha_entry_top(); ?>
					<header><h2 class="entry-title"><?php the_title() ;?></h2></header>
			
                    <abbr class="teaser_date published" title="<?php the_date("m","y");?>"><?php the_date('l jS \of F Y');?></abbr>
                    <div class="format_teaser entry-content">
					<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject" rel="bookmark"><?php $title=get_the_title(); $schemaimg='url'; the_post_thumbnail(array(250,250, true),array( 'alt' =>$title, 'itemprop' =>$schemaimg)); ?></a>
                    <p><?php the_excerpt() ;?></p>
                    </div>
                    <a class="teaser_link" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" rel="nofollow">Read more →</a>
					<?php tha_entry_bottom(); ?>
					</div>
                </article>
				<?php endwhile; endif; ?>	
					<!--The Loop Ends Here-->
				</div>
				<?php tha_entry_after(); ?>
				
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<div id="nav-below" class="navigation">
						<div class="navigation"><p><?php posts_nav_link('<i class="fas fa-arrows-alt-h"></i>','',''); ?></p></div>
					</div><!-- #nav-below -->
				<?php endif; ?>
				
				<?php tha_content_bottom(); ?>
		</section>
		<?php tha_content_after(); ?>
	</main>
<?php get_footer(); ?>
