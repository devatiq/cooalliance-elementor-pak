<?php
namespace Inc\Widgets\CaptivatePlayerSingle;

use Inc\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class Main extends BaseWidget
{
    // define protected variables...
    protected $name = 'coo-alliance-player-single';
    protected $title = 'COO Captivate Single Player';
    protected $icon = 'eicon-play';
    protected $categories = [
        'coo-alliance-category'
    ];

    protected $keywords = [
        'podcast', 'coo', 'player', 'captivate',
    ];

    /**
     * Register the widget controls.
     */
    protected function register_controls()
    {

		$this->start_controls_section(
            'coo_elementor_podcast_player_single_setting',
            [
                'label' => __('Player Settings', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		//player name
		$this->add_control(
			'coo_elementor_podcast_player_single_title',
			[
				'label' => esc_html__( 'Player Title', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Podcast 01', 'cooalliance-ele' ),
			]
		);

		//player URL
		$this->add_control(
			'coo_elementor_podcast_player_single_url',
			[
				'label' => esc_html__( 'Player URL', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'placeholder' => esc_html__( 'Enter Captivate Player URL', 'cooalliance-ele' ),
			]
		);

		//end of section
        $this->end_controls_section();

		//player style
        $this->start_controls_section(
            'coo_elementor_podcast_player_single_style',
            [
                'label' => __('Player Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //Player width
        $this->add_responsive_control(
			'coo_elementor_podcast_player_single_width',
			[
				'label' => esc_html__( 'Player Width', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'rem'],
				'range' => [
					'rem' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .coo-elementor-player-individual iframe' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        //Player height
        $this->add_responsive_control(
			'coo_elementor_podcast_player_single_height',
			[
				'label' => esc_html__( 'Player Width', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem'],
				'range' => [
					'rem' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 13,
				],
				'selectors' => [
					'{{WRAPPER}} .coo-elementor-player-individual iframe' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

         //Player spacing
        $this->add_responsive_control(
			'coo_elementor_podcast_player_single_spacing',
			[
				'label' => esc_html__( 'Player Spacing', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'px',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .coo-elementor-player-individual iframe' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

         //Player radius
        $this->add_responsive_control(
			'coo_elementor_podcast_player_single_radius',
			[
				'label' => esc_html__( 'Edge Radius', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => 4,
					'right' => 4,
					'bottom' => 4,
					'left' => 4,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .coo-elementor-player-individual iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        
        //end of section
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     */
    protected function render()
    {
        include 'renderview.php';
    }

}