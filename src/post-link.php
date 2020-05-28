<a <?php post_class(); ?> id="post-<?php the_ID(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

	<div class="preview-image" style="background-image: url( <?php the_post_thumbnail_url('large'); ?> );"></div>

	<h2><?php the_custom_html_title(); ?></h2>

	<span class="btn-read">
		Lire l'article <i class="material-icons">arrow_forward</i>
	</span>

</a>
