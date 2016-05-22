<article id="post-<?php the_ID(); ?>" <?php post_class('item'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php 
			if ( has_post_thumbnail() ) :
				the_post_thumbnail('full');
			endif;
		?>
		<div class="post-content">
			<?php the_content(); ?>
		</div>
		<?php
			wp_link_pages( array(
				'before'	  => '<ul class="pager">',
				'after'	   => '</ul>',
				'link_before' => '<li><span>',
				'link_after'  => '</span></li>',
			) );
		?>
	</div>
</article>