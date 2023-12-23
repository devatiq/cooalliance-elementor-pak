<?php
namespace Inc\Widgets\Podcasts;

use Inc\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

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

        // Switch for enabling or disabling search fields
        $this->add_control(
            'coo_elementor_podcast_search_switch',
            [
                'label' => esc_html__( 'Enable Search Fields', 'cooalliance-ele' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'cooalliance-ele' ),
                'label_off' => esc_html__( 'Off', 'cooalliance-ele' ),
                'return_value' => 'yes',
                'default' => 'yes',
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
        // Subscribe Button URL
        $this->add_control(
            'coo_elementor_podcast_list_subscribe_url',
            [
                'label' => __('Subscribe Button URL', 'cooalliance-ele'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://example.com/subscribe',
                'description' => __('Enter the URL for the subscribe button', 'cooalliance-ele'),
                'show_external' => true,
                'default' => [
                    'url' => 'https://itunes.apple.com/us/podcast/second-in-command-the-chief-behind-the-chief/id1368800817',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'condition' => [
                    'coo_elementor_podcast_list_apple_subs' => 'yes',
                ],
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
                'label' => __('Title', 'cooalliance-ele'),
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
                'label' => __('Content', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

          //podcasts content typography
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_excerpt_typography',
                'label' => __('Excerpt Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-excerpt, {{WRAPPER}} .coo-elementor-podcast-list-excerpt p',
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
                    '{{WRAPPER}} .coo-elementor-podcast-list-excerpt, {{WRAPPER}} .coo-elementor-podcast-list-excerpt a, {{WRAPPER}} .coo-elementor-podcast-list-excerpt p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // end content style

        // button style section
        $this->start_controls_section(
            'coo_elementor_podcast_list_button_style_section',
            [
                'label' => __('Button', 'cooalliance-ele'),
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
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-more a',
            ]
        );
        
        // Button border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'coo_elementor_podcast_list_button_border',
                'label' => __('Button Border', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-list-more a',
            ]
        );

        // Button border-radius control
        $this->add_control(
            'coo_elementor_podcast_list_button_border_radius',
            [
                'label' => __('Button Border Radius', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Button padding control
        $this->add_control(
            'coo_elementor_podcast_list_button_padding',
            [
                'label' => __('Button Padding', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Button background color
        $this->add_control(
            'coo_elementor_podcast_list_button_bg_color',
            [
                'label' => __('Background Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a' => 'background-color: {{VALUE}};',
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
        // Button Hover background color
        $this->add_control(
            'coo_elementor_podcast_list_button_hover_bg_color',
            [
                'label' => __('Hover Background Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a:hover' => 'background-color: {{VALUE}};',
                ],
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
        // Button Border Hover Color
        $this->add_control(
            'coo_elementor_podcast_list_button_border_hover_color',
            [
                'label' => __('Border Hover Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3578e5',
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-list-more a:hover' => 'border-color: {{VALUE}};',
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
                'label' => __('Subscription', 'cooalliance-ele'),
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
                'label' => __('Pagination', 'cooalliance-ele'),
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

        $this->start_controls_section(
            'coo_elementor_podcast_list_search_field_section',
            [
                'label' => esc_html__('Search Field', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'coo_elementor_podcast_search_switch' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_field_placeholder',
            [
                'label' => esc_html__('Search Placeholder', 'cooalliance-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search Podcasts...', 'cooalliance-ele'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_label',
            [
                'label' => esc_html__('Search Button Label', 'cooalliance-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search', 'cooalliance-ele'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // Style section for the search form
        $this->start_controls_section(
            'coo_elementor_podcast_search_form_style_section',
            [
                'label' => esc_html__('Search Box', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_search_switch' => 'yes',
                ],
            ]
        );

       //gap
        $this->add_responsive_control(
            'coo_elementor_podcast_search_form_gap',
            [
                'label' => esc_html__('Gap', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search form' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'coo_elementor_podcast_search_form_background',
                'label' => esc_html__('Background', 'cooalliance-ele'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-search-form',
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_form_padding',
            [
                'label' => esc_html__('Padding', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_form_margin',
            [
                'label' => esc_html__('Margin', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_form_border_radius',
            [
                'label' => esc_html__('Border Radius', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Start of Search Input Section
        $this->start_controls_section(
            'coo_elementor_podcast_search_input_section',
            [
                'label' => esc_html__('Search Input', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_search_switch' => 'yes',
                ]
            ]
        );
  

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'coo_elementor_podcast_search_input_background',
                'label' => esc_html__('Input Background', 'cooalliance-ele'),
                'types' => ['classic', 'gradient'],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-search-field',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'coo_elementor_podcast_search_input_border',
                'label' => esc_html__('Input Border', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-search-field',
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_input_width',
            [
                'label' => esc_html__('Width', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-field' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_input_height',
            [
                'label' => esc_html__('Height', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-field' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_input_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-field::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );
        // End of Search Input Section
        $this->end_controls_section();

        // Start of Submit Button Section
        $this->start_controls_section(
            'coo_elementor_podcast_search_submit_section',
            [
                'label' => esc_html__('Submit Button', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'coo_elementor_podcast_search_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_search_submit_typography',
                'label' => esc_html__('Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-search-submit',
            ]
        );

        //submit button width
        $this->add_responsive_control(
            'coo_elementor_podcast_search_submit_width',
            [
                'label' => esc_html__('Width', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
            ],
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_border_radius',
            [
                'label' => esc_html__('Button Border Radius', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('coo_elementor_podcast_search_submit_tabs');

        $this->start_controls_tab(
            'coo_elementor_podcast_search_submit_normal_tab',
            [
                'label' => esc_html__('Normal', 'cooalliance-ele'),
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_text_color',
            [
                'label' => esc_html__('Text Color', 'cooalliance-ele'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_bg_color',
            [
                'label' => esc_html__('Background Color', 'cooalliance-ele'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'coo_elementor_podcast_search_submit_hover_tab',
            [
                'label' => esc_html__('Hover', 'cooalliance-ele'),
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'coo_elementor_podcast_search_submit_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'cooalliance-ele'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-search-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

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