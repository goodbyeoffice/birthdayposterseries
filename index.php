<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package birthday
 */

get_header(); ?>

	<div id="sidebar">
		<h1 class="site-title desktop"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Poster Series</a></h1>
		
		<div id="pages" class="desktop">
			
			<?php
			
			$page_args = array(
			  'sort_column' => 'menu_order',
			  'order' => 'ASC'
			   );
			
			$pages = get_pages($page_args);
				foreach($pages as $page) { 
					?>
					<div class="page">
						<h2 class="entry-title"><?php echo $page->post_title ?></h2>
						<?php echo apply_filters('the_content', $page->post_content) ?>
					</div>
						
						<?php
				} // foreach($categories
			?>
			
		</div>
		
	</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		
		
		<?php
		
		//for each category, show 5 posts
		$cat_args = array(
		  'orderby' => 'name',
		  'order' => 'DESC'
		   );
		
		$categories = get_categories($cat_args);
			foreach($categories as $category) { 
				
				$args=array(
					'orderby' => 'date',
					'order' => 'ASC',
					'category__in' => array($category->term_id),
					'caller_get_posts'=>1
				);
				$posts = get_posts($args);
				
				if ($posts) {
					echo '<h2 class="category">' . $category->name . '</h2> ';
					echo '<div class="poster-thumbs">';
					foreach($posts as $post) {
						setup_postdata($post); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<a href="<?php esc_url( the_permalink( ) ) ?>" rel="bookmark">
								<img class="poster-thumb" src="<?php echo get_post_meta( get_the_ID(), 'poster_setup_full-poster', true ); ?>" />
							</a>
							<div class="entry-caption">
								<div class="caption-number">Poster #<?php echo get_post_meta( get_the_ID(), 'poster_setup_poster-number', true ); ?></div>
								<div class="caption-for">for <?php echo get_post_meta( get_the_ID(), 'poster_setup_poster-for', true ); ?></div>
								<div class="caption-date"><?php echo date( 'F jS, Y', strtotime( get_post_meta( get_the_ID(), 'poster_setup_poster-date', true ) ) ); ?></div>
							</div>
						</article>
						
						<?php
					} // foreach($posts
					echo '</div>';
				} // if ($posts
			} // foreach($categories
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<div id="pages" class="tablet">
		
		<?php
		
		$page_args = array(
		  'sort_column' => 'menu_order',
		  'order' => 'ASC'
		   );
		
		$pages = get_pages($page_args);
			foreach($pages as $page) { 
				?>
				<div class="page">
					<h2 class="entry-title"><?php echo $page->post_title ?></h2>
					<?php echo apply_filters('the_content', $page->post_content) ?>
				</div>
					
					<?php
			} // foreach($categories
		?>
		
	</div>

<?php
get_footer();
