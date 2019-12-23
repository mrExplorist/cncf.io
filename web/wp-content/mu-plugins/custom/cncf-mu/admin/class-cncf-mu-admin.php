<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.cncf.io/
 * @since      1.0.0
 *
 * @package    Cncf_Mu
 * @subpackage Cncf_Mu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cncf_Mu
 * @subpackage Cncf_Mu/admin
 * @author     Chris Abraham <cjyabraham@gmail.com>
 */
class Cncf_Mu_Admin {

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
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version    The version of this plugin.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cncf-mu-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cncf-mu-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Registers the custom post types
	 */
	public function register_cpts() {

		$opts = array(
			'labels'       => array(
				'name'          => __( 'People' ),
				'singular_name' => __( 'Person' ),
				'all_items'     => __( 'All People' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-buddicons-buddypress-logo',
			'rewrite'      => array( 'slug' => 'person' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', 'excerpt' ),
		);
		register_post_type( 'cncf_person', $opts );

		$opts = array(
			'labels'       => array(
				'name'          => __( 'Case Studies' ),
				'singular_name' => __( 'Case Study' ),
				'all_items'     => __( 'All Case Studies' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-awards',
			'rewrite'      => array( 'slug' => 'case-study' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		);
		register_post_type( 'cncf_case_study', $opts );

		$opts = array(
			'labels'       => array(
				'name'          => __( 'Case Studies - Chinese' ),
				'singular_name' => __( 'Case Study - Chinese' ),
				'all_items'     => __( 'All Case Studies' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-awards',
			'rewrite'      => array( 'slug' => 'case-study-ch' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		);
		register_post_type( 'cncf_case_study_ch', $opts );

		$opts = array(
			'labels'       => array(
				'name'          => __( 'Webinars' ),
				'singular_name' => __( 'Webinar' ),
				'all_items'     => __( 'All Webinars' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-video-alt3',
			'rewrite'      => array( 'slug' => 'webinar' ),
			'supports'     => array( 'title', 'editor', 'revisions', 'custom-fields' ),
		);
		register_post_type( 'cncf_webinar', $opts );

		$opts = array(
			'labels'       => array(
				'name'          => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'all_items'     => __( 'All Events' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-calendar',
			'rewrite'      => array( 'slug' => 'events' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		);
		register_post_type( 'cncf_event', $opts );

		$opts = array(
			'labels'       => array(
				'name'          => __( 'Projects' ),
				'singular_name' => __( 'Project' ),
				'all_items'     => __( 'All Projects' ),
			),
			'public'       => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'hierarchical' => false,
			'menu_icon'    => 'dashicons-hammer',
			'rewrite'      => array( 'slug' => 'projects' ),
			'supports'     => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields' ),
		);
		register_post_type( 'cncf_project', $opts );

	}


	/**
	 * Registers the extra sidebar for post types
	 *
	 * @param array $sidebars    Existing sidebars in Gutenberg.
	 */
	public function create_sidebar( $sidebars ) {
		// First we define the sidebar with it's tabs, panels and settings.
		$palette = array(
			'dark-fuschia'     => '#6e1042',
			'dark-violet'      => '#411E4F',
			'dark-indigo'      => '#1A267D',
			'dark-blue'        => '#17405c',
			'dark-aqua'        => '#0e5953',
			'dark-green'       => '#0b5329',

			'light-fuschia'    => '#AD1457',
			'light-violet'     => '#6C3483',
			'light-indigo'     => '#4653B0',
			'light-blue'       => '#2874A6',
			'light-aqua'       => '#148f85',
			'light-green'      => '#117a3d',

			'dark-chartreuse'  => '#3d5e0f',
			'dark-yellow'      => '#878700',
			'dark-gold'        => '#8c7000',
			'dark-orange'      => '#784e12',
			'dark-umber'       => '#6E2C00',
			'dark-red'         => '#641E16',

			'light-chartreuse' => '#699b23',
			'light-yellow'     => '#b0b000',
			'light-gold'       => '#c29b00',
			'light-orange'     => '#c2770e',
			'light-umber'      => '#b8510d',
			'light-red'        => '#922B21',
		);

		$sidebar    = array(
			'id'              => 'cncf-sidebar-event',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Event Settings' ),
			'post_type'       => 'cncf_event',
			'data_key_prefix' => 'cncf_event_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'              => 'date_single', // Required.
									'data_type'         => 'meta',
									'unavailable_dates' => array(),
									'data_key'          => 'date_start', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'             => __( 'Start Date', 'my_plugin' ),
									'register_meta'     => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top'     => true, // Display CSS border-top in the editor control.
									'default_value'     => '', // A string with a date that matches 'format'.
									'format'            => 'YYYY/MM/DD',
								),
								array(
									'type'              => 'date_single', // Required.
									'data_type'         => 'meta',
									'unavailable_dates' => array(),
									'data_key'          => 'date_end', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'             => __( 'End Date', 'my_plugin' ),
									'register_meta'     => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top'     => false, // Display CSS border-top in the editor control.
									'default_value'     => '', // A string with a date that matches 'format'.
									'format'            => 'YYYY/MM/DD',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'external_url', // Required if 'data_type' is 'meta'.
									'label'         => __( 'URL to External Event Site' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.cloudfoundry.org/event/summit/',
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'hosts', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Hosts', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => array( 'cncf-organized' ), // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'cncf-organized' => __( 'CNCF-organized', 'my_plugin' ),
										'lf-organized'   => __( 'LF-organized', 'my_plugin' ),
										'third-party'    => __( 'Third party', 'my_plugin' ),
									),
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'city', // Required if 'data_type' is 'meta'.
									'label'         => __( 'City' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'Hamilton',
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		$sidebar    = array(
			'id'              => 'cncf-sidebar-webinar',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Webinar Settings' ),
			'post_type'       => 'cncf_webinar',
			'data_key_prefix' => 'cncf_webinar_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'              => 'date_single', // Required.
									'data_type'         => 'meta',
									'unavailable_dates' => array(),
									'data_key'          => 'date', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'             => __( 'Date', 'my_plugin' ),
									'register_meta'     => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top'     => true, // Display CSS border-top in the editor control.
									'default_value'     => '', // A string with a date that matches 'format'.
									'format'            => 'YYYY/MM/DD',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'time', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Time' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => '10:00 - 11:00 AM CST',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'registration_url', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Registration URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://zoom.com.cn/webinar/register/WN_sMLQLH1JQbWa8CBUtzj0_A',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'recording_url', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Recording URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.youtube.com/watch?v=95pkfWf8DgA',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'speakers', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Speakers' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'Radu Matei, Software Engineer @ Microsoft',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'slides_url', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Registration URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.cncf.io/wp-content/uploads/2019/11/StackRox-Webinar-2019-11-12.pdf',
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		$sidebar    = array(
			'id'              => 'cncf-sidebar-person',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Person Settings' ),
			'post_type'       => 'cncf_person',
			'data_key_prefix' => 'cncf_person_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'company', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Company and/or Title' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'DigitalOcean',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'linkedin', // Required if 'data_type' is 'meta'.
									'label'         => __( 'LinkedIn URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.linkedin.com/in/gilbert-song-939ba737/',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'twitter', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Twitter URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://twitter.com/Gilbert_Songs',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'github', // Required if 'data_type' is 'meta'.
									'label'         => __( 'GitHub URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://github.com/Gilbert88',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'wechat', // Required if 'data_type' is 'meta'.
									'label'         => __( 'WeChat URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://web.wechat.com/donaldliu1874',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'website', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Website URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.weave.works/',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'youtube', // Required if 'data_type' is 'meta'.
									'label'         => __( 'YouTube URL' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.youtube.com/channel/UCJsK5Zbq0dyFZUBtMTHzxjQ',
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		$sidebar    = array(
			'id'              => 'cncf-sidebar-case-study',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Case Study Settings' ),
			'post_type'       => 'cncf_case_study',
			'data_key_prefix' => 'cncf_case_study_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'type', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Case Study Type' ),
									'help'          => __( 'This value will appear in the Case Study tile "READ THE ___ CASE STUDY"', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'Kubernetes',
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'product_type', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Product Type', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => 'installer', // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'installer'    => __( 'Installer', 'my_plugin' ),
										'distribution' => __( 'Distribution', 'my_plugin' ),
										'hosted'       => __( 'Hosted', 'my_plugin' ),
									),
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'cloud_type', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Cloud Type', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => 'public', // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'public'  => __( 'Public', 'my_plugin' ),
										'hybrid'  => __( 'Hybrid', 'my_plugin' ),
										'private' => __( 'Private', 'my_plugin' ),
										'multi'   => __( 'Multi', 'my_plugin' ),
									),
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		$sidebar    = array(
			'id'              => 'cncf-sidebar-case-study',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Case Study Settings' ),
			'post_type'       => 'cncf_case_study_ch',
			'data_key_prefix' => 'cncf_case_study_ch_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'type', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Case Study Type' ),
									'help'          => __( 'This value will appear in the Case Study tile "阅读 ___ 案例研究"', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'Kubernetes',
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'product_type', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Product Type', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => 'installer', // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'installer'    => __( '安装程序 (Installer)', 'my_plugin' ),
										'distribution' => __( '发行版 (Distribution)', 'my_plugin' ),
										'hosted'       => __( '托管 (Hosted)', 'my_plugin' ),
									),
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'cloud_type', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Cloud Type', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => 'public', // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'public'  => __( '公有 (Public)', 'my_plugin' ),
										'hybrid'  => __( '混合 (Hybrid)', 'my_plugin' ),
										'private' => __( '私有 (Private)', 'my_plugin' ),
										'multi' => __( '多云 (Multi)', 'my_plugin' ),
									),
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		$sidebar    = array(
			'id'              => 'cncf-sidebar-project',
			'id_prefix'       => 'cncf_',
			'label'           => __( 'Project Settings' ),
			'post_type'       => 'cncf_project',
			'data_key_prefix' => 'cncf_project_',
			'icon_dashicon'   => 'admin-settings',
			'tabs'            => array(
				array(
					'label'  => __( 'Tab label' ),
					'panels' => array(
						array(
							'label'        => __( 'General' ),
							'initial_open' => true,
							'settings'     => array(
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'external_url', // Required if 'data_type' is 'meta'.
									'label'         => __( 'URL to Project Site' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.envoyproxy.io/',
								),
								array(
									'type'          => 'radio', // Required.
									'data_type'     => 'meta', // Available: 'meta', 'localstorage', 'none'.
									'data_key'      => 'project_stage', // Required if 'data_type' is 'meta' or 'localstorage'.
									'label'         => __( 'Stage', 'my_plugin' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => array( 'sandbox' ), // Value/s from the 'options'.
									'use_toggle'    => false, // Use toggle control instead of checkbox.
									'options'       => array( // Required.
										'sandbox' => __( 'Sandbox', 'my_plugin' ),
										'incubating'   => __( 'Incubating', 'my_plugin' ),
										'graduated'    => __( 'Graduated', 'my_plugin' ),
										'archived'    => __( 'Archived', 'my_plugin' ),
									),
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'github', // Required if 'data_type' is 'meta'.
									'label'         => __( 'GitHub' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => true, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://github.com/coredns/coredns',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'blog', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Blog' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://blog.coredns.io/',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'logos', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Logos' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://github.com/cncf/artwork/blob/master/examples/graduated.md#coredns-logos',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'mail', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Mail' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://groups.google.com/forum/#!forum/coredns-discuss',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'slack', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Slack' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://cloud-native.slack.com/messages/coredns/',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'stack_overflow', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Stack Overflow' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://stackoverflow.com/questions/tagged/coredns',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'twitter', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Twitter' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://twitter.com/corednsio',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'youtube', // Required if 'data_type' is 'meta'.
									'label'         => __( 'YouTube' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://www.youtube.com/channel/UCbWRJZxiaQ8twm6sh7UymoQ',
								),
								array(
									'type'          => 'text', // Required.
									'data_type'     => 'meta',
									'data_key'      => 'gitter', // Required if 'data_type' is 'meta'.
									'label'         => __( 'Gitter' ),
									'register_meta' => true, // This option is applicable only if 'data_type' is 'meta'.
									'ui_border_top' => false, // Display CSS border-top in the editor control.
									'default_value' => '',
									'placeholder'   => 'https://gitter.im/jaegertracing/Lobby',
								),
							),
						),
					),
				),
			),
		);
		$sidebars[] = $sidebar;

		// Return the $sidebars array with our sidebar now included.
		return $sidebars;

	}

	/**
	 * Registers the taxonomies.
	 */
	public function register_taxonomies() {

		$labels = array(
			'name'              => __( 'Countries', 'textdomain' ),
			'singular_name'     => __( 'Country', 'textdomain' ),
			'search_items'      => __( 'Countries', 'textdomain' ),
			'all_items'         => __( 'All Countries', 'textdomain' ),
			'parent_item'       => __( 'Parent Continent', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Continent:', 'textdomain' ),
			'edit_item'         => __( 'Edit Country', 'textdomain' ),
			'update_item'       => __( 'Update Country', 'textdomain' ),
			'add_new_item'      => __( 'Add New Country', 'textdomain' ),
			'new_item_name'     => __( 'New Country Name', 'textdomain' ),
			'menu_name'         => __( 'Countries', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => true,
		);
		register_taxonomy( 'cncf-country', array( 'cncf_event', 'cncf_case_study' ), $args );

		$labels = array(
			'name'              => __( 'Countries', 'textdomain' ),
			'singular_name'     => __( 'Country', 'textdomain' ),
			'search_items'      => __( 'Countries', 'textdomain' ),
			'all_items'         => __( 'All Countries', 'textdomain' ),
			'parent_item'       => __( 'Parent Continent', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Continent:', 'textdomain' ),
			'edit_item'         => __( 'Edit Country', 'textdomain' ),
			'update_item'       => __( 'Update Country', 'textdomain' ),
			'add_new_item'      => __( 'Add New Country', 'textdomain' ),
			'new_item_name'     => __( 'New Country Name', 'textdomain' ),
			'menu_name'         => __( 'Countries', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => true,
		);
		register_taxonomy( 'cncf-country-ch', array( 'cncf_case_study_ch' ), $args );

		$labels = array(
			'name'          => __( 'Projects', 'textdomain' ),
			'singular_name' => __( 'Project', 'textdomain' ),
			'search_items'  => __( 'Projects', 'textdomain' ),
			'all_items'     => __( 'All Projects', 'textdomain' ),
			'edit_item'     => __( 'Edit Project', 'textdomain' ),
			'update_item'   => __( 'Update Project', 'textdomain' ),
			'add_new_item'  => __( 'Add New Project', 'textdomain' ),
			'new_item_name' => __( 'New Project Name', 'textdomain' ),
			'menu_name'     => __( 'Projects', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-project', array( 'cncf_webinar', 'cncf_case_study', 'cncf_case_study_ch' ), $args );

		$labels = array(
			'name'          => __( 'Companies', 'textdomain' ),
			'singular_name' => __( 'Company', 'textdomain' ),
			'search_items'  => __( 'Companies', 'textdomain' ),
			'all_items'     => __( 'All Companies', 'textdomain' ),
			'edit_item'     => __( 'Edit Company', 'textdomain' ),
			'update_item'   => __( 'Update Company', 'textdomain' ),
			'add_new_item'  => __( 'Add New Company', 'textdomain' ),
			'new_item_name' => __( 'New Company Name', 'textdomain' ),
			'menu_name'     => __( 'Companies', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-company', array( 'cncf_webinar' ), $args );

		$labels = array(
			'name'          => __( 'Topics', 'textdomain' ),
			'singular_name' => __( 'Topic', 'textdomain' ),
			'search_items'  => __( 'Topics', 'textdomain' ),
			'all_items'     => __( 'All Topics', 'textdomain' ),
			'edit_item'     => __( 'Edit Topic', 'textdomain' ),
			'update_item'   => __( 'Update Topic', 'textdomain' ),
			'add_new_item'  => __( 'Add New Topic', 'textdomain' ),
			'new_item_name' => __( 'New Topic Name', 'textdomain' ),
			'menu_name'     => __( 'Topics', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-topic', array( 'cncf_webinar' ), $args );

		$labels = array(
			'name'          => __( 'Person Categories', 'textdomain' ),
			'singular_name' => __( 'Category', 'textdomain' ),
			'search_items'  => __( 'Categories', 'textdomain' ),
			'all_items'     => __( 'All Categories', 'textdomain' ),
			'edit_item'     => __( 'Edit Category', 'textdomain' ),
			'update_item'   => __( 'Update Category', 'textdomain' ),
			'add_new_item'  => __( 'Add New Category', 'textdomain' ),
			'new_item_name' => __( 'New Category Name', 'textdomain' ),
			'menu_name'     => __( 'Person Categories', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-person-category', array( 'cncf_person' ), $args );

		$labels = array(
			'name'          => __( 'Challenges', 'textdomain' ),
			'singular_name' => __( 'Challenge', 'textdomain' ),
			'search_items'  => __( 'Challenges', 'textdomain' ),
			'all_items'     => __( 'All Challenges', 'textdomain' ),
			'edit_item'     => __( 'Edit Challenge', 'textdomain' ),
			'update_item'   => __( 'Update Challenge', 'textdomain' ),
			'add_new_item'  => __( 'Add New Challenge', 'textdomain' ),
			'new_item_name' => __( 'New Challenge Name', 'textdomain' ),
			'menu_name'     => __( 'Challenges', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-challenge', array( 'cncf_case_study' ), $args );

		$labels = array(
			'name'          => __( 'Challenges', 'textdomain' ),
			'singular_name' => __( 'Challenge', 'textdomain' ),
			'search_items'  => __( 'Challenges', 'textdomain' ),
			'all_items'     => __( 'All Challenges', 'textdomain' ),
			'edit_item'     => __( 'Edit Challenge', 'textdomain' ),
			'update_item'   => __( 'Update Challenge', 'textdomain' ),
			'add_new_item'  => __( 'Add New Challenge', 'textdomain' ),
			'new_item_name' => __( 'New Challenge Name', 'textdomain' ),
			'menu_name'     => __( 'Challenges', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-challenge-ch', array( 'cncf_case_study_ch' ), $args );

		$labels = array(
			'name'          => __( 'Industries', 'textdomain' ),
			'singular_name' => __( 'Industry', 'textdomain' ),
			'search_items'  => __( 'Industries', 'textdomain' ),
			'all_items'     => __( 'All Industries', 'textdomain' ),
			'edit_item'     => __( 'Edit Industry', 'textdomain' ),
			'update_item'   => __( 'Update Industry', 'textdomain' ),
			'add_new_item'  => __( 'Add New Industry', 'textdomain' ),
			'new_item_name' => __( 'New Industry Name', 'textdomain' ),
			'menu_name'     => __( 'Industries', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-industry', array( 'cncf_case_study' ), $args );

		$labels = array(
			'name'          => __( 'Industries', 'textdomain' ),
			'singular_name' => __( 'Industry', 'textdomain' ),
			'search_items'  => __( 'Industries', 'textdomain' ),
			'all_items'     => __( 'All Industries', 'textdomain' ),
			'edit_item'     => __( 'Edit Industry', 'textdomain' ),
			'update_item'   => __( 'Update Industry', 'textdomain' ),
			'add_new_item'  => __( 'Add New Industry', 'textdomain' ),
			'new_item_name' => __( 'New Industry Name', 'textdomain' ),
			'menu_name'     => __( 'Industries', 'textdomain' ),
		);
		$args   = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => false,
		);
		register_taxonomy( 'cncf-industry-ch', array( 'cncf_case_study_ch' ), $args );
	}


	/**
	 * Removes unneeded menu items from the admin.
	 */
	public function remove_menu_items() {
		remove_menu_page( 'edit-comments.php' );
	}

}