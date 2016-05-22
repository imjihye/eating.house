<article id="post-0" <?php post_class('item'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing found', 'photos' ); ?></h1>
	</header>
	<div class="entry-content">
		<div class="post-content">
			<p><?php _e( 'The page you were looking for doesn&rsquo;t exist. Sasquatch, on the other hand, just might.', 'photos' ); ?></p>
			<p><?php _e( 'But hey, you can always use our search form:', 'photos' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
</article>