<?php
/*
** Template to Render Social Icons on Top Bar
*/

for ($i = 1; $i < 8; $i++) : 
	$social = esc_html( get_theme_mod('revive_social_'.$i) );
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a class="social-icon hvr-ripple-out" href="<?php echo esc_url( get_theme_mod('revive_social_url'.$i) ); ?>"><i class="fa fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>