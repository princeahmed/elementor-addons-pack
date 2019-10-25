<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit();

class Elementor_Addons_Pack_Particles_Background_Extension {

	public static function init() {
		add_action( 'elementor/element/common/_section_background/after_section_end', [ __CLASS__, 'add_section' ] );
		add_action( 'elementor/element/after_add_attributes', [ __CLASS__, 'add_attributes' ] );
	}


	public static function add_section( Element_Base $element ) {
		// Start Particle Content
		$element->start_controls_section( 'particle_settings', [
			'label' => __( 'Particle Background', 'sina-ext' ),
			'tab'   => Controls_Manager::TAB_ADVANCED,
		] );

		$element->add_control( 'enable_particle', [
			'label'        => __( 'Enable Particle Background', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'description'         => __( 'Enable Particle Background for the selected widget section.', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'no',
			'selectors' => [
				'{{WRAPPER}}' => ''
			]
		] );

		//Shape
		$element->add_control( 'shape_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Shape', 'elementor-addons-pack' ),
			'description' => __( 'Shape settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$element->add_control( 'stroke_width', [
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
		$element->add_control( 'stroke_color', [
			'label'   => __( 'Stroke Color', 'sina-ext' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#000000',
		] );
		$element->add_control( 'type', [
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
		$element->add_control( 'image', [
			'label'     => __( 'Choose Shape Image', 'plugin-domain' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => Utils::get_placeholder_image_src(),
			],
			'condition' => [
				'type' => 'image',
			]
		] );
		$element->add_control( 'size', [
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
		$element->add_control( 'rand_size', [
			'label'        => __( 'Random Size', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		//Animation
		$element->add_control( 'anim_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Animation', 'elementor-addons-pack' ),
			'description' => __( 'Animation settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$element->add_control( 'size_anim', [
			'label'        => __( 'Enable Size Animation', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$element->add_control( 'size_anim_speed', [
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
		$element->add_control( 'opacity_anim', [
			'label'        => __( 'Enable Opacity Animation', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$element->add_control( 'opacity_anim_speed', [
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
		$element->add_control( 'link_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Line Linked', 'elementor-addons-pack' ),
			'description' => __( 'Line Linked settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$element->add_control( 'link_width', [
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
		$element->add_control( 'link_distance', [
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
		$element->add_control( 'link_opacity', [
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
		$element->add_control( 'link_color', [
			'label'   => __( 'Link Color', 'sina-ext' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#ffffff',
		] );
		$element->add_control( 'ball_color', [
			'label'   => __( 'Ball Color', 'sina-ext' ),
			'type'    => Controls_Manager::COLOR,
			'default' => '#fafafa',
		] );

		//Move
		$element->add_control( 'move_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Move', 'elementor-addons-pack' ),
			'description' => __( 'Move settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$element->add_control( 'direction', [
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
		$element->add_control( 'straight', [
			'label'     => __( 'Straight', 'sina-ext' ),
			'type'      => Controls_Manager::SWITCHER,
			'label_on'  => __( 'Yes', 'sina-ext' ),
			'label_off' => __( 'No', 'sina-ext' ),
		] );
		$element->add_control( 'move_speed', [
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
		$element->add_control( 'mode', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Mode', 'elementor-addons-pack' ),
			'default' => 'out',
			'options' => [
				'out'    => 'Out',
				'bounce' => 'Bounce',
			]
		] );

		//interactivity
		$element->add_control( 'interactivity_heading', [
			'type'        => Controls_Manager::HEADING,
			'label'       => __( 'Interactivity', 'elementor-addons-pack' ),
			'description' => __( 'Interactivity settings', 'elementor-addons-pack' ),
			'separator'   => 'before'
		] );
		$element->add_control( 'on_hover', [
			'label'        => __( 'On Hover', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );
		$element->add_control( 'hover_mode', [
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

		$element->add_control( 'on_click', [
			'label'        => __( 'On Click', 'sina-ext' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'sina-ext' ),
			'label_off'    => __( 'No', 'sina-ext' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		$element->add_control( 'click_mode', [
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

		$element->end_controls_section();
		// End Particle Content
	}

	public static function add_attributes( Element_Base $element ) {
		if ( in_array( $element->get_name(), [ 'column', 'section' ] ) ) {
			return;
		}

		if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			return;
		}

		$settings = $element->get_settings_for_display();

		$element->add_render_attribute( '_wrapper', 'class', 'addons-pack-particle-bg' );
	}


}