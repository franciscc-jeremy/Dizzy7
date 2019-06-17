<?php
/**
 * Single Post Template
*/
get_header(); ?>
	<main>
		<?php tha_content_before(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<section>
			<article>
				<header id="article-header">
					<?php tha_content_top(); ?>
				</header>
				<?php tha_entry_before(); ?>
				<div class="entrytext hentry">
						<?php tha_entry_top(); ?>
						<?php the_content('<p class="serif">Read the rest of this page »</p>'); ?>
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
    
					<a class="social-email" href="mailto:?subject=I wanted to share this story with you: || <?php the_title();?>&body=I found this story on   <?php bloginfo('url');?> and I thought you would like it:  <?php the_permalink();?>     Here's an excerpt:<?php echo strip_tags( get_the_excerpt() );?>"><span><i class="fa fa-share-square"></i></span>Email a Friend</a>

				</div>
				<div id="comments">
					<?php tha_comments_before(); ?>
					<?php comments_template( '', true ); ?>
					<?php tha_comments_after(); ?>
				</div>
				<?php endwhile; endif; ?>
				<div id="cooler-nav" class="navigation">

				<div class="nav-box previous">
					<?php $prevPost = get_previous_post(true); if($prevPost) {?>
					<?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );?>
					<?php previous_post_link('%link',"$prevthumbnail  <p>%title</p>", TRUE); ?>
				</div>

				<div class="nav-box next">
					<?php } $nextPost = get_next_post(true); if($nextPost) { ?>
					<?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100) ); } ?>
					<?php next_post_link('%link',"$nextthumbnail  <p>%title</p>", TRUE); ?>
				</div>
			</div><!--#cooler-nav div -->
				<?php tha_content_bottom(); ?>
			</article>
			<?php tha_sidebars_before(); ?>
			<aside>
				<?php tha_sidebar_top(); ?>
				<?php get_sidebar('main-sidebar'); ?>
				<?php tha_sidebar_bottom(); ?>
			</aside>
			<?php tha_sidebars_after(); ?>
		</section>
		<?php tha_content_after(); ?>
	</main>
<?php get_footer(); ?>
