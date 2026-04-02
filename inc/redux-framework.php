<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = "streamvault_opt";
    $theme = wp_get_theme();

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__( 'StreamVault Options', 'streamvault' ),
        'page_title'           => esc_html__( 'StreamVault Options', 'streamvault' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => false,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-portfolio',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => true,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => '',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '_options',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );


    $pagesx = new WP_Query( array( 
        'post_type' => 'page',
        'posts_per_page' => -1
    ));

    $page_lists = [];

    /* Start the Loop */
    if ( $pagesx->have_posts()) {
        while ( $pagesx->have_posts()) : $pagesx->the_post();
            $page_lists[ get_the_ID() ] = get_the_title();
        endwhile;
    }


    // General
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General', 'streamvault' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'General theme options.', 'streamvault' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'site_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'send_password_to_email_on_registration',
                'type'     => 'switch',
                'title'    => esc_html__( 'Send Password to Email', 'streamvault' ),
                'desc'  => esc_html__( 'A new user has registered on your website.', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'email_on_registration_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'New user registration subject', 'streamvault' ),
                'default'  => esc_html__( 'New user registred on your website', 'streamvault' ),
            ),
            array(
                'id'       => 'email_on_registration_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'New user registration content', 'streamvault' ),
                'desc'     => esc_html__("{{site_name}},{{full_name}},{{email}} will be translated accordingly.", 'streamvault'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'email_on_signup_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'Welcome email subject', 'streamvault' ),
                'default'  => esc_html__( 'Welcome to streamvault and here is your password ', 'streamvault' ),
            ),
            array(
                'id'       => 'email_on_signup_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Welcome email content', 'streamvault' ),
                'desc'     => esc_html__("{{password}}, {{full_name}}, {{email}} will be translated accordingly.", 'streamvault'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),
            array(
                'id'       => 'notification_email_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'Notification content', 'streamvault' ),
                'desc'     => esc_html__("{{site_name}}, {{sender_name}}, {{recipient_name}}, {{reply_url}}, {{message}} will be translated accordingly.", 'streamvault'),
                'args'   => array(
                    'teeny'            => true,
                    'textarea_rows'    => 40
                )
            ),            
            array(
                'id'          => 'login_btn_url',
                'title'       => esc_html__( 'Login Button URL', 'streamvault' ),
                'type'     => 'select',
                'options'  => $page_lists
            ),
            array(
                'id'          => 'signup_btn_url',
                'title'       => esc_html__( 'Sign Up Button URL', 'streamvault' ),
                'type'     => 'select',
                'options'  => $page_lists
            ),
            array(
                'id'          => 'forgot_password_btn_url',
                'title'       => esc_html__( 'Forgot Password Button URL', 'streamvault' ),
                'type'     => 'select',
                'options'  => $page_lists
            ),
            array(
                'id' => 'top_seller_min_amount',
                'type' => 'slider',
                'title' => esc_html__( 'Top Seller Minimum Earnings Amount', 'streamvault' ),
                "default" => 500,
                "min" => 1,
                "step" => 1,
                "max" => 1000000,
                'display_value' => 'text'
            ),
            array(
                'id' => 'commission_rate',
                'type' => 'slider',
                'title' => esc_html__( 'Commission Rate (%)', 'streamvault' ),
                "default" => 10,
                "min" => 0,
                "step" => 1,
                "max" => 100,
                'display_value' => 'text'
            ),
            array(
                'id' => 'minimum_payout',
                'type' => 'slider',
                'title' => esc_html__( 'Minimum Payout', 'streamvault' ),
                "default" => 10,
                "min" => 1,
                "step" => 1,
                "max" => 50000,
                'display_value' => 'text'
            ),

            array(
                'id'          => 'restricted_words_chat',
                'type'        => 'textarea',
                'default'        => 'phone, mobile, contact number, email, gmail, yahoo, outlook',
                'title'       => esc_html__( 'Blocked Words for Live Messaging', 'streamvault' ),
                'desc' => esc_html__( 'Enter words that users cannot use in live chat messages.', 'streamvault' )
            )
        )
    ));

    // Style
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Style', 'streamvault' ),
        'id'     => 'style',
        'desc'   => esc_html__( 'Header menu options.', 'streamvault' ),
        'icon'   => 'el el-edit',
        'fields' => array(
            array(
                'id'       => 'primary_color',
                'type'     => 'color_gradient',
                'title'    => esc_html__('Primary Color', 'streamvault'), 
                'subtitle' => esc_html__('Pick a color for the theme (default: #007efa and #4ba6ff).', 'streamvault'),
                'validate' => 'color',
                'default'  => array(
                    'from' => '#22be0d',
                    'to'   => '#22be0d',
                ),

            ),  
            array(
                'id'       => 'secondary_color',
                'type'     => 'color',
                'title'    => esc_html__('Secondary Color', 'streamvault'), 
                'subtitle' => esc_html__('Pick a color for the theme (default: #1778F2).', 'streamvault'),
                'validate' => 'color',
                'default'  => '#1778F2'
            ),

            array(
                'id'          => 'login_register_image',
                'type'        => 'media',
                'title'       => esc_html__( 'Login Register Image', 'streamvault' ),
            )
        )
    ));


    // Social Login Configuration
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Login Settings', 'streamvault' ),
        'id'     => 'social_login',
        'desc'   => esc_html__( 'Configure social media login options for user authentication.', 'streamvault' ),
        'icon'   => 'el el-share',
        'fields' => array(
            array(
                'id'       => 'enable_social_login',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Login & Registration', 'streamvault' ),
                'default'  => true
            ),
            array(
                'id'       => 'google_client_id',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Client ID', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your Google Client ID for social login integration.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            ),
            array(
                'id'       => 'google_client_secret',
                'type'     => 'text',
                'title'    => esc_html__( 'Google Client Secret', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your Google Client Secret associated with the Client ID.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            ),
            array(
                'id'       => 'facebook_app_id',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook App ID', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your Facebook App ID for social login integration.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            ),
            array(
                'id'       => 'facebook_app_secret',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook App Secret', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your Facebook App Secret associated with the App ID.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            ),
            array(
                'id'       => 'linkedin_client_id',
                'type'     => 'text',
                'title'    => esc_html__( 'LinkedIn Client ID', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your LinkedIn Client ID for social login integration.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            ),
            array(
                'id'       => 'linkedin_client_secret',
                'type'     => 'text',
                'title'    => esc_html__( 'LinkedIn Client Secret', 'streamvault' ),
                'desc'     => esc_html__( 'Enter your LinkedIn Client Secret associated with the Client ID.', 'streamvault' ),
                'required' => array( 'enable_social_login', '=', true )
            )
        )
    ));

    // Typography
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'streamvault' ),
        'id'               => 'page_title_typography',  
        'icon'   => 'el el-pencil',
        'fields'           => array(
            array(
                'id'          => 'streamvault_heading_typography',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading Typography', 'streamvault' ),
                'subtitle'    => esc_html__('H1, H2, H3,H4, H5, H6  Tags', 'streamvault'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array('h1,h2,h3,h4,h5,h6'),
                'units'       =>'px',
                'default'     => array(
                    'color'       => '#333',
                    'font-weight' => '700', 
                    'font-family' => 'Inter', 
                    'google'      => true,
                ),
            ),
            array(
                'id'          => 'streamvault_typography',
                'type'        => 'typography',
                'title'       => esc_html__( 'Typography', 'streamvault' ),
                'subtitle'    => esc_html__('body, p Tags', 'streamvault'),
                'google'      => true, 
                'font-backup' => true,
                'output'      => array('body,p'),
                'units'       =>'px',
                'default'     => array(
                    'color'       => '#444', 
                    'font-weight' => '400',
                    'line-height' => '26px',
                    'font-family' => 'Inter', 
                    'google'      => true,
                    'font-size'   => '16px',
                ),
            )
        )
    ) );

    // Header

    $elementor_library = new WP_Query( array( 
        'post_type' => 'elementor_library',
        'posts_per_page' => -1
    ));

    $template_lists = [];

    /* Start the Loop */
    if ( $elementor_library->have_posts()) {
        while ( $elementor_library->have_posts()) : $elementor_library->the_post();
            $template_lists[ get_the_ID() ] = get_the_title();
        endwhile;
    }
    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header', 'streamvault' ),
        'id'     => 'header',
        'desc'   => esc_html__( 'Header menu options.', 'streamvault' ),
        'icon'   => 'el el-heart-empty',
        'fields' => array(
            array(
                'id'       => 'streamvault_header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'streamvault' ),
                'subtitle' => esc_html__( 'Turn on to activate the sticky header.', 'streamvault' ),
                'default'  => false
            ),
            array(
                'id'       => 'streamvault_header_fullwidth',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header full width', 'streamvault' ),
                'default'  => false
            ),

            array(
                'id'         => 'streamvault_megamenu_template',
                'type'       => 'select',
                'title'      => esc_html__( 'Mega Menu template', 'streamvault' ), 
                'required'   => array( 'streamvault_megamenu_display','equals', true ),
                'desc'       => esc_html__('To set a mega menu template click ', 'streamvault').' <a href="edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=page">'.esc_html__('Here', 'streamvault').'</a>',
                'options'  => $template_lists
            ),

            array(         
                'id'       => 'breadcrumbs',
                'type'     => 'background',
                'output'     => array('.w-breadcrumb-area'),
                'title'    => esc_html__('Breadcrumbs', 'streamvault'),
                'subtitle' => esc_html__('Set breadcrumbs background with image, color', 'streamvault'),
                'default'  => array(
                    'background-color' => '#333',
                )
            ),

            array(
                'id'       => 'breadcrumbs_title_color',
                'type'     => 'color',
                'title'    => esc_html__('Breadcrumbs Title Color', 'streamvault'), 
                'output'     => array('.streamvault-breadcrumb__title, .streamvault-breadcrumb__menu li, .streamvault-breadcrumb__menu li::after, .influencers-pinfo__title, .influencers-pinfo__label'),
                'default'  => '#333'

            )
        )
    ) );



    // WooCommerce
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'WooCommerce', 'streamvault' ),
        'id'    => 'woocommerce',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id' => 'products_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Products Per Page', 'streamvault' ),
                'subtitle' => esc_html__( 'Product per page', 'streamvault' ),
                'desc' => esc_html__('Number of products to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 9,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'shop_layout',
                'type'     => 'select',
                'title'    => esc_html__( 'Store layout', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related products column.', 'streamvault' ),
                'options'  => array(
                    'full_width' => esc_html__( 'Full width','streamvault' ), 
                    'left_sidebar' => esc_html__( 'Left sidebar','streamvault' ), 
                    'right_sidebar' => esc_html__( 'Right sidebar','streamvault' )
                ),
                'default'  => 'full_width',
            ),
            array(
                'id'       => 'shop_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Products Column', 'streamvault' ), 
                'subtitle' => esc_html__( 'Number of column', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related products column.', 'streamvault' ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','streamvault' ), 
                     '6' => esc_html__( 'Two Columns','streamvault' ), 
                     '4' => esc_html__( 'Three Columns','streamvault' ), 
                     '3' => esc_html__( 'Four Columns','streamvault' ), 
                     '2' => esc_html__( 'Six Columns','streamvault' ),
                ),
                'default'  => '3',
            ),
            array(
                'id'       => 'product_title_length',
                'type'     => 'slider',
                'title'    => esc_html__( 'Product title length', 'streamvault' ),
                "default" => 25,
                "min" => 1,
                "step" => 1,
                "max" => 100
            ),
            array(
                'id'       => 'product_title_trimmarker',
                'type'     => 'text',
                'title'    => esc_html__( 'Product title trimmarker', 'streamvault' ),
                'desc'    => esc_html__( 'End character of the title', 'streamvault' ),
                "default" => '...'
            )
        )
    ) );

    // Blog Page
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Page', 'streamvault' ),
        'id'    => 'blog_page',
        'icon'  => 'el el-wordpress',
        'fields'     => array(         
            array(
                'id'       => 'blog_breadcrumb_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Breadcrumb Title', 'streamvault' ),
                'default'  => esc_html__( 'Latest Blog', 'streamvault' ),
            ),   
            array(
                'id'               => 'streamvault_excerpt_length',
                'type'             => 'slider',
                'title'            => esc_html__('Excerpt Length', 'streamvault'),
                'subtitle'         => esc_html__('Controls the excerpt length on blog page','streamvault'),
                "default"          => 55,
                "min"              => 10,
                "step"             => 2,
                "max"              => 130,
                'display_value'    => 'text'
            )
            
        )
    ) );

    // Single Blog
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Single Blog Page', 'streamvault' ),
        'id'    => 'single_blog_page',
        'icon'  => 'el el-wordpress',
        'subsection' => true,
        'fields'     => array(              
            array(
                'id'       => 'social_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'streamvault_blog_details_post_navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Navigation (Next/Previous)', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related Post', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_post_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Post Title', 'streamvault' ),
                'required' => array( 'related_posts','equals', true ),
                'default'  => esc_html__( 'Related Post', 'streamvault' ),
            ),
            array(
                'id' => 'posts_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Related Posts', 'streamvault' ),
                'subtitle' => esc_html__( 'Related posts per page', 'streamvault' ),
                'desc' => esc_html__('Number of related posts to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'required' => array( 'related_posts','equals', true ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_posts_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Posts Column', 'streamvault' ), 
                'subtitle' => esc_html__( 'Number of column', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related posts column.', 'streamvault' ),
                'required' => array( 'related_posts','equals', true ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','streamvault' ), 
                     '6' => esc_html__( 'Two Columns','streamvault' ), 
                     '4' => esc_html__( 'Three Columns','streamvault' ), 
                     '3' => esc_html__( 'Four Columns','streamvault' ), 
                     '2' => esc_html__( 'Six Columns','streamvault' ),
                ),
                'default'  => '3',
            )
        )
    ) );

    // Service Page
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Service Page', 'streamvault' ),
        'id'    => 'service_page',
        'icon'  => 'el el-file-edit',
        'fields'     => array(            
            array(
                'id'       => 'service_auto_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Service Auto Approval', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id' => 'streamvault_service_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Services Per Page', 'streamvault' ),
                'subtitle' => esc_html__( 'Service per page', 'streamvault' ),
                'desc' => esc_html__('Number of Services to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 9,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_services',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related service', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_service_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related service Title', 'streamvault' ),
                'required' => array( 'related_services','equals', true ),
                'default'  => esc_html__( 'Related service', 'streamvault' ),
            ),
            array(
                'id' => 'services_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Related Services', 'streamvault' ),
                'subtitle' => esc_html__( 'Related services per page', 'streamvault' ),
                'desc' => esc_html__('Number of related services to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'required' => array( 'related_services','equals', true ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_services_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'services Column', 'streamvault' ), 
                'subtitle' => esc_html__( 'Number of column', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related services column.', 'streamvault' ),
                'required' => array( 'related_services','equals', true ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','streamvault' ), 
                     '6' => esc_html__( 'Two Columns','streamvault' ), 
                     '4' => esc_html__( 'Three Columns','streamvault' ), 
                     '3' => esc_html__( 'Four Columns','streamvault' ), 
                     '2' => esc_html__( 'Six Columns','streamvault' ),
                ),
                'default'  => '3',
            )
        )
    ) );

    // Job Page
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Job Page', 'streamvault' ),
        'id'    => 'job_page',
        'icon'  => 'el el-file-edit',
        'fields'     => array(         
            array(
                'id'       => 'job_auto_approval',
                'type'     => 'switch',
                'title'    => esc_html__( 'Job Auto Approval', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id' => 'streamvault_job_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Jobs Per Page', 'streamvault' ),
                'subtitle' => esc_html__( 'Job per page', 'streamvault' ),
                'desc' => esc_html__('Number of Jobs to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 9,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_jobs',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related Job', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_job_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Job Title', 'streamvault' ),
                'required' => array( 'related_jobs','equals', true ),
                'default'  => esc_html__( 'Related Job', 'streamvault' ),
            ),
            array(
                'id' => 'services_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Related Jobs', 'streamvault' ),
                'subtitle' => esc_html__( 'Related Jobs per page', 'streamvault' ),
                'desc' => esc_html__('Number of related Jobs to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 10000,
                'required' => array( 'related_jobs','equals', true ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_jobs_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Jobs Column', 'streamvault' ), 
                'subtitle' => esc_html__( 'Number of column', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related Jobs column.', 'streamvault' ),
                'required' => array( 'related_jobs','equals', true ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','streamvault' ), 
                     '6' => esc_html__( 'Two Columns','streamvault' ), 
                     '4' => esc_html__( 'Three Columns','streamvault' ), 
                     '3' => esc_html__( 'Four Columns','streamvault' ), 
                     '2' => esc_html__( 'Six Columns','streamvault' ),
                ),
                'default'  => '3',
            )
        )
    ) );


    // WooCommerce
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'WooCommerce', 'streamvault' ),
        'id'    => 'woocommerce',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'product_title_length',
                'type'     => 'slider',
                'title'    => esc_html__( 'Product title length', 'streamvault' ),
                "default" => 25,
                "min" => 1,
                "step" => 1,
                "max" => 100
            ),
            array(
                'id'       => 'product_title_trimmarker',
                'type'     => 'text',
                'title'    => esc_html__( 'Product title trimmarker', 'streamvault' ),
                'desc'    => esc_html__( 'End character of the title', 'streamvault' ),
                "default" => '...'
            )
        )
    ) );

    // WooCommerce Single
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'WooCommerce Single', 'streamvault' ),
        'id'    => 'woocommerce_single',
        'icon'  => 'el el-shopping-cart',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'woocommerce_social_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_products',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related Products', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'       => 'related_products_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Product Title', 'streamvault' ),
                'required' => array( 'related_products','equals', true ),
                'default'  => esc_html__( 'Related products', 'streamvault' ),
            ),
            array(
                'id' => 'related_products_per_page',
                'type' => 'slider',
                'title' => esc_html__( 'Related Products', 'streamvault' ),
                'subtitle' => esc_html__( 'Related product per page', 'streamvault' ),
                'desc' => esc_html__('Number of related products to display. Min: 1, max: Unlimited, step: 1, default value: 4', 'streamvault'),
                "default" => 4,
                "min" => 1,
                "step" => 1,
                "max" => 12,
                'required' => array( 'related_products','equals', true ),
                'display_value' => 'text'
            ),
            array(
                'id'       => 'related_products_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Products Column', 'streamvault' ), 
                'subtitle' => esc_html__( 'Number of column', 'streamvault' ),
                'desc'     => esc_html__( 'Specify the number of related products column.', 'streamvault' ),
                'required' => array( 'related_products','equals', true ),
                'options'  => array(
                    '12' => esc_html__( 'One Column','streamvault' ), 
                     '6' => esc_html__( 'Two Columns','streamvault' ), 
                     '4' => esc_html__( 'Three Columns','streamvault' ), 
                     '3' => esc_html__( 'Four Columns','streamvault' ), 
                     '2' => esc_html__( 'Six Columns','streamvault' ),
                ),
                'default'  => '3',
            )
        )
    ) );


    // Footer
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer', 'streamvault' ),
        'id'     => 'footer',
        'icon'   => 'el el-arrow-down',
        'fields' => array(
            array(
                'id'          => 'footer_widget_display',
                'type'        => 'switch',
                'title'       => esc_html__( 'Footer widget display', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'         => 'streamvault_footer_template',
                'type'       => 'select',
                'title'      => esc_html__( 'Footer template', 'streamvault' ), 
                'required'   => array( 'footer_widget_display','equals', true ),
                'desc'       => esc_html__('To set a footer template click ', 'streamvault').' <a href="edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=page">'.esc_html__('Here', 'streamvault').'</a>',
                'options'  => $template_lists
            ),
            array(
                'id'          => 'backtotop',
                'type'        => 'switch',
                'title'       => esc_html__( 'Back to top', 'streamvault' ),
                'default'  => true,
            ),
            array(
                'id'              => 'streamvault_copyright_info',
                'type'            => 'editor',
                'title'           => esc_html__( 'Copyright text', 'streamvault' ),
                'subtitle'        => esc_html__( 'Enter your company information here. HTML tags allowed: a, br, em, strong', 'streamvault' ),
                'default'         => esc_html__( 'Copyright © 2024 streamvault All Rights Reserved.', 'streamvault' ),
                'args'            => array(
                'wpautop'         => false,
                'teeny'           => true,
                'textarea_rows'   => 5
                )
            ),
            array(
                'id'          => 'social_media',
                'type'        => 'slides',
                'title'       => esc_html__('Social Media', 'streamvault'),
                'subtitle'    => esc_html__('Unlimited Social Media with drag and drop sortings.', 'streamvault'),
                'placeholder' => array(
                    'title'           => __('Font Awesome Icon (fab fa-twitter)', 'streamvault'),
                    'description'     => __('(Optional)', 'streamvault'),
                    'url'             => __('Give us a link!', 'streamvault'),
                )
            )
        )
    ) );

    // 404 
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( '404 Error', 'streamvault' ),
        'id'     => 'error-page',
        'icon'   => 'el el-error-alt',
        'fields' => array(
            array(
                'id'          => 'streamvault_error_title',
                'type'        => 'text',
                'title'       => esc_html__( 'Error title', 'streamvault' ),
                'default'     => esc_html__( 'Oops! Page Not Found.', 'streamvault' ),
                ),
            array(
                'id'          => 'streamvault_error_image',
                'type'        => 'media',
                'title'       => esc_html__('404 Image', 'streamvault'),
                )
            ),
    ) );