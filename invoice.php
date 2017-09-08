<?php
/*
Plugin Name: Immab invoice
Plugin URI: https://ideermedmera.se/
Description: This plugin will create invoices and share it with the customers.
Version: 1.0
Author: Ideer med mera
*/


if ( !defined( 'FUNC_PLUGIN_DIR' ) ) {
        define( 'FUNC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    }

    if ( !defined( 'FUNC_PLUGIN_URL' ) ) {
        define( 'FUNC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }



    function immab_create_invoice_review() {
        register_post_type( 'immab_invoice',
            array(
                'labels' => array(
                    'name' => 'Offert',
                    'singular_name' => 'Invoice',
                    'add_new' => 'Skappa nytt',
                    'add_new_item' => 'Skappa nytt offert',
                    'edit' => 'Redigera',
                    'edit_item' => 'Redigera offert',
                    'new_item' => 'Nytt offert',
                    'view' => 'Visa',
                    'view_item' => 'Visa offert',
                    'search_items' => 'Sök efter offert',
                    'not_found' => 'Ingen offert',
                    'not_found_in_trash' => 'Ingen offert i papperskorg',
                    'parent' => 'Parent offert'
                ),

                'public' => true,
                'menu_position' => 3,
                'supports' => array( 'title', 'editor',  ),
                'taxonomies' => array( '' ),
                'menu_icon' =>'dashicons-welcome-widgets-menus',
                'has_archive' => true
            )
        );
    }
    add_action('init', 'immab_create_invoice_review');




    /* adding  single_template with our custom function*/
    add_filter('single_template', 'my_custom_template');

    function my_custom_template($single) {

        global $wp_query, $post;

        /* Checks for single template by post type */
        if ( $post->post_type == 'immab_invoice' ) {
            if ( file_exists( FUNC_PLUGIN_DIR . 'single-immab_invoice.php' ) ) {

                return FUNC_PLUGIN_DIR . 'single-immab_invoice.php';
            }
        }
        return $single;

    }



    function team_styles() {

            wp_enqueue_style( 'team_styles', plugin_dir_url( __FILE__ ). 'style_invoice.css' );

    }

    add_action( 'wp_enqueue_scripts', 'team_styles' );

  // Automatic change the visibility of the post from poblic into protected and auto generate password

    add_filter( 'wp_insert_post_data', function( $data, $postarr ){
        global $immab_password;
            $immab_password = wp_generate_password();
        if ( 'immab_invoice' == $data['post_type'] && 'auto-draft' == $data['post_status'] ) {
            $data['post_password'] =  $immab_password;
        }
        return $data;
    }, '99', 2 );


    // Remove the word protected from the title

    function the_title_trim($title) {

        $title = attribute_escape($title);

        $findthese = array(
            '#Protected:#',
            '#Private:#'
        );

        $replacewith = array(
            '', // What to replace "Protected:" with
            '' // What to replace "Private:" with
        );

        $title = preg_replace($findthese, $replacewith, $title);
        return $title;
    }
    add_filter('the_title', 'the_title_trim');

        //translation

        function change_password_protected_text($output)
        {
            $adminEmail = get_option( 'admin_email' );
            $newPasswordText = 'Det här innehållet är lösenordsskyddat. Vänligen ange ditt lösenord nedan för att visa innehål eller kontakta <a href="mailto:'.antispambot( $adminEmail ).'">'.antispambot( $adminEmail ).'</a>';
            $output = str_replace('This content is password protected. To view it please enter your password below:', $newPasswordText, $output);

            return $output;
        }
        add_filter( 'the_password_form', 'change_password_protected_text', 999);

        function change_password_protected_text1($output)
        {

            $newPasswordText = 'Lösenord';
            $output = str_replace('Password:', $newPasswordText, $output);

            return $output;
        }
        add_filter( 'the_password_form', 'change_password_protected_text1', 999);

        function change_password_protected_text2($output)
        {

            $newPasswordText = 'Skicka';
            $output = str_replace('Enter', $newPasswordText, $output);

            return $output;
        }
        add_filter( 'the_password_form', 'change_password_protected_text2', 999);
        //End translation

         add_action('save_post','save_post_callback'); 
        function save_post_callback($post_id){
                global $post;
                if ($post->post_type == 'immab_invoice')


                    $permalink = get_the_permalink();
                    $post_password = $post->post_password;


                    $to = get_field('kund_epost');




                    $subject = "Logging detaeljar";


                    $message = "Test"; 





                    // More headers
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers .= 'From: <info@example.s>' . "\r\n";



                wp_mail($to,$subject,$message,$headers);

            }