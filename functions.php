<?php
/**
 * birthday functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package birthday
 */

if ( ! function_exists( 'birthday_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function birthday_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on birthday, use a find and replace
	 * to change 'birthday' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'birthday', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'birthday' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'birthday_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'birthday_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function birthday_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'birthday_content_width', 640 );
}
add_action( 'after_setup_theme', 'birthday_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function birthday_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'birthday' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'birthday' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'birthday_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function birthday_scripts() {
	wp_enqueue_style( 'birthday-style', get_stylesheet_uri() );

	wp_enqueue_script( 'birthday-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'birthday-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	
	wp_enqueue_script( 'smoothstate-js', get_template_directory_uri() . '/js/jquery.smoothState.min.js', array('jquery'), '0.5.2', true );
	
	wp_enqueue_script( 'waitforimages-js', get_template_directory_uri() . '/js/jquery.waitforimages.min.js', array('jquery'), '20170220', true );
	
	wp_enqueue_script( 'birthday-site', get_template_directory_uri() . '/js/site.min.js', array('jquery', 'smoothstate-js', 'waitforimages-js'), '20170409', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'birthday_scripts' );

/**
 * Enqueue styles for admin.
 */
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * 'Disabling' comments (removing it from admin menu)
 */
function remove_menus(){
  remove_menu_page( 'edit-comments.php' );          //Comments
}
add_action( 'admin_menu', 'remove_menus' );

/**
 * Re-ordering the admin menu
 */
function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;

	return array(
		'index.php', // Dashboard
		'separator1', // First separator
		'edit.php', // Posts
		'edit.php?post_type=page', // Pages
		'upload.php', // Media
		'separator2', // Second separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');


/**
 * Reformating posts into a poster content type.
 */

// Renaming labels
function posters_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Posters';
	$submenu['edit.php'][5][0] = 'Posters';
	$submenu['edit.php'][10][0] = 'Add Poster';
	$submenu['edit.php'][16][0] = 'Poster Tags';
}
function posters_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Posters';
	$labels->singular_name = 'Poster';
	$labels->add_new = 'Add Poster';
	$labels->add_new_item = 'Add Poster';
	$labels->edit_item = 'Edit Poster';
	$labels->new_item = 'Poster';
	$labels->view_item = 'View Posters';
	$labels->search_items = 'Search Posters';
	$labels->not_found = 'No Posters found';
	$labels->not_found_in_trash = 'No Posters found in Trash';
	$labels->all_items = 'All Posters';
	$labels->menu_name = 'Posters';
	$labels->name_admin_bar = 'Posters';
	$menu_icon = &$wp_post_types['post']->menu_icon;
	$menu_icon = 'dashicons-media-default';
}

add_action( 'admin_menu', 'posters_change_post_label' );
add_action( 'init', 'posters_change_post_object' );

// Remove the main content window
function posters_remove_editor() {
	remove_post_type_support( 'post', 'editor' );
}

add_action( 'init', 'posters_remove_editor' );


/**
 * Generated by the WordPress Meta Box Generator at https://jeremyhixon.com/tool/wordpress-meta-box-generator-v2-beta/
 */
class Poster_Meta_Box {
	private $screens = array(
		'post',
	);
	private $fields = array(
		array(
			'id' => 'poster-number',
			'label' => 'Poster Number:',
			'type' => 'number',
		),
		array(
			'id' => 'poster-for',
			'label' => 'The Poster is for:',
			'type' => 'text',
		),
		array(
			'id' => 'poster-date',
			'label' => 'Poster Date:',
			'type' => 'date',
		),
		array(
			'id' => 'full-poster',
			'label' => 'Full Poster (570px × 750px):',
			'type' => 'media',
		),
		array(
			'id' => 'layer-1-label-info',
			'label' => 'Layer #1 Label (Info):',
			'type' => 'text',
		),
		array(
			'id' => 'layer-1',
			'label' => 'Layer #1 (1520px × 2000px):',
			'type' => 'media',
		),
		array(
			'id' => 'layer-2-label',
			'label' => 'Layer #2 Label:',
			'type' => 'text',
		),
		array(
			'id' => 'layer-2',
			'label' => 'Layer #2 (1520px × 2000px):',
			'type' => 'media',
		),
		array(
			'id' => 'layer-3-label',
			'label' => 'Layer #3 Label:',
			'type' => 'text',
		),
		array(
			'id' => 'layer-3',
			'label' => 'Layer #3 (1520px × 2000px):',
			'type' => 'media',
		),
		array(
			'id' => 'blend-mode',
			'label' => 'Blend mode for layers 2 and 3',
			'type' => 'select',
			'options' => array(
				'normal' => 'Normal',
				'multiply' => 'Multiply',
				'screen' => 'Screen',
				'overlay' => 'Overlay',
				'darken' => 'Darken',
				'lighten' => 'Lighten',
				'color-dodge' => 'Color Dodge',
				'color-burn' => 'Color Burn',
				'hard-light' => 'Hard Light',
				'soft-light' => 'Soft Light',
				'difference' => 'Difference',
				'exclusion' => 'Exclusion',
				'hue' => 'Hue',
				'saturation' => 'Saturation',
				'color' => 'Color',
				'luminosity' => 'Luminosity',
			),
		),
		array(
			'id' => 'the-rules',
			'label' => 'The Rules:',
			'type' => 'textarea',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {
		foreach ( $this->screens as $screen ) {
			add_meta_box(
				'poster-setup',
				__( 'Poster Setup', 'posters' ),
				array( $this, 'add_meta_box_callback' ),
				$screen,
				'normal',
				'high'
			);
		}
	}

	/**
	 * Generates the HTML for the meta box
	 * 
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'poster_setup_data', 'poster_setup_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Hooks into WordPress' admin_footer function.
	 * Adds scripts for media uploader.
	 */
	public function admin_footer() {
		?><script>
			// https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.rational-metabox-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'poster_setup_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input class="regular-text" id="%s" name="%s" type="text" value="%s"> <input class="button rational-metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$field['id'],
						$field['id']
					);
					foreach ( $field['options'] as $key => $value ) {
						$field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<option %s value="%s">%s</option>',
							$db_value === $field_value ? 'selected' : '',
							$field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$db_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['poster_setup_nonce'] ) )
			return $post_id;

		$nonce = $_POST['poster_setup_nonce'];
		if ( !wp_verify_nonce( $nonce, 'poster_setup_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'poster_setup_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'poster_setup_' . $field['id'], '0' );
			}
		}
	}
}
new Poster_Meta_Box;