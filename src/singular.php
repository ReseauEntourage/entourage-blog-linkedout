<?php

get_header();

if ( have_posts() )  :

	while ( have_posts() ) : the_post(); ?>

		<div <?php post_class( 'single-post' ); ?>>

			<header style="background-image: url( <?php the_post_thumbnail_url('large'); ?> );">
				<h1><?php the_custom_html_title(); ?></h1>
			</header>

			<div class="entry-content section-inner thin">

				<?php the_content(); ?>

			</div> <!-- .content -->

			<?php

			// If comments are open, or there are at least one comment
			if ( get_comments_number() || comments_open() ) : ?>

				<div class="section-comments section-inner thin">
					<?php comments_template(); ?>
				</div>

			<?php endif; ?>

		</div> <!-- .post -->

		<?php

		if ( get_post_type() == 'post' ) get_template_part( 'related-posts' );

	endwhile;

endif;

get_footer(); ?>
