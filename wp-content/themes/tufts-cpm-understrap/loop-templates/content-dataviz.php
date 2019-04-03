<?php
// title, thumbnail, excerpt,
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="row">
		<div class="col-sm-4">
			<a href="<?php print get_the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?></a>
		</div>
		<div class="col-sm-8">
			<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h4>' ); ?>
			<?php
			the_excerpt();
			?>

		</div>
	</div>

</article>
