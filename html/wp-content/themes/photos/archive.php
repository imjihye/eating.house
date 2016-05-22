<?php get_header(); ?>

		<div class="container" id="content">
		<?php if ( is_category() ) : ?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php single_cat_title(); ?></h1>
				<div class="loop-description">
					<?php echo category_description(); ?>
				</div>
			</div>
		<?php elseif ( is_tag() ) : ?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php single_tag_title(); ?></h1>
				<div class="loop-description">
					<?php echo tag_description(); ?>
				</div>
			</div>
		<?php elseif ( is_tax() ) : ?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php single_term_title(); ?></h1>
				<div class="loop-description">
					<?php echo term_description( '', get_query_var( 'taxonomy' ) ); ?>
				</div>
			</div>
		<?php elseif ( is_author() ) : ?>
			<?php $user_id = get_query_var( 'author' ); ?>
			<div id="hcard-<?php echo esc_attr( get_the_author_meta( 'user_nicename', $user_id ) ); ?>" class="loop-meta vcard">
				<h1 class="loop-title fn n"><?php the_author_meta( 'display_name', $user_id ); ?></h1>
				<div class="loop-description">
					<?php echo wpautop( get_the_author_meta( 'description', $user_id ) ); ?>
				</div>
			</div>
		<?php elseif ( is_post_type_archive() ) : ?>
			<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php post_type_archive_title(); ?></h1>
				<div class="loop-description">
					<?php if ( !empty( $post_type->description ) ) echo wpautop( $post_type->description ); ?>
				</div>
			</div>
		<?php elseif ( is_day() || is_month() || is_year() ) : ?>
			<?php
			if ( is_day() )
				$date = get_the_time( __( 'F d, Y', 'photos' ) );
			elseif ( is_month() )
				$date = get_the_time( __( 'F Y', 'photos' ) );
			elseif ( is_year() )
				$date = get_the_time( __( 'Y', 'photos' ) );
			?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php echo $date; ?></h1>
				<div class="loop-description">
					<?php echo wpautop( sprintf( __( 'You are browsing the site archives for %s.', 'photos' ), $date ) ); ?>
				</div>
			</div>
		<?php elseif ( is_archive() ) : ?>
			<div class="loop-meta">
				<h1 class="loop-title"><?php _e( 'Archives', 'photos' ); ?></h1>
				<div class="loop-description">
					<p><?php _e( 'You are browsing the site archives.', 'photos' ); ?></p>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( have_posts() ) : ?> 
			<div class="photogrid">
				<div class="photogrid-sizer"></div>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content' ); ?>
				<?php endwhile; ?>
			</div>
			<div class="clearfix"></div>
			<?php if(  get_the_posts_pagination() ): ?>
				<ul class="pager">
				<?php if( get_previous_posts_link() ): ?>
					<li class="previous"><?php previous_posts_link(); ?></li>
				<?php endif; ?>
				<?php if( get_next_posts_link() ): ?>
					<li class="next"><?php next_posts_link(); ?></li>
				<?php endif; ?>
				</ul>
		<?php endif; ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div>

<?php get_footer(); ?>
