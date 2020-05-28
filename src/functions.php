<?php
	add_theme_support( 'post-thumbnails' );

	@ini_set( 'upload_max_size' , '64M' );
	@ini_set( 'post_max_size', '64M');
	@ini_set( 'max_execution_time', '300' );

	add_filter( 'jetpack_enable_open_graph', '__return_false' );


	// Enable ajax request
	function add_myjavascript(){
		wp_enqueue_script( 'ajax-request',  get_bloginfo('template_directory') . '/js/ajax-request.js', array( 'jquery' ) );
	}
	add_action( 'init', 'add_myjavascript' );


	// Add active class in menu
	function special_nav_class ($classes, $item) {
	    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
	        $classes[] = 'active ';
	    }
	    return $classes;
	}
	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


	// Pagination
	function pagination_load_posts(){
		$query_data = $_GET;
		$the_query = new WP_Query([
			'post_type' => 'post',
			'post_status' => array('publish'),
			'cat' => $query_data['cat'],
			's' => $query_data['s'],
			'paged' => $query_data['paged']
		]);

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				get_template_part( 'post-link' );
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		die();
	}

	add_action( 'wp_ajax_nopriv_pagination-load-posts', 'pagination_load_posts' );
	add_action( 'wp_ajax_pagination-load-posts', 'pagination_load_posts' );


	// Search
	function search_posts(){
		$query_data = $_GET;
		$the_query = new WP_Query([
			'post_type' => 'post',
			'post_status' => array('publish'),
			's' => $query_data['s']
		]);

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				get_template_part( 'post-link' );
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		}
		die();
	}

	add_action( 'wp_ajax_nopriv_search-posts', 'search_posts' );
	add_action( 'wp_ajax_search-posts', 'search_posts' );



	/*** CUSTOM FUNCTIONS ***/

	function the_custom_html_title() {
    	$title = get_the_title();
    	$title = preg_replace('/ ([!?:])/', '&nbsp;$1', $title);
    	echo $title;
	}

	function asset_url($path) {
		$version = filemtime(path_join(get_stylesheet_directory(), $path));
		echo esc_url(path_join(get_template_directory_uri(), $path).'?'.$version);
	}



	/*** ADMIN OPTIONS ***/

	/**
	* Remove some menu
	*/

	function custom_menu_page_removing() {
	    remove_menu_page('tools.php');
	    remove_menu_page('index.php');
	}
	add_action( 'admin_menu', 'custom_menu_page_removing' );


	/**
	* Add custom interface for global custom fields
	*/

	add_action('admin_menu', 'add_gcf_interface');

	function add_gcf_interface() {
		add_options_page('Textes du site', 'Textes du site', 'manage_options', 'global_custom_fields', 'edit_global_custom_fields');
	}

	function edit_global_custom_fields() {
	?>
	<div class='wrap'>
		<h2>Textes du site</h2>
		<form method="post" action="options.php">
			<?php wp_nonce_field('update-options') ?>

			<h2>Haut de page</h2>

			<p><strong>Icone bouton orange à droite :</strong><br />
			<input type="text" name="open_app_icon" size="150" value="<?php echo get_option('open_app_icon'); ?>" /></p>

			<p><strong>Bouton orange à droite :</strong><br />
			<input type="text" name="open_app_text" size="150" value="<?php echo get_option('open_app_text'); ?>" /></p>

			<p><strong>Lien bouton orange à droite :</strong><br />
			<input type="text" name="open_app_link" size="150" value="<?php echo get_option('open_app_link'); ?>" /></p>

			<p><strong>[MOBILE] Bouton orange à droite (max 15 caractères):</strong><br />
			<input type="text" name="open_app_text_mobile" size="150" value="<?php echo get_option('open_app_text_mobile'); ?>" /></p>

			<h2>Don</h2>

			<p><strong>Bouton "faire un don" (max 10 caractères) :</strong><br />
			<input type="text" name="donate_text" size="150" value="<?php echo get_option('donate_text'); ?>" /></p>

			<p><strong>Lien formulaire de don :</strong><br />
			<input type="text" name="donate_link" size="150" value="<?php echo get_option('donate_link'); ?>" /></p>

			<h2>Textes de partage Facebok (page d'accueil seulement)</h2>

			<p><strong>Titre :</strong><br />
			<input type="text" name="facebook_title" size="150" value="<?php echo get_option('facebook_title'); ?>" /></p>

			<p><strong>Description :</strong><br />
			<input type="text" name="facebook_description" size="150" value="<?php echo get_option('facebook_description'); ?>" /></p>

			<h2>Bas de page</h2>

			<p><strong>Message newsletter :</strong><br />
			<input type="text" name="newsletter" size="150" value="<?php echo get_option('newsletter'); ?>" /></p>

			<p><strong>Message adresse :</strong><br />
			<input type="text" name="footer_address_text" size="150" value="<?php echo get_option('footer_address_text'); ?>" /></p>

			<p><strong>Lien adresse :</strong><br />
			<input type="text" name="footer_address_link" size="150" value="<?php echo get_option('footer_address_link'); ?>" /></p>

			<p><input type="submit" name="Submit" value="Enregistrer les textes" /></p>

			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="open_app_icon,open_app_text,  open_app_link, open_app_text_mobile, newsletter, donate_text, donate_link, footer_address_text, footer_address_link,facebook_title,facebook_description" />

		</form>
	</div>
	<?php
}
