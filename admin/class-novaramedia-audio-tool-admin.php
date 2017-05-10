<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       novaramedia.com
 * @since      1.0.0
 *
 * @package    Novaramedia_Audio_Tool
 * @subpackage Novaramedia_Audio_Tool/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Novaramedia_Audio_Tool
 * @subpackage Novaramedia_Audio_Tool/admin
 * @author     Novara Media <webmaster@novaramedia.com>
 */
class Novaramedia_Audio_Tool_Admin {

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
		 * defined in Novaramedia_Audio_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Novaramedia_Audio_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/novaramedia-audio-tool-admin.css', array(), $this->version, 'all' );

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
		 * defined in Novaramedia_Audio_Tool_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Novaramedia_Audio_Tool_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name . '_audiotool_script', plugin_dir_url( __FILE__ ) . 'js/novaramedia-audio-tool-admin.js', array( 'jquery' ), $this->version, false );

    wp_localize_script( $this->plugin_name . '_audiotool_script', 'AudioToolVars', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'pluginurl' => plugin_dir_url(__FILE__) . '../'
    ));

    wp_enqueue_script( $this->plugin_name . '_audiotool_script' );

	}

  public function add_admin_menu() {

    // Add top level menu
    add_menu_page(
      null,
      'Audio Tool',
      'edit_posts',
      'novaramedia-audio-tool',
      array( $this, 'audio_settings_page' )
    );

  }

  public function audio_settings_page() {
    include_once( plugin_dir_path( __FILE__ ) . 'partials/novaramedia-audio-tool-admin-display.php' );
  }

  public function ajax_get_audio_post_data() {
    $response = [];

    if ( !empty( $_GET['postId'] ) ) {
      $postId = $_GET['postId'];
      $post = get_post($postId);

      if ( !empty( $post ) ) {
        $response = array(
          'type' => 'success',
          'data' => $post
        );

        $meta = get_post_meta($post->ID);

        if (!empty($meta['_cmb_short_desc'][0])) {
          $response['data']->meta_description = $meta['_cmb_short_desc'][0];
        }

        if (!empty($meta['_cmb_sc'][0])) {
          $response['data']->meta_soundcloud = $meta['_cmb_sc'][0];
        }

        $response['data']->post_tags = wp_get_post_tags( $post->ID, array( 'fields' => 'names' ) );

        $categories = wp_get_post_categories($post->ID, array('fields' => 'names'));
        $show_name_array = array_values(array_diff($categories, ['Audio']));

        $response['data']->post_categories = $categories;
        $response['data']->show_name = $show_name_array[0];

        $response['data']->post_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'full'));
        $response['data']->post_permalink = get_permalink($post->ID);

      } else {
        $response = array(
          'type' => 'error',
          'error' => 'Post not found'
        );
      }
    } else {
      $response = array(
        'type' => 'error',
        'error' => 'Parameter ID missing'
      );
    }

    header('Content-Type: application/json');
    print json_encode($response);
    wp_die();
  }

}
