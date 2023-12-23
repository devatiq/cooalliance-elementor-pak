<?php
namespace Inc\Widgets\Reviews;

use Inc\Widgets\BaseWidget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class Main extends BaseWidget
{
    // define protected variables...
    protected $name = 'coo-alliance-reviews';
    protected $title = 'COO Alliance Reviews';
    protected $icon = 'eicon-facebook-comments';
    protected $categories = [
        'coo-alliance-category'
    ];

    protected $keywords = [
        'podcast', 'coo', 'reviews', 'podcasts reviews',
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
            'coo_elementor_podcast_reviews_setting',
            [
                'label' => __('Podcast Review', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Add Controls for start
        $this->add_control(
            'coo_elementor_podcast_reviews_star_rating',
            [
                'label' => __('Star Rating', 'cooalliance-ele'),
                'type' => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => __('1 Star', 'cooalliance-ele'),
                    '2' => __('2 Stars', 'cooalliance-ele'),
                    '3' => __('3 Stars', 'cooalliance-ele'),
                    '4' => __('4 Stars', 'cooalliance-ele'),
                    '5' => __('5 Stars', 'cooalliance-ele'),
                ],
                'description' => __('Select the number of stars for the review.', 'cooalliance-ele'),
            ]
        );
        // Add Controls for review time
        $this->add_control(
            'coo_elementor_podcast_reviews_time',
            [
                'label' => __('Time', 'cooalliance-ele'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => __('Enter time', 'cooalliance-ele'),
                'description' => __('Write the time associated with the podcast review.', 'cooalliance-ele'),
            ]
        );
        // Add Controls for feedback
        $this->add_control(
            'coo_elementor_podcast_reviews_feedback_text',
            [
                'label' => __('Feedback Text', 'cooalliance-ele'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Enter your feedback here...', 'cooalliance-ele'),
                'placeholder' => __('Type your feedback...', 'cooalliance-ele'),
                'description' => __('Write the feedback text for the podcast review.', 'cooalliance-ele'),
            ]
        );


        $this->end_controls_section();

        // Add Style Section
        $this->start_controls_section(
            'coo_elementor_podcast_reviews_style',
            [
                'label' => __('Style', 'cooalliance-ele'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Box Background
        $this->add_control(
            'coo_elementor_podcast_reviews_box_background',
            [
                'label' => __('Box Background', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcasts-review-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Box Padding
        $this->add_control(
            'coo_elementor_podcast_reviews_box_padding',
            [
                'label' => __('Box Padding', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcasts-review-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //box border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'coo_elementor_podcast_reviews_box_border',
                'label' => __('Box Border', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcasts-review-area',
            ]
        );

        //box border radius
        $this->add_responsive_control(
            'coo_elementor_podcast_reviews_box_border_radius',
            [
                'label' => __('Box Border Radius', 'cooalliance-ele'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcasts-review-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Star Size
        $this->add_control(
            'coo_elementor_podcast_reviews_star_size',
            [
                'label' => __('Star Size', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-review-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Star Color
        $this->add_control(
            'coo_elementor_podcast_reviews_star_color',
            [
                'label' => __('Star Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-review-rating i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Time Color
        $this->add_control(
            'coo_elementor_podcast_reviews_time_color',
            [
                'label' => __('Time Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-review-time p' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Time Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_reviews_time_typography',
                'label' => __('Time Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-review-time p',
            ]
        );

        // Feedback Color
        $this->add_control(
            'coo_elementor_podcast_reviews_feedback_color',
            [
                'label' => __('Feedback Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-feedback p' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Feedback Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coo_elementor_podcast_reviews_feedback_typography',
                'label' => __('Feedback Typography', 'cooalliance-ele'),
                'selector' => '{{WRAPPER}} .coo-elementor-podcast-feedback p',
            ]
        );

        // Quote Size
        $this->add_control(
            'coo_elementor_podcast_reviews_quote_size',
            [
                'label' => __('Quote Size', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-review-quote i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Quote Color
        $this->add_control(
            'coo_elementor_podcast_reviews_quote_color',
            [
                'label' => __('Quote Color', 'cooalliance-ele'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-review-quote i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Quote Position slider
        $this->add_control(
            'coo_elementor_podcast_reviews_quote_position',
            [
                'label' => __('Quote Position', 'cooalliance-ele'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .coo-elementor-podcast-review-quote i' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //end of section
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