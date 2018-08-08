<?php
/*

Template Name: No Sidebars (Full Width)

*/
get_header(); ?>
	<main>
		<?php tha_content_before(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<article class="full-width">
				<header>
					<?php tha_content_top(); ?>
				</header>
				<?php tha_entry_before(); ?>
				<div class="entrytext hentry">
						<?php tha_entry_top(); ?>
						<?php the_content(); ?>
						<?php tha_entry_bottom(); ?>
				</div>
				<?php tha_entry_after(); ?>
				<div class="social-share">
				<h3>Share On Your Social Networks</h3>
        			<a data-fb-link="<?php the_permalink();?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" title="Share on Facebook" rel:gt_act="share/facebook/share" rel:gt_label="" name="fb_share" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=660,height=380,left=100,top=100');return false;" class="facebook">
    					<span><i class="fab fa-facebook-f"></i></span> Facebook
    				</a>
    
        			<a href="https://twitter.com/intent/tweet?text=<?php the_title();?>&url=<?php the_permalink();?>&button_hashtag=techcoastangels" class="share-icon share-button share-icon-twitter" title="Share on Twitter"  onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=660,height=380,left=100,top=100');return false;" class="twitter">
    					<span><i class="fab fa-twitter"></i></span> Twitter
    				</a>        

					<a href="https://plus.google.com/share?url=<?php the_permalink();?>" class="share-icon share-button share-icon-google-plus" title="Share on Google+" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=480,height=400,left=100,top=100');return false;"class="google">
						<span><i class="fab fa-google-plus-g"></i></span> Google +
    				</a>        
    
					<a class="social-email" href="mailto:?subject=I wanted to share this story with you: || <?php the_title();?>&body=I found this story on   <?php bloginfo('url');?> and I thought you would like it:  <?php the_permalink();?>     Here's an excerpt:<?php the_excerpt();?>"><span><i class="fa fa-share-square"></i></span>Email a Friend</a>

				</div>
				<?php endwhile; endif; ?>
				<?php tha_content_bottom(); ?>
			</article>
		</section>
		<?php tha_content_after(); ?>
	</main>
<?php get_footer(); ?>