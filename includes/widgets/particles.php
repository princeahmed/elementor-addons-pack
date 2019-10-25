<?php

/**
 * Particle Layer Widget.
 *
 * @since 1.0.0
 */


use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Frontend;


// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


class Elementor_Addons_Pack_Particles_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'addons_pack_particles_bg';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Particles Background', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-parallax';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'elementor-addons-pack' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'particles', 'addons pack particles', 'background' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_style_depends() {
		return [ 'elementor-addons-pack' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_script_depends() {
		return [ 'particles', 'elementor-addons-pack' ];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Particle Content
		$this->start_controls_section(
			'particle_settings',
			[
				'label' => __( 'Particle Settings', 'sina-ext' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		//Shape
		$this->add_control( 'shape_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Shape', 'elementor-addons-pack' ),
			'description' => __( 'Shape settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$this->add_control( 'stroke_width', [
			'label'      => __( 'Stroke Width', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'stroke_color', [
			'label'   => __( 'Stroke Color', 'sina-ext' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#000000',
		] );
		$this->add_control( 'type', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Type', 'elementor-addons-pack' ),
			'default' => 'circle',
			'options' => [
				'circle'   => 'Circle',
				'edge'     => 'Edge',
				'triangle' => 'Triangle',
				'polygon'  => 'Polygon',
				'star'     => 'Star',
				'image'    => 'Image',
			]
		] );
		$this->add_control( 'image', [
			'label'     => __( 'Choose Shape Image', 'plugin-domain' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'type' => 'image',
			]
		] );
		$this->add_control( 'size', [
			'label'      => __( 'Size', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => '3',
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 500,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'rand_size', [
				'label'        => __( 'Random Size', 'sina-ext' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'sina-ext' ),
				'label_off'    => __( 'No', 'sina-ext' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			] );

		//Animation
		$this->add_control( 'anim_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Animation', 'elementor-addons-pack' ),
			'description' => __( 'Animation settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$this->add_control( 'size_anim', [
			'label'        => __( 'Enable Size Animation', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$this->add_control( 'size_anim_speed', [
			'label'      => __( 'Size Animation Speed', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'condition'  => [
				'size_anim!' => ''
			],
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => '20',
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 300,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'opacity_anim', [
			'label'        => __( 'Enable Opacity Animation', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$this->add_control( 'opacity_anim_speed', [
			'label'      => __( 'Opacity Animation Speed', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'condition'  => [
				'opacity_anim!' => ''
			],
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 10,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		//Line Linked
		$this->add_control( 'link_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Line Linked', 'elementor-addons-pack' ),
			'description' => __( 'Line Linked settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$this->add_control( 'link_width', [
			'label'      => __( 'Link Width', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => 1,
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'link_distance', [
			'label'      => __( 'Link Distance', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => 150,
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 2000,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'link_opacity', [
			'label'      => __( 'Link Opacity', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => .4,
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'link_color', [
			'label'   => __( 'Link Color', 'sina-ext' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#ffffff',
		] );
		$this->add_control( 'ball_color', [
				'label'   => __( 'Ball Color', 'sina-ext' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#fafafa',
			] );

		//Move
		$this->add_control( 'move_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Move', 'elementor-addons-pack' ),
			'description' => __( 'Move settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$this->add_control( 'direction', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Direction', 'elementor-addons-pack' ),
			'default' => 'none',
			'options' => [
				'none'         => 'None',
				'top'          => 'Top',
				'top_right'    => 'Top Right',
				'right'        => 'Right',
				'bottom_right' => 'Bottom Right',
				'bottom'       => 'Bottom',
				'bottom_left'  => 'Bottom Left',
				'left'         => 'Left',
				'top_left'     => 'Top Left',
			]
		] );
		$this->add_control( 'straight', [
			'label'     => __( 'Straight', 'sina-ext' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __( 'Yes', 'sina-ext' ),
			'label_off' => __( 'No', 'sina-ext' ),
		] );
		$this->add_control( 'move_speed', [
			'label'      => __( 'Move Speed', 'elementor-addons-pack' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'default'    => [
				'unit' => 'px',
				'size' => 6,
			],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .ha-member-figure' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_control( 'mode', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Mode', 'elementor-addons-pack' ),
			'default' => 'out',
			'options' => [
				'out'    => 'Out',
				'bounce' => 'Bounce',
			]
		] );

		//interactivity
		$this->add_control( 'interactivity_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Interactivity', 'elementor-addons-pack' ),
			'description' => __( 'Interactivity settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$this->add_control( 'on_hover', [
			'label'        => __( 'On Hover', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$this->add_control( 'hover_mode', [
			'type'      => Controls_Manager::SELECT,
			'label'     => __( 'Hover Mode', 'elementor-addons-pack' ),
			'default'   => 'repulse',
			'condition' => [
				'on_hover!' => ''
			],
			'options'   => [
				'grab'    => 'Grab',
				'bubble'  => 'Bubble',
				'repulse' => 'Repulse',
			]
		] );
		$this->add_control( 'on_click', [
			'label'        => __( 'On Click', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$this->add_control( 'click_mode', [
			'type'      => Controls_Manager::SELECT,
			'label'     => __( 'Click Mode', 'elementor-addons-pack' ),
			'condition' => [
				'on_click!' => ''
			],
			'default'   => 'push',
			'options'   => [
				'push'    => 'Push',
				'remove'  => 'Remove',
				'bubble'  => 'Bubble',
				'repulse' => 'Repulse',
			]
		] );

		$this->end_controls_section();
		// End Particle Content
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<?php
	}

}