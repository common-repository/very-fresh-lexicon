<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       freshlabs.net
 * @since      1.0.0
 *
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Very_Fresh_Lexicon
 * @subpackage Very_Fresh_Lexicon/admin
 * @author     freshlabg GbR <vlad@freshlabs.de>
 */
class Very_Fresh_Lexicon_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Very_Fresh_Lexicon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Very_Fresh_Lexicon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/very-fresh-lexicon-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Very_Fresh_Lexicon_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Very_Fresh_Lexicon_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/very-fresh-lexicon-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register the settings page
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu() {
		// add_menu_page( 'Very fresh Lexicon settings', 'FLEX Settings', 'edit_others_posts', 'very-fresh-lexicon-settings', array( $this, 'create_admin_interface' ), plugins_url( 'admin/img/icon.png', dirname(__FILE__)), 76.3 );

		// add_menu_page( 'Very fresh Lexicon settings', 'FLEX Settings', 'edit_others_posts', 'very-fresh-lexicon-settings', array( $this, 'create_admin_interface' ), plugins_url( 'admin/img/icon.png', dirname(__FILE__)), 76.3 );
		add_submenu_page(
		    'edit.php?post_type=flex',
		    'FLEX Einstellungen', /*page title*/
		    'Einstellungen', /*menu title*/
		    'manage_options', /*roles and capabiliyt needed*/
		    'flex_settings',
		    array( $this, 'create_admin_interface' ) /*replace with your own function*/
		);
	}


	/**
	 * Register 
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {
		add_option( 'Very_Fresh_Lexicon_css', 'fl-style');
    add_option( 'Very_Fresh_Lexicon_url', 'fl-url');

		register_setting( 'very-fresh-lexicon-options', 'fl-podcaster-custom-style', 'myplugin_callback' );  
    register_setting( 'very-fresh-lexicon-options', 'fl-podcaster-custom-url', 'myplugin_callback' );

		
	}

	/**
	 * Callback function for the admin settings page.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_interface() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/very-fresh-lexicon-admin-display.php';

	}

	/**
	 * FLEX POSTTYPE
	 */
	public function reg_flex_posttype() {
	  $labels = array(
		'name'               => _x( 'Fachlexikon', 'post type general name' ),
		'singular_name'      => _x( 'Fachlexikon Eintrag', 'post type singular name' ),
		'add_new'            => _x( 'Neuer Begriff', 'book' ),
		'add_new_item'       => __( 'Neuen Eintrag in Fachlexikon hinzufügen' ),
		'edit_item'          => __( 'Eintrag im Fachlexikon bearbeiten' ),
		'new_item'           => __( 'Neuen Eintrag' ),
		'all_items'          => __( 'Alle Begriffe' ),
		'view_item'          => __( 'Eintrag anschauen' ),
		'search_items'       => __( 'Eintrag suchen' ),
		'not_found'          => __( 'Kein Eintrag im Fachlexikon unter diesem Namen gefunden.' ),
		'not_found_in_trash' => __( 'Kein Eintrag in Fachlexikon unter diesem Namen gefunden im Papierkorb.' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'FLEX'
	  );

    if(get_option('fl-podcaster-custom-url')) {
      $url_var = get_option('fl-podcaster-custom-url');
    } else {
      $url_var = 'fachlexikon';
    }

	  $args = array(
		'labels'        => $labels,
		'description'   => '',
		'public'        => true,
		'menu_position' => 22,
		'menu_icon'     => plugins_url( 'admin/img/icon.png', dirname(__FILE__)),
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'has_archive'   => true,
			'rewrite' => array( 
				'slug' => $url_var,
				'with_front' => FALSE // if you have a permalink base such as /blog/ then setting this to false ensures your custom post type permalink
			),
	  );

	  register_post_type( 'flex', $args );

		register_taxonomy( 'categories', array('flex'), array(
			'hierarchical' => true, 
			'label' => 'Kategorien', 
			'singular_label' => 'fachlexikon-Kategorie', 
			'rewrite' => array( 'slug' => 'categories', 'with_front'=> false )
			)
		);

		register_taxonomy_for_object_type( 'categories', 'flex' );
    
    flush_rewrite_rules();
	}

}
