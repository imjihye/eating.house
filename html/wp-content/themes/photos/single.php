<?php get_header(); ?>

        <div class="container" id="content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="main-content">
					<?php if ( have_posts() ) : ?> 
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'single' ); ?>
						<?php endwhile; ?>
						<?php if( get_previous_post_link() || get_next_post_link() ) : ?>
							<ul class="pager">
							<?php if( get_previous_post_link() ) : ?>
								<li class="previous"><?php previous_post_link( '%link', __( '&larr; Previous', 'photos' ) ); ?></li>
							<?php endif; ?>
							<?php if( get_next_post_link() ) : ?>
								<li class="next"><?php next_post_link( '%link', __( 'Next &rarr;', 'photos' ) ); ?></li>
							<?php endif; ?>
							</ul>
						<?php endif; ?>
						<?php
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

<?php get_footer(); ?>