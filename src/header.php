<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 */

	$custom_fields = get_post_custom($wp_query->post->ID);

	if ( is_front_page() )
	{
		$og_title = !empty(get_option('facebook_title')) ? get_option('facebook_title') : $custom_fields['meta_titre'][0];
		$og_description = !empty(get_option('facebook_description')) ? get_option('facebook_description') : $custom_fields['meta_description'][0];
	}
	else {
		$og_title = !empty($custom_fields['meta_titre']) ? $custom_fields['meta_titre'][0] : get_the_title($wp_query->post->ID);
		$og_description = !empty($custom_fields['meta_description']) ? $custom_fields['meta_description'][0] : get_bloginfo('description');
	}

	$custom_fields_home = get_post_custom('2');
	$download_btn_text = $custom_fields_home['bouton_orange'][0];
	$download_btn_link = $custom_fields_home['lien'][0];
	$custom_fields_downloads = get_post_custom('20');
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MQRM8TN');</script>
  <!-- End Google Tag Manager -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="icon" type="image/png" href="<?php asset_url('img/fav.png'); ?>" />
	<title>
		<?php
			if ( is_front_page())
				echo bloginfo('name');
			else
				echo $og_title . ' · Entourage';
		?>
	</title>
    <meta name="description" content="<?php echo (!empty($custom_fields['meta_description']) ? $custom_fields['meta_description'][0] : get_bloginfo('description')); ?>">

	<meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo wp_get_canonical_url(); ?>">
    <meta property="og:image" content="<?php if (!empty($custom_fields['facebook_image'])) echo $custom_fields['facebook_image'][0]; else asset_url('img/share-fb-2.jpg'); ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="fb:app_id" content="280727035774134">
    <meta name="apple-mobile-web-app-capable" content="yes">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,500,100,300italic' rel='stylesheet' type='text/css'>
	<script src="<?php asset_url('js/lib/jquery.js'); ?>" type="text/javascript"></script>

	<!-- Analytics Code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-68872992-5', 'auto');
		ga('send', 'pageview');
	</script>

	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php asset_url('css/style.css'); ?>">
	<link rel="stylesheet" href="<?php asset_url('css/responsive.css'); ?>">
</head>

<body id="page-<?php echo get_post_field( 'post_name', get_post() ) ?>">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQRM8TN"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

	<header id="site-header" role="banner">
		<div id="site-header-fixed">
			<a id="site-header-logo" href="https://www.entourage.social/">
				<img src="<?php asset_url('img/logo-entourage-orange.png'); ?>" alt="Logo de l'association Entourage" title="Association Entourage"/>
			</a>
			<div id="site-header-nav">
				<a id="site-header-nav-mobile">
					<i class="material-icons">menu</i>
					<i class="material-icons close">close</i>
				</a>
				<?php echo get_post(4811)->post_content; ?>
			</div>
			<div id="site-header-right">
				<a class="btn orange-btn header-download-btn web-app-link-tracker no-mobile" title="Ouvrir la carte des actions du réseau solidaire Entourage" href="<?php echo get_option('open_app_link'); ?>" target="_blank" ga-event="Engagement AppView Header">
					<i class="material-icons"><?php echo get_option('open_app_icon'); ?></i><?php echo get_option('open_app_text'); ?>
				</a>
				<a class="btn orange-btn header-download-btn mobile-only" title="Ouvrir la carte des actions du réseau solidaire Entourage" href="<?php echo get_option('open_app_link'); ?>" ga-event="Engagement AppView Header">
					<i class="material-icons"><?php echo get_option('open_app_icon'); ?></i><?php echo get_option('open_app_text_mobile'); ?>
				</a>
			</div>
		</div>

		<div id="site-header-title">
			<h1><?php echo get_bloginfo('name'); ?></h1>
		</div>

	</header>

	<nav id="nav-menu">
		<?php wp_nav_menu(); ?>
		<div id="nav-search-container">
			<div class="parent-input">
				<input id="nav-search" type="text" placeholder="Rechercher..." />
			</div>
		</div>
	</nav>

	<div id="site-content">
