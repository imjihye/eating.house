
		<div id="post-<?php the_ID(); ?>" <?php post_class('photogrid-item'); ?>>
			<a class="photogrid-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<img class="featured-image" src="<?php echo $feat_image; ?>" />
			<?php else: ?>
				<?php $feat_image = get_stylesheet_directory_uri() . '/assets/images/default.jpg'; ?>
				<img class="featured-image" src="<?php echo $feat_image; ?>" />
			<?php endif; ?>
			</a>
		</div>
