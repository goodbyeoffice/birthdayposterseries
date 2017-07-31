<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package birthday
 */

get_header(); ?>

	<div id="sidebar">
		<h1 class="site-title desktop"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Poster Series</a></h1>
		
		<div class="poster-info">
			<div class="caption-number">Poster #<?php echo get_post_meta( get_the_ID(), 'poster_setup_poster-number', true ); ?></div>
			<div class="caption-for">for <?php echo get_post_meta( get_the_ID(), 'poster_setup_poster-for', true ); ?></div>
			<div class="caption-date"><?php echo date( 'F jS, Y', strtotime( get_post_meta( get_the_ID(), 'poster_setup_poster-date', true ) ) ); ?></div>
			
			<div id="the-layers">
				<h2>Layers:</h2>
				<button id="layer-button1"><?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-1-label-info', true ); ?></button>
				<button id="layer-button2"><?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-2-label', true ); ?></button>
				<button id="layer-button3"><?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-3-label', true ); ?></button>
			</div>
			
			<div id="the-rules">
				<h2>The Rules:</h2>
				<p><?php echo get_post_meta( get_the_ID(), 'poster_setup_the-rules', true ); ?></p>
			</div>
			
		</div>
		
	</div>

	<div id="poster" class="content-area">
		<main id="main" class="site-main" role="main">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			
				<div class="poster">
					<div id="padding"></div>
					<div id="layers">
						<img class="poster-layer" id="poster-layer1" src="<?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-1', true ); ?>" />
						<img class="poster-layer" id="poster-layer2" src="<?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-2', true ); ?>" style="mix-blend-mode: <?php echo get_post_meta( get_the_ID(), 'poster_setup_blend-mode', true ); ?>;" />
						<img class="poster-layer" id="poster-layer3" src="<?php echo get_post_meta( get_the_ID(), 'poster_setup_layer-3', true ); ?>" />
					</div>
				</div>
	
			</article><!-- #post-## -->
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><button id="back">&larr; Back to all posters</button></a>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();