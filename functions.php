<?php
/**
 * method functions and definitions
 *
 * @package method
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'method_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function method_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on method, use a find and replace
	 * to change 'method' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'method', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 480, 200, true ); // for the main page grid
	add_image_size( 'method-header', 940, 200, true ); // for the single article view
  // TODO: Is it possible to control the crop here?
  

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'method' ),
    'social'  => __( 'Social Menu', 'method' ),
    'footer'  => __( 'Footer Menu', 'method' ),
	) );
  
  // no black admin bar
	show_admin_bar( false );
  
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'method_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
  
  
  
 

  
}
endif; // method_setup
add_action( 'after_setup_theme', 'method_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function method_widgets_init() {
	// register_sidebar( array(
//     'name'          => __( 'Sidebar', 'method' ),
//     'id'            => 'sidebar-1',
//     'description'   => '',
//     'before_widget' => '<aside id="%1$s" class="widget %2$s">',
//     'after_widget'  => '</aside>',
//     'before_title'  => '<h1 class="widget-title">',
//     'after_title'   => '</h1>',
//   ) );

// no sidebar. TODO: possibly add make widget area in footer? 

}
add_action( 'widgets_init', 'method_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function method_scripts() {
	wp_enqueue_style( 'method-style', get_stylesheet_uri() );

	wp_enqueue_script( 'method-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'method-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'method_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 * Custom category metatdata to support issue-ing
 *
 * See: http://www.techjunkie.com/custom-category-taxonomy-meta-wordpress/
 * 
 * Some code adapted from Featured Images for Categories plugin
 * http://helpforwp.com/plugins/featured-images-for-categories/
 * TODO: This code is GPL
 */

add_action('category_edit_form_fields', 'method_edit_fields');
add_action('category_add_form_fields', 'method_create_fields');
add_action('edited_category', 'method_fields_save', 10, 1);
add_action('created_category', 'method_fields_save', 10, 1);


function method_fields_save($term_id) {

    $cat_ID = $term_id;

 if($_POST['issue_number']){

		$issue_number = sanitize_text_field($_POST['issue_number']); 
		$issue_numbers = get_option('issue_numbers');
    
		$issue_numbers[$cat_ID] = $issue_number;   

		update_option('issue_numbers', $issue_numbers);  
 }
 
 
 if($_POST['issue_date']){

		$issue_date = sanitize_text_field($_POST['issue_date']);
		$issue_dates = get_option('issue_dates');
    
		$issue_dates[$cat_ID] = $issue_date;   

		update_option('issue_dates', $issue_dates); }
 
 
 
if ( isset( $_POST['wpfifc_taxonomies_create_post_ID'] ) ) {
	$default_post_ID = $_POST['wpfifc_taxonomies_create_post_ID'];
}else if ( isset( $_POST['wpfifc_taxonomies_edit_post_ID'] ) ) {
	$default_post_ID = $_POST['wpfifc_taxonomies_edit_post_ID'];
}
$thumbnail_id = get_post_meta( $default_post_ID, '_thumbnail_id', true );
if( $thumbnail_id ){
	update_option( '_wpfifc_taxonomy_term_'.$term_id.'_thumbnail_id_', $thumbnail_id );
}

}

function method_create_fields ($tag) {
    
	$cat_ID = $tag->term_id;
  
	?>
	<div class="form-field">
	  <label for="issue_number"><?php _e('Issue Number', ''); ?></label>
	  <input id="issue_number" type="text" name="issue_number" size="10" value=""></input>
    <p><span class="description">If this category is an issue, please enter the number here. Also, make sure to enter the issue overview in the description field above.</span></p>
  </div>

	<div class="form-field">
	  <label for="issue_date"><?php _e('Issue Date', ''); ?></label>
	  <input id="issue_date" type="text" name="issue_date" size="10" value=""></input>
    <p><span class="description">Enter the date in plain text for the issue, like 'Fall 2014'.</span></p>
  </div>

  
	<?php
  
  $issue_images = get_option('issue_images');
  $issue_image = $issue_images[$cat_ID];
  
	$post = get_default_post_to_edit( 'post', true );
	$post_ID = $post->ID;
  
  ?>
  
      <div class="form-field">
          	<div id="postimagediv" class="postbox" style="width:95%;" >
                <div class="inside">
                    <?php wp_enqueue_media( array('post' => $post_ID) ); ?>
                    <?php	$thumbnail_ID = get_option( '_wpfifc_taxonomy_term_'.$cat_ID.'_thumbnail_id_', 0 );
                      echo _wp_post_thumbnail_html( $thumbnail_ID, $post_ID );
                      ?>
                  </div>
                  <input type="hidden" name="wpfifc_taxonomies_edit_post_ID" id="wpfifc_taxonomies_edit_post_ID_id" value="<?php echo $post_ID; ?>" />
                  <input type="hidden" name="wpfifc_taxonomies_edit_term_ID" id="wpfifc_taxonomies_edit_term_ID_id" value="<?php echo $term_id; ?>" />
                  
              </div>
</div>  
  
  <?php
}

function method_edit_fields ($tag) {
	$cat_ID = $tag->term_id;
  
	$issue_numbers = get_option('issue_numbers');
	$issue_number = $issue_numbers[$cat_ID];
  $issue_dates = get_option('issue_dates');
  $issue_date = $issue_dates[$cat_ID];
	?>
	<tr class="form-field">
	<th valign="top" scope="row">
	<label for="issue_number"><?php _e('Issue Number', ''); ?></label>
	</th>
	<td>
	<input type="text" name="issue_number" size="10" value="<?php echo $issue_number; ?>">
  <p><span class="description"> If this category is an issue, please enter the number here. Also, make sure to enter the issue overview in the description field above.</span></p>
	</td>
	</tr>
  
	<tr class="form-field">
	<th valign="top" scope="row">
	<label for="issue_date"><?php _e('Issue Date', ''); ?></label>
	</th>
	<td>
	<input type="text" name="issue_date" size="10" value="<?php echo $issue_date; ?>">
  <p><span class="description">Enter the date in plain text for the issue, like 'Fall 2014'.</span></p>
	</td>
	</tr>
  
	<?php
  
  $issue_images = get_option('issue_images');
  $issue_image = $issue_images[$cat_ID];
  
	$post = get_default_post_to_edit( 'post', true );
	$post_ID = $post->ID;
  
  ?>
  
      <tr class="form-field">
		<th>Set Featured Image</th>
          <td>
          	<div id="postimagediv" class="postbox" style="width:95%;" >
                <div class="inside">
                    <?php wp_enqueue_media( array('post' => $post_ID) ); ?>
                    <?php	$thumbnail_ID = get_option( '_wpfifc_taxonomy_term_'.$cat_ID.'_thumbnail_id_', 0 );
                      echo _wp_post_thumbnail_html( $thumbnail_ID, $post_ID );
                      ?>
                  </div>
                  <input type="hidden" name="wpfifc_taxonomies_edit_post_ID" id="wpfifc_taxonomies_edit_post_ID_id" value="<?php echo $post_ID; ?>" />
                  <input type="hidden" name="wpfifc_taxonomies_edit_term_ID" id="wpfifc_taxonomies_edit_term_ID_id" value="<?php echo $term_id; ?>" />
                  
              </div>
      	</td>
	</tr>
  
  <?php
	}
  
  function get_issue_number($tag) {
   
    	$cat_ID = $tag->term_id;
  
    	$issue_numbers = get_option('issue_numbers');
    	$issue_number = $issue_numbers[$cat_ID];
      
      return $issue_number;
  }
  
  function get_issue_image_ID($tag) {
   
    	$cat_ID = $tag->term_id;
  
      $image_id = get_option( '_wpfifc_taxonomy_term_'.$cat_ID.'_thumbnail_id_', 0 );
    
      return $image_ID;
  }
  
  function print_recent_articles($issue_category_id, $current_post_id) {
    //Print three most recent articles from a category
    // -- Excluding current_article
    
    /* Create new query to loop other articles in this issue */
    $query2 = new WP_Query( 'cat='.$issue_category_id );
    $num_posts_printed = 0;

    // The 2nd Loop
    while ( $query2->have_posts() && $num_posts_printed < 3) {
      $query2->next_post();
      
      if ($query2->post->ID != $current_post_id) {
        
        
        
        echo ('<a href="' . get_permalink($query2->post->ID) . '">');
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('', $query2->post->ID); ?>>
        <?php
        echo('<header class="entry-header">');
           
        echo ('<a class="post-thumbnail" href="' . get_permalink($query2->post->ID) . '">');
        echo(get_the_post_thumbnail($query2->post->ID, "post-thumbnail"));
        echo('</a>');
                
        echo '<h2 class="entry-title"><a href="' . get_permalink($query2->post->ID) . '">' . get_the_title( $query2->post->ID ) . '</a></h1>';
        echo '<div class="entry-meta">';
        echo '<a class="author" href="' . get_permalink($query2->post->ID) . '"> by ' . get_the_author_meta('display_name', $query2->post->author) . '</a>';
        echo('</div>');
        echo('</header>');
        echo('</article></a>');
        ?>
        
       
     
        <?php     
        $num_posts_printed = $num_posts_printed + 1;  
      }
    }

    wp_reset_postdata();
  }
  
  function print_issue_header($issue_category) {
        
    $child_id = $issue_category->term_id;
    $child_name = $issue_category->name;
    $child_description = $issue_category->category_description;

    $issue_dates = get_option('issue_dates');
    $child_date = $issue_dates[$child_id];

    $issue_numbers = get_option('issue_numbers');
    $child_number = $issue_numbers[$child_id];
  
    $category_link = get_category_link( $child_id );
    $category_link_html = '<a href="'.esc_url( $category_link ).'"title="'.$child_name.'">';

    // display child category issue number and date
    printf('<div class="issue-number"><h1>Issue %s: %s</h1></div>', $child_number, $child_date);

    // display category header image
    $image_id = get_option( '_wpfifc_taxonomy_term_'.$child_id.'_thumbnail_id_', 0 );
    $image_url = wp_get_attachment_image_src($image_id, 'method-header');
    printf( '<div class="issue-image">%s<img src="%s"></img></a></div>', $category_link_html, $image_url[0]);
  
    // display child category name
    printf('<div class="issue-name">%s<h1>%s</h1></a></div>', $category_link_html, $child_name);
  
    // display description
    printf('<div class="issue-description"><p>%s</p></div>', $child_description);
  
  }
  
  function method_share_buttons($div_id) {
    
    //TODO: new lines not working on email body ?
    
		$urlCurrentPage = get_permalink($post->ID);
		$strPageTitle = get_the_title($post->ID);
    $strPageExcerpt = get_the_excerpt($post->ID);
    
    $twitterShareText = 'Check out ' . $strPageTitle . ' on @methodquarterly ' . $urlCurrentPage;
    $twitter_url = "http://twitter.com/share?url='" . $urlCurrentPage . "'&amp;text='" . $twitterShareText ."'";
    
    $tumblr_url = 'http://tumblr.com/share/link?description=' . $strPageTitle . ' // ' . $strPageExcerpt . '&amp;name=Method Quarterly&amp;url=' . $urlCurrentPage;
    
    $facebook_url = 'http://facebook.com/sharer.php?u=' . $urlCurrentPage;
    
    $email_url = 'mailto:?Subject=Method Quarterly: ' . $strPageTitle . '&amp;Body=I%20thought%20you might be interested in this article on Method Quarterly. ' . $strPageTitle . ' %0d%0a%0d%0a ' . $strPageExcerpt . ' %0d%0a%0d%0a ' . $urlCurentPage; 
    
    $reddit_url = "http://reddit.com/submit?url=" . $urlCurrentPage . "&amp;title=" . $strPageTitle;
    
    $google_url = "http://plus.google.com/share?url=" . $urlCurrentPage;
    
    echo '<div class="method_share" id="' . $div_id . '">';
    echo '<a href="' . $tumblr_url . '" title="Share this on Tumblr" target="_blank" rel="nofollow"><span class="genericon genericon-tumblr"></span></a>';
    echo '<a href="' . $twitter_url . '" title="Share this on Twitter" target="_blank" rel="nofollow"><span class="genericon genericon-twitter"></span></a>';
    echo '<a href="' . $facebook_url . '" title="Share this on facebook" target="_blank" rel="nofollow"><span class="genericon genericon-facebook-alt"></span></a>';
    echo '<a href="' . $email_url . '" title="Email this article" target="_blank" rel="nofollow"><span class="genericon genericon-mail"></span></a>';
    echo '<a href="' . $reddit_url . '" title="Share this on Reddit" target="_blank" rel="nofollow"><span class="genericon genericon-reddit"></span></a>';
    echo '<a href="' . $google_url . '" title="Share this on Google+" target="_blank" rel="nofollow"><span class="genericon genericon-googleplus-alt"></span></a>';
    echo '</div>';
    
  }
  

  function my_new_contactmethods( $contactmethods ) {
  // Add Twitter
  $contactmethods['twitter'] = 'Twitter';
  //add Facebook
  $contactmethods['facebook'] = 'Facebook';


 
  return $contactmethods;
  }
  add_filter('user_contactmethods','my_new_contactmethods',10,1);
