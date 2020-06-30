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
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name The name of this plugin.
	 * @param    string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

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
	 *
	 * @param array $columns An associative array of column headings.
	 *
	 * @return array
	 */
	public function edit_admin_columns( $columns ) {

		$columns = array(
			'cb'                              => '<input type="checkbox" />',
			'project-image'                   => esc_html__( 'Image', 'ajv-portfolio' ),
			'title'                           => esc_html__( 'Title', 'ajv-portfolio' ),
			'taxonomy-ajv_portfolio_category' => esc_html__( 'Categories', 'ajv-portfolio' ),
			'menu-order'                      => esc_html__( 'Order', 'ajv-portfolio' ),
			'date'                            => esc_html__( 'Date', 'ajv-portfolio' ),
			'post-id'                         => esc_html__( 'ID', 'ajv-portfolio' ),
		);

		// Add custom column if meta box is registered.
		if ( apply_filters( 'ajv_portfolio_register_meta_box', true ) ) {

			// Add key value to 4th position in the array.
			$columns = array_slice( $columns, 0, 3, true ) + array( 'client' => __( 'Client', 'ajv-portfolio' ) ) + array_slice( $columns, 3, null, true );

		}

		return $columns;

	}

	/**
	 * Add content to custom post admin table columns.
	 *
	 * @since    1.0.0
	 *
	 * @param string $column The name of the column to display.
	 * @param int    $post_id The current post ID.
	 */
	public function define_admin_columns( $column, $post_id ) {

		global $post;

		// Get post meta.
		$width    = (int) 150;
		$height   = (int) 150;
		$image_id = get_post_meta( $post_id, '_thumbnail_id', true );
		$image    = wp_get_attachment_image( $image_id, array( $width, $height ), false );
		$client   = get_post_meta( $post_id, '_ajv_portfolio_client', true );
		$company  = get_post_meta( $post_id, '_ajv_portfolio_company', true );

		switch ( $column ) {

			// Image column.
			case 'project-image':
				if ( has_post_thumbnail( $post_id ) ) {
					echo wp_kses_post( $image );
				} else {
					echo '<img src="' . esc_url( plugin_dir_url( __FILE__ ) ) . 'images/default-image.svg" class="default-project-image" alt="default project image">';
				}
				break;

			// Client column.
			case 'client':
				if ( $client && $company ) {
					echo esc_html( $client . ' - ' . $company );
				} elseif ( $client && ! $company ) {
					echo esc_html( $client );
				} elseif ( ! $client && $company ) {
					echo esc_html( $company );
				} else {
					echo '—';
				}
				break;

			// Order column.
			case 'menu-order':
				echo absint( $post->menu_order );
				break;

			// ID column.
			case 'post-id':
				echo absint( $post_id );
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
	 *
	 * @param array $columns An associative array of column headings.
	 *
	 * @return array
	 */
	public function sortable_admin_columns( $columns ) {

		// Order column.
		$columns['menu-order'] = array( 'menu_order', 0 );

		return $columns;

	}

	/**
	 * Add custom taxonomy admin table columns.
	 *
	 * @since    1.0.0
	 *
	 * @param array $columns An associative array of column headings.
	 *
	 * @return array
	 */
	public function edit_admin_tax_columns( $columns ) {

		$columns = array(
			'cb'          => '<input type="checkbox" />',
			'name'        => __( 'Name', 'ajv-portfolio' ),
			'description' => __( 'Description', 'ajv-portfolio' ),
			'slug'        => __( 'Slug', 'ajv-portfolio' ),
			'posts'       => __( 'Count', 'ajv-portfolio' ),
			'tax-id'      => __( 'ID', 'ajv-portfolio' ),
		);

		return $columns;

	}

	/**
	 * Add content to custom taxonomy admin table columns.
	 *
	 * @since    1.0.0
	 *
	 * @param string $value Blank string.
	 * @param string $name  The name of the column.
	 * @param int    $id    The taxonomy term ID.
	 */
	public function define_admin_tax_columns( $value, $name, $id ) {

		// Display taxonomy ID.
		return 'tax-id' === $name ? $id : $value;

	}

	/**
	 * Add activation admin notice.
	 *
	 * @since    1.0.0
	 */
	public function admin_notice() {

		$notices = get_option( 'ajv_portfolio_admin_notices' );

		if ( $notices ) {

			foreach ( $notices as $notice ) {

				echo wp_kses_post( $notice );

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

		$url_text = esc_html__( 'click here to update your permalinks', 'ajv-portfolio' );

		// translators: %s: permalinks admin page URL.
		$notices[] = '<div class="notice notice-warning is-dismissible"><p>' . sprintf( esc_html__( 'Please %s and complete the portfolio post type registration.', 'ajv-portfolio' ), '<a href="' . admin_url( 'options-permalink.php' ) . '"><strong>' . $url_text . '</strong></a>' ) . '</p></div>';

		update_option( 'ajv_portfolio_admin_notices', $notices );

	}

}
