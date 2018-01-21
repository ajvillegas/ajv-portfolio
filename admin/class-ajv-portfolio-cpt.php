<?php

/**
 * The custom post type and taxonomy functionality of the plugin.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/admin
 */

/**
 * The custom post type and taxonomy functionality of the plugin.
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/admin
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Portfolio_CPT {

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
	 * Register the 'Portfolio' custom post type.
	 *
	 * @since    1.0.0
	 */
	public function custom_post_type() {
		
		register_post_type( 'ajv_portfolio', apply_filters( 'ajv_portfolio_post_type_filter', array(
				'labels' => array(
					'name'				=> _x( 'Portfolio', 'post type general name', 'ajv-portfolio' ),
					'singular_name'		=> _x( 'Portfolio Item', 'post type singular name', 'ajv-portfolio' ),
					'menu_name'			=> _x( 'Portfolio', 'admin menu', 'ajv-portfolio' ),
					'name_admin_bar'	=> _x( 'Portfolio Item', 'add new on admin bar', 'ajv-portfolio' ),
					'add_new' 			=> _x( 'Add New', 'portfolio item', 'ajv-portfolio' ),
					'add_new_item' 		=> __( 'Add New Portfolio Item', 'ajv-portfolio' ),
					'new_item' 			=> __( 'New Portfolio Item', 'ajv-portfolio' ),
					'edit_item' 		=> __( 'Edit Portfolio Item', 'ajv-portfolio' ),
					'view_item' 		=> __( 'View Portfolio', 'ajv-portfolio' ),
					'all_items'			=> __( 'All Portfolio Items', 'ajv-portfolio' ),
					'search_items' 		=> __( 'Search Portfolio', 'ajv-portfolio' ),
					'parent_item_colon' => __( 'Parent Portfolio Item:', 'ajv-portfolio' ),
					'not_found' 		=> __( 'No Portfolio Items Found', 'ajv-portfolio' ),
					'not_found_in_trash'=> __( 'No Portfolio Items Found in Trash', 'ajv-portfolio' ),
				),
				'public' 			 => true,
				'publicly_queryable' => true,
				'exclude_from_search'=> false,
				'show_in_menu' 		 => true,
				'show_ui' 			 => true,
				'rewrite' 			 => array( 'slug' => 'portfolio', 'with_front' => true ),
				'query_var'			 => true,
				'capability_type'    => 'post',
				'has_archive' 		 => true,
				'hierarchical' 		 => false,
				'menu_position' 	 => 20,
				'menu_icon'			 => 'dashicons-format-gallery',
				'taxonomies'		 => array( 'ajv_portfolio_category' ),
				'supports' 			 => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'genesis-layouts', 'genesis-seo', 'genesis-cpt-archives-settings' ),
			) )
		);

	}

	/**
	 * Register the 'Portfolio' custom taxonomy.
	 *
	 * @since    1.0.0
	 */
	public function custom_taxonomy() {
		
		register_taxonomy( 'ajv_portfolio_category', 'ajv_portfolio', apply_filters( 'ajv_portfolio_taxonomy_filter', array(
				'labels' => array(
					'name'						=> _x( 'Portfolio Categories', 'taxonomy general name', 'ajv-portfolio' ),
					'singular_name'				=> _x( 'Portfolio Category', 'taxonomy singular name', 'ajv-portfolio' ),
					'menu_name'					=> __( 'Categories', 'ajv-portfolio' ),
					'search_items'				=> __( 'Search Portfolio Categories', 'ajv-portfolio' ),
					'all_items'					=> __( 'All Portfolio Categories', 'ajv-portfolio' ),
					'parent_item'				=> __( 'Parent Portfolio Category', 'ajv-portfolio' ),
					'parent_item_colon' 		=> __( 'Parent Portfolio Category:', 'ajv-portfolio' ),
					'edit_item'					=> __( 'Edit Portfolio Category', 'ajv-portfolio' ),
					'update_item'				=> __( 'Update Portfolio Category', 'ajv-portfolio' ),
					'add_new_item'				=> __( 'Add New Portfolio Category', 'ajv-portfolio' ),
					'new_item_name'				=> __( 'New Portfolio Category Name', 'ajv-portfolio' ),
					'popular_items' 			=> __( 'Popular Categories', 'ajv-portfolio' ),
					'separate_items_with_commas'=> __( 'Separate categories with commas', 'ajv-portfolio' ),
					'add_or_remove_items'		=> __( 'Add or remove categories', 'ajv-portfolio' ),
					'choose_from_most_used'		=> __( 'Choose from the most used categories', 'ajv-portfolio' ),
					'not_found'					=> __( 'No categories found', 'ajv-portfolio' ),
				),
				'public'			 => true,
				'show_ui'			 => true,
				'show_in_menu'		 => true,
				'show_in_nav_menus'	 => true,
				'show_tagcloud'		 => false,
				'hierarchical'		 => true,
				'has_archive'		 => true,
				'show_admin_column'	 => true,
				'rewrite'			 => array( 'slug' => 'portfolio-category', 'with_front' => true ),
			) )
		);

	}
	
}
