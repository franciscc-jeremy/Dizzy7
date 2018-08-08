<?php
/**
 * 404 Template
*/
get_header(); ?>

<main>
		<?php tha_content_before(); ?>
		<section>
			<article class="full-width">
				<header>
					<?php tha_content_top(); ?>
					<h1>OOPS! Looks Like Something Has Gone Missing.</h1>
				</header>
				<?php tha_entry_before(); ?>
				<div class="entrytext hentry">
						<?php tha_entry_top(); ?>
					<p>We're sorry it looks like the page you are looking for is missing. You might have clicked a broken link, or someone made a typo. Sorry, it happens to us all.</p>
					
					<h3>Maybe this wll help:</h3>
					
					<?php get_search_form(); ?>
					
						<?php tha_entry_bottom(); ?>
				</div>
				<?php tha_entry_after(); ?>
				
				<?php tha_content_bottom(); ?>
			</article>
		</section>
		<?php tha_content_after(); ?>
	</main>
<?php get_footer(); ?>