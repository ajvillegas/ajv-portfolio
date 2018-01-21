<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/includes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Portfolio_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name		The name of this plugin.
	 * @param    string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ajv-portfolio-admin.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Add custom post admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function edit_admin_columns( $columns ) {
		
		$columns = array(
	        'cb'							  => '<input type="checkbox" />',
	        'project-image'					  => __( 'Image', 'ajv-portfolio' ),
	        'title'							  => __( 'Title', 'ajv-portfolio' ),
	        'taxonomy-ajv_portfolio_category' => __( 'Categories', 'ajv-portfolio' ),
	        'menu-order'					  => __( 'Order', 'ajv-portfolio' ),
	        'date'							  => __( 'Date', 'ajv-portfolio' ),
	        'post-id'						  => __( 'ID', 'ajv-portfolio' ),
	    );
	    
	    // Add custom column if meta box is registered
		if ( apply_filters( 'ajv_portfolio_register_meta_box', true ) ) {
		    
		    // Add key value to 4th position in the array
		    $columns = array_slice( $columns, 0, 3, true ) + array( 'client' => __( 'Client', 'ajv-portfolio' ) ) + array_slice( $columns, 3, null, true );
		    
	    }
	    
	    return $columns;
		
	}
	
	/**
	 * Add cotent to custom post admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function define_admin_columns( $column, $post_id ) {
		
		global $post;
		
		// Get post meta
		$width = (int) 150;
		$height = (int) 150;
		$image_id = get_post_meta( $post_id, '_thumbnail_id', true );
		$image = wp_get_attachment_image( $image_id, array( $width, $height ), false );
		$client = get_post_meta( $post_id, '_ajv_portfolio_client', true );
		$company = get_post_meta( $post_id, '_ajv_portfolio_company', true );
		
		switch ( $column ) {
			
			// Image column
			case 'project-image':
				if ( has_post_thumbnail( $post_id ) )
					echo $image;
				else
					echo '<img src="' . plugin_dir_url( __FILE__ ) . 'images/default-image.svg" class="default-project-image" alt="default project image">';
				break;
				
			// Client column
			case 'client':
				if ( $client && $company )
					echo $client . ' - ' . $company;
				elseif ( $client && !$company )
					echo $client;
				elseif ( !$client && $company )
					echo $company;
				else
					echo '—';
				break;
			
			// Order column
			case 'menu-order':
				echo $post->menu_order;
				break;
				
			// ID column
			case 'post-id':
				echo $post_id;
				break;
				
			default:
				break;
				
		}
		
	}
	
	/**
	 * Make custom post admin table columns sortable.
	 *
	 * Set the array parameter to 0 or 1 to reverse the
	 * order the column sorts when it's first clicked.
	 *
	 * @since    1.0.0
	 */
	public function sortable_admin_columns( $columns ) {
		
		// Order column
		$columns['menu-order'] = array( 'menu_order', 0 );
		
		return $columns;
		
	}
	
	/**
	 * Add custom taxonomy admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function edit_admin_tax_columns( $columns ) {
		
		$columns = array(
	        'cb'		  => '<input type="checkbox" />',
	        'name'		  => __( 'Name', 'ajv-portfolio' ),
	        'description' => __( 'Description', 'ajv-portfolio' ),
	        'slug'		  => __( 'Slug', 'ajv-portfolio' ),
	        'posts'		  => __( 'Count', 'ajv-portfolio' ),
	        'tax-id'	  => __( 'ID', 'ajv-portfolio' ),
	    );
	    
	    return $columns;
		
	}
	
	/**
	 * Add cotent to custom taxonomy admin table columns.
	 *
	 * @since    1.0.0
	 */
	public function define_admin_tax_columns( $value, $name, $id ) {
		
		// Display taxonomy ID
		return 'tax-id' === $name ? $id : $value;
		
	}
	
	/**
	 * Add activation admin notice.
	 *
	 * @since    1.0.0
	 */
	public function admin_notice() {
		
		if ( $notices = get_option( 'ajv_portfolio_admin_notices' ) ) {
			
			foreach ( $notices as $notice ) {
				
				echo $notice;
				
			}
			
			delete_option( 'ajv_portfolio_admin_notices' );
			
		}
		
	}
	
	/**
	 * Define admin notices and add them to a temporary plugin option.
	 *
	 * @since    1.0.0
	 */
	public static function add_notice() {

	    $notices = get_option( 'ajv_portfolio_admin_notices', array() );
	    
	    $url_text = __( 'click here to update your permalinks', 'ajv-portfolio' );
	    
	    $notices[] = '<div class="notice notice-warning is-dismissible"><p>' . sprintf( __( 'Please %s and complete the portfolio post type registration.', 'ajv-portfolio' ), '<a href="' . admin_url( 'options-permalink.php' ) . '"><strong>' . $url_text . '</strong></a>' ) . '</p></div>';
	    
	    update_option( 'ajv_portfolio_admin_notices', $notices );
	
	}

}
