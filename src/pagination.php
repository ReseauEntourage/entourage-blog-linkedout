<?php if ( get_the_posts_pagination() ) : ?>

	<div class="post-pagination">

		<?php if ( get_next_posts_link() ) : ?>
			<a class="next-posts-link" cat="<?php echo get_query_var( 'cat' ); ?>" s="<?php echo get_query_var( 's' ); ?>">
				Charger plus d'articles
			</a>
		<?php endif; ?>

	</div> <!-- .pagination -->

<?php endif; ?>
