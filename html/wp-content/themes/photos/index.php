<?php get_header(); ?>

		<div class="container" id="content">
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