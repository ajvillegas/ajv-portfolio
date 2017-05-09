<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/includes
 * @author     Alexis J. Villegas <alexis@ajvillegas.com>
 */
class AJV_Portfolio {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      AJV_Portfolio_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'ajv-portfolio';
		$this->version = '1.0.0';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_cpt_hooks();
		$this->define_metabox_hooks();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - AJV_Portfolio_Loader. Orchestrates the hooks of the plugin.
	 * - AJV_Portfolio_i18n. Defines internationalization functionality.
	 * - AJV_Portfolio_CPT. Defines all hooks for registering custom post types and taxonomies.
	 * - AJV_Portfolio_Metabox. Defines all hooks related to the meta box functionality.
	 * - AJV_Portfolio_Admin. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ajv-portfolio-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ajv-portfolio-i18n.php';
		
		/**
		 * The class responsible for defining all actions for registering custom post types and taxonomies.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-portfolio-cpt.php';
		
		/**
		 * The class responsible for defining all actions related to the meta box functionality.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-portfolio-metabox.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ajv-portfolio-admin.php';

		$this->loader = new AJV_Portfolio_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the AJV_Portfolio_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new AJV_Portfolio_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}
	
	/**
	 * Register all of the hooks related to the custom post type functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_cpt_hooks() {

		$plugin_cpt = new AJV_Portfolio_CPT( $this->get_plugin_name(), $this->get_version() );

		// Register custom post type
		$this->loader->add_action( 'init', $plugin_cpt, 'custom_post_type' );
		
		// Register custom taxonomy
		$this->loader->add_action( 'init', $plugin_cpt, 'custom_taxonomy' );

	}
	
	/**
	 * Register all of the hooks related to the custom meta box functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_metabox_hooks() {

		$plugin_metabox = new AJV_Portfolio_Metabox( $this->get_plugin_name(), $this->get_version() );
		
		// Register custom post meta box
		$this->loader->add_action( 'add_meta_boxes_ajv_portfolio', $plugin_metabox, 'add_portfolio_meta_boxes' );
		
		// Save meta box values
		$this->loader->add_action( 'save_post', $plugin_metabox, 'save_meta_box_values' );
		
		// Filter the post title placeholder text
		$this->loader->add_filter( 'enter_title_here', $plugin_metabox, 'custom_enter_title' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new AJV_Portfolio_Admin( $this->get_plugin_name(), $this->get_version() );
		
		// Enqueue styles
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		
		// Add custom post admin table columns
		$this->loader->add_filter( 'manage_ajv_portfolio_posts_columns', $plugin_admin, 'edit_admin_columns' );
		
		// Add cotent to custom post admin table columns
		$this->loader->add_action( 'manage_ajv_portfolio_posts_custom_column', $plugin_admin, 'define_admin_columns', 10, 2 );
		
		// Make custom post admin table columns sortable
		$this->loader->add_action( 'manage_edit-ajv_portfolio_sortable_columns', $plugin_admin, 'sortable_admin_columns' );
		
		// Add custom taxonomy admin table columns
		$this->loader->add_filter( 'manage_edit-ajv_portfolio_category_columns', $plugin_admin, 'edit_admin_tax_columns' );
		
		// Add cotent to custom taxonomy admin table columns
		$this->loader->add_action( 'manage_ajv_portfolio_category_custom_column', $plugin_admin, 'define_admin_tax_columns', 10, 3 );
		
		// Add activation admin notice
		$this->loader->add_action( 'admin_notices', $plugin_admin, 'admin_notice' );
		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    AJV_Portfolio_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
