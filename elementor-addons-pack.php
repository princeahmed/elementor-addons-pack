<?php
/**
 * Plugin Name: Elementor Addons Pack
 * Plugin URI:  https://princeboss.com
 * Description: Elementor Addons Pack.
 * Version:     0.0.1
 * Author:      Prince Ahmed
 * Author URI:  http://princeboss.com
 * Text Domain: elementor-addons-pack
 * Domain Path: /languages/
 */

// don't call the file directly
defined( 'ABSPATH' ) || exit;


/**
 * Main initiation class
 *
 * @since 1.0.0
 */
final class Elementor_Addons_Pack {
	/**
	 * WP_Portfolio_Showcase version.
	 *
	 * @var string
	 */
	public $version = '0.0.1';

	/**
	 * Minimum PHP version required
	 *
	 * @var string
	 */
	private $min_php = '5.6.0';

	/**
	 * Minimum PHP version required
	 *
	 * @var string
	 */
	private $min_elementor = '2.5.0';

	/**
	 * Plugin Name
	 *
	 * @var string
	 */
	public $name = 'Elementor Addons Pack';

	/**
	 * The single instance of the class.
	 *
	 * @var WP_Portfolio_Showcase
	 * @since 1.0.0
	 */
	protected static $instance = null;

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'let_the_journey_begin' ] );
	}

	function let_the_journey_begin() {
		if ( $this->check_environment() ) {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
			do_action( 'elementor_addons_pack_loaded' );
		}

	}

	/**
	 * Ensure theme and server variable compatibility
	 *
	 * @return boolean
	 * @since 0.0.1
	 *
	 */
	function check_environment() {
		if ( version_compare( PHP_VERSION, $this->min_php, '<=' ) ) {

			$notice = sprintf(
			/* translators: 1: Minimum PHP Version */
				esc_html__( 'Unsupported PHP version Min required PHP Version:%1$s', 'elementor-addons-pack' ),
				$this->min_php
			);

			$this->add_notice( 'error', $notice );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			return false;
		}

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			$notice = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-addons-pack' ),
				'<strong>' . $this->name . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'elementor-addons-pack' ) . '</strong>'
			);


			$this->add_notice( 'error', $notice );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, $this->min_elementor, '>=' ) ) {
			$notice = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-addons-pack' ),
				'<strong>' . $this->name . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'elementor-addons-pack' ) . '</strong>',
				$this->min_elementor
			);
			$this->add_notice( 'error', $notice );

			deactivate_plugins( plugin_basename( __FILE__ ) );

			return false;
		}

		return true;
	}

	/**
	 * Define Projects Constants.
	 *
	 * @return void
	 * @since 0.0.1
	 *
	 */
	private function define_constants() {
		define( 'ELEMENTOR_ADDONS_PACK_VERSION', $this->version );
		define( 'ELEMENTOR_ADDONS_PACK_FILE', __FILE__ );
		define( 'ELEMENTOR_ADDONS_PACK_PATH', dirname( ELEMENTOR_ADDONS_PACK_FILE ) );
		define( 'ELEMENTOR_ADDONS_PACK_INCLUDES', ELEMENTOR_ADDONS_PACK_PATH . '/includes' );
		define( 'ELEMENTOR_ADDONS_PACK_URL', plugins_url( '', ELEMENTOR_ADDONS_PACK_FILE ) );
		define( 'ELEMENTOR_ADDONS_PACK_ASSETS_URL', ELEMENTOR_ADDONS_PACK_URL . '/assets' );
		define( 'ELEMENTOR_ADDONS_PACK_TEMPLATES_DIR', ELEMENTOR_ADDONS_PACK_PATH . '/templates' );
	}


	/**
	 * Include required core files used in admin and on the frontend.
	 */
	function includes() {

		//core includes
		include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/class-install.php';
		include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/functions.php';
		include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/hooks.php';
		include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/enqueue.php';
		include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/extensions/particles-background.php';

		//admin includes
		if ( is_admin() ) {
			//include_once ELEMENTOR_ADDONS_PACK_INCLUDES . '/class-admin.php';
		}

	}

	/**
	 * Hook into actions and filters.
	 *
	 * @return void
	 * @since 0.0.1
	 *
	 */
	private function init_hooks() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		add_action( 'admin_notices', [ $this, 'admin_notices' ], 15 );

		// Localize plugin
		add_action( 'init', [ $this, 'localization_setup' ] );

		//action_links
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );

		register_activation_hook( __FILE__, [ 'Elementor_Addons_Pack_Install', 'activate' ] );

		Elementor_Addons_Pack_Particles_Background_Extension::init();

	}


	/**
	 * Add custom category.
	 *
	 * @param $elements_manager
	 */
	public function add_category( $elements_manager ) {
		$elements_manager->add_category(
			'elementor-addons-pack',
			[
				'title' => __( 'Addons Pack', 'happy-elementor-addons' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	public function init_widgets() {
		$widgets = [
			'particles' => 'Elementor_Addons_Pack_Particles_Widget',
		];


		foreach ( $widgets as $key => $element ) {
			$file = ELEMENTOR_ADDONS_PACK_INCLUDES . '/widgets/' . $key . '.php';
			if ( is_readable( $file ) ) {
				include $file;
				Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $element );
			}
		}

		include ELEMENTOR_ADDONS_PACK_INCLUDES . '/widgets/test.php';
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	function localization_setup() {
		load_plugin_textdomain( 'elementor-addons-pack', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Plugin action links
	 *
	 * @param array $links
	 *
	 * @return array
	 */
	function plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( '' ) . '">' . __( 'Settings', 'wp-portfolio-showcase' ) . '</a>';

		return $links;
	}

	/**
	 * add admin notice for displaying
	 *
	 * @param $class
	 * @param $message
	 *
	 * @return void
	 * @since 0.0.1
	 *
	 */
	function add_notice( $class, $message ) {

		$notices = get_option( 'elementor_addons_pack_notices', [] );
		if ( is_string( $message ) && is_string( $class ) && ! wp_list_filter( $notices, array( 'message' => $message ) ) ) {

			$notices[] = [
				'message' => $message,
				'class'   => $class
			];

			update_option( 'elementor_addons_pack_notices', $notices );
		}

	}

	/**
	 * Display admin notices
	 *
	 * @return void
	 * @since 0.0.1
	 *
	 */
	function admin_notices() {
		$notices = get_option( 'elementor_addons_pack_notices', [] );
		foreach ( $notices as $notice ) { ?>
            <div class="notice is-dismissible notice-<?php echo $notice['class']; ?>">
                <p><?php echo $notice['message']; ?></p>
            </div>
			<?php
			update_option( 'elementor_addons_pack_notices', [] );
		}
	}


	/**
	 * Main WP_Portfolio_Showcase Instance.
	 *
	 * Ensures only one instance of WP_Portfolio_Showcase is loaded or can be loaded.
	 *
	 * @return WP_Portfolio_Showcase - Main instance.
	 * @since 1.0.0
	 * @static
	 */
	static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

function elementor_addons_pack() {
	return Elementor_Addons_Pack::instance();
}

//fire off the plugin
elementor_addons_pack();