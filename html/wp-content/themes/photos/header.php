<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class('push-menu-push'); ?>>
	<div class="wrapper">
		<nav class="push-menu push-menu-vertical push-menu-left" id="push-menu-id">
			<h3 id="hideLeftPush"><?php _e( 'Menu', 'photos' ); ?></h3>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'menu' => __( 'Primary Menu', 'photos' ),
				'items_wrap' => '<ul class="photos-push-menu">%3$s</ul>'
			));
			?>
		</nav>

		<span class="glyphicon glyphicon-menu-hamburger" id="showLeftPush" aria-hidden="true"></span>

		<header class="header" style="background: url('<?php header_image(); ?>') no-repeat scroll 0% 0% / cover;">
			<div class="jumbotron text-center">
				<div class="container">
				<?php $photos_avatar_image = get_theme_mod('photos_avatar_image', get_template_directory_uri().'/assets/images/avatar.jpg' ); ?>
				<?php if(!empty($photos_avatar_image)) : ?>
					<img class="avatar" src="<?php echo esc_url($photos_avatar_image); ?>" />
				<?php endif; ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
					<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
					<a href="#content" class="btn btn-circle page-scroll">
						<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</header>
