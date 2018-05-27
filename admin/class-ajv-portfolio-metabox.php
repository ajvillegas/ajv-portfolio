<?php

/**
 * The custom meta box functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/admin
 */

/**
 * The custom meta box functionality of the plugin.
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Portfolio_Metabox {

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
	 * Register the portfolio post meta boxes.
	 *
	 * @since    1.0.0
	 */
	public function add_portfolio_meta_boxes() {
		
		if ( apply_filters( 'ajv_portfolio_register_meta_box', true ) ) {
		
			add_meta_box( 'ajv-portfolio-details-meta-box', __( 'Project Details', 'ajv-portfolio' ), array( $this, 'portfolio_meta_box' ), 'ajv_portfolio', 'normal', 'high' );
			
		}
		
	}
	
	/**
	 * Define the 'Project Details' post meta box.
	 *
	 * @since    1.0.0
	 */
	public function portfolio_meta_box( $post ) {
		
		wp_nonce_field( basename( __FILE__ ), 'ajv_portfolio_details_nonce' );
		$portfolio_stored_meta = get_post_meta( $post->ID );
		
		// Meta box markup
		include( plugin_dir_path( __FILE__ ) . 'partials/ajv-portfolio-metabox-markup.php' );
			
	}
	
	/**
	 * Save the post meta box values.
	 *
	 * @since    1.0.0
	 */
	public function save_meta_box_values( $post_id ) {
		
		// Check save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'ajv_portfolio_details_nonce' ] ) && wp_verify_nonce( $_POST[ 'ajv_portfolio_details_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		
		// Exit depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}
		
		// Check for input and sanitize/save if needed
		if ( isset( $_POST[ '_ajv_portfolio_description' ] ) ) {
			update_post_meta( $post_id, '_ajv_portfolio_description', esc_textarea( $_POST[ '_ajv_portfolio_description' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_portfolio_client' ] ) ) {
			update_post_meta( $post_id, '_ajv_portfolio_client', sanitize_text_field( $_POST[ '_ajv_portfolio_client' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_portfolio_company' ] ) ) {
			update_post_meta( $post_id, '_ajv_portfolio_company', sanitize_text_field( $_POST[ '_ajv_portfolio_company' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_portfolio_url' ] ) ) {
			update_post_meta( $post_id, '_ajv_portfolio_url', esc_url( $_POST[ '_ajv_portfolio_url' ] ) );
		}
		
		if ( isset( $_POST[ '_ajv_portfolio_url_text' ] ) ) {
			update_post_meta( $post_id, '_ajv_portfolio_url_text', sanitize_text_field( $_POST[ '_ajv_portfolio_url_text' ] ) );
		}
		
	}
	
}
