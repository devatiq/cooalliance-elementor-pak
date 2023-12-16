<?php
namespace Inc\Widgets\Podcasts;

use Inc\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

class Main extends BaseWidget
{
    // define protected variables...
    protected $name = 'coo-alliance-podcasts';
    protected $title = 'COO Alliance Podcasts';
    protected $icon = 'eicon-headphones';
    protected $categories = [
        'coo-alliance-category'
    ];

    protected $keywords = [
        'podcast', 'coo', 'audio'
    ];

    /**
     * Register the widget controls.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'coo_elementor_podcast_list_setting',
            [
                'label' => __('Podcasts Setting', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        //number of post
        $this->add_control(
			'coo_elementor_podcast_list_post_number',
			[
				'label' => esc_html__( 'Number of Podcast Per Page', 'cooalliance-ele' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['custom'],
				'range' => [
					'custom' => [
						'min' => 5,
						'max' => 100,
						'step' => 2,
					]
				],
				'default' => [
					'size' => 10,
				],
			]
		);

          //Player
          $this->add_control(
            'coo_elementor_podcast_list_player_switch',
            [
                'label' => __('Podcasts Player', 'cooalliance-ele'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'cooalliance-ele'),
                'label_off' => __('Hide', 'cooalliance-ele'),
                'return_value' => 'yes',
                'default' => 'label_off',
            ]
        );

          //More Button
          $this->add_control(
            'coo_elementor_podcast_list_read_more_switch',
            [
                'label' => __('More Button', 'cooalliance-ele'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'cooalliance-ele'),
                'label_off' => __('Hide', 'cooalliance-ele'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //More Button Text
        $this->add_control(
            'coo_elementor_podcast_list_read_more_text',
            [
                'label' => __('More Button Text', 'cooalliance-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Listen In…',
                'placeholder' => 'Enter read more text',
                'condition' => [
                    'coo_elementor_podcast_list_read_more_switch' => 'yes',
                ],
            ]
        );

         //subscribe
         $this->add_control(
            'coo_elementor_podcast_list_apple_subs',
            [
                'label' => __('Apple Subscribe Area', 'cooalliance-ele'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'cooalliance-ele'),
                'label_off' => __('Hide', 'cooalliance-ele'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        //Pagination
        $this->add_control(
            'coo_elementor_podcast_list_pagination',
            [
                'label' => __('Pagination', 'cooalliance-ele'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'cooalliance-ele'),
                'label_off' => __('Hide', 'cooalliance-ele'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section(); //end podcasts setting control

        // Title style section
        $this->start_controls_section(
            'coo_elementor_podcast_list_title_style_section',
            [
                'label' => __('Title Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //Title typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_title_typography',
                'label' => __('Title Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-title',
            ]
        );

        $this->start_controls_tabs(
			'coo_elementor_podcast_list_title_style_tabs'
		);

		$this->start_controls_tab(
			'coo_elementor_podcast_list_title_style_normal_tab',
			[
				'label' => esc_html__( 'Title Color', 'cooalliance-ele' ),
			]
		);

		// Title color
        $this->add_control(
            'coo_elementor_podcast_list_title_color',
            [
                'label' => __('Title Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#001489',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'coo_elementor_podcast_list_title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover Color', 'cooalliance-ele' ),
			]
		);

        // Title hover color
        $this->add_control(
            'coo_elementor_podcast_list_title_hover_color',
            [
                'label' => __('Title Hover Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1f9bba',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section(); // end title style

         // Content style section
         $this->start_controls_section(
            'coo_elementor_podcast_content_style_section',
            [
                'label' => __('Content Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //podcasts content typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_excerpt_typography',
                'label' => __('Excerpt Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-excerpt',
            ]
        );

        // podcasts content color
        $this->add_control(
            'coo_elementor_podcast_list_excerpt_color',
            [
                'label' => __('Excerpt Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-excerpt, .coo-elementor-podcast-list-excerpt a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end content style

        // button style section
        $this->start_controls_section(
            'coo_elementor_podcast_list_button_style_section',
            [
                'label' => __('Button Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_list_read_more_switch' => 'yes'
                ],
            ]
        );

          //button typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_button_typography',
                'label' => __('Button Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-more',
            ]
        );

        $this->start_controls_tabs(
			'coo_elementor_podcast_list_button_style_tabs'
		);

		$this->start_controls_tab(
			'coo_elementor_podcast_list_button_style_normal_tab',
			[
				'label' => esc_html__( 'Button Color', 'cooalliance-ele' ),
			]
		);

		// Button color
        $this->add_control(
            'coo_elementor_podcast_list_button_color',
            [
                'label' => __('Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#59a818',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'coo_elementor_podcast_list_button_style_hover_tab',
			[
				'label' => esc_html__( 'Hover Color', 'cooalliance-ele' ),
			]
		);

        // Button Hover color
        $this->add_control(
            'coo_elementor_podcast_list_button_hover_color',
            [
                'label' => __('Hover Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3d3d3d',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section(); // end button style


         // Subscription style section
         $this->start_controls_section(
            'coo_elementor_podcast_list_subs_style_section',
            [
                'label' => __('Subscription Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_list_apple_subs' => 'yes'
                ],
            ]
        );

        //Pagination typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_subs_typography',
                'label' => __('Subscribe Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-subs-btn h4',
            ]
        );

        $this->end_controls_section(); // end subscribe style

         // Pagination style section
         $this->start_controls_section(
            'coo_elementor_podcast_list_pagination_style_section',
            [
                'label' => __('Pagination Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_list_pagination' => 'yes'
                ],
            ]
        );

          //Pagination typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_pagination_typography',
                'label' => __('Pagination Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-pagi-container',
            ]
        );

        $this->start_controls_tabs(
			'coo_elementor_podcast_list_pagination_style_tabs'
		);

		$this->start_controls_tab(
			'coo_elementor_podcast_list_pagination_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'cooalliance-ele' ),
			]
		);

		// Text color
        $this->add_control(
            'coo_elementor_podcast_list_pagi_text_color',
            [
                'label' => __('Text Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-pagi-container a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Text Bg color
        $this->add_control(
            'coo_elementor_podcast_list_pagi_text_bg_color',
            [
                'label' => __('Background Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#001489',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-pagi-container a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'coo_elementor_podcast_list_pagination_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'cooalliance-ele' ),
			]
		);

        // Hover color
        $this->add_control(
            'coo_elementor_podcast_list_pagi_text_hover_color',
            [
                'label' => __('Hover Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-pagi-container a:hover, .coo-elementor-podcast-list-pagi-container .current' => 'color: {{VALUE}};',
                ],
            ]
        );

         // Hover bg color
         $this->add_control(
            'coo_elementor_podcast_list_pagi_text_hover_bg_color',
            [
                'label' => __('Hover Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#1f9bba',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-pagi-container a:hover, .coo-elementor-podcast-list-pagi-container .current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
		$this->end_controls_tabs();
        $this->end_controls_section(); // end pagination style

    }

    /**
     * Render the widget output on the frontend.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        include 'renderview.php';
    }


}