<?php

add_action('give_payment_receipt_before_table', 'sss4givewp_output_sharing_above');
add_action('give_payment_receipt_after_table', 'sss4givewp_output_sharing_below');

function sss4givewp_template_args($args) {

    global $give_receipt_args, $donation;

    $args['ID']     = $donation->ID;
    $args['referral']         = give_get_payment_meta( $args['ID'], '_give_current_url', true );
    $args['form_title']  = give_get_meta( $args['ID'], '_give_payment_form_title', true );
    $args['org'] = get_bloginfo('name');

    $args['give'] = give_get_settings();
    $args['settings'] = array(
        'title' => (!empty($args['give']['sss4give_title']) ? $args['give']['sss4give_title'] : 'Thank you for your Donation!' ),
        'encouragement' => (!empty($args['give']['sss4give_encouragement']) ? $args['give']['sss4give_encouragement'] : __('We\'d love your help spreading the word on SOCIAL MEDIA!!:', 'sss-4-givewp')),
        'channels' => $args['give']['sss4give_channels'],
        'position' => $args['give']['sss4give_position']
    );

    return $args;

    //var_dump($settings['position']);
}

function sss4givewp_output_sharing_above() {

    $settings = sss4givewp_template_args($args = array())['settings'];
    $meta = sss4givewp_template_args($args = array());

    //var_dump($settings);

    if ( $settings['position']=='above' ) {
        include apply_filters( 'sss4givewp_template', SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'templates/basic-template.php');
    }
}

function sss4givewp_output_sharing_below() {

    $settings = sss4givewp_template_args($args = array())['settings'];
    $meta = sss4givewp_template_args($args = array());

    //var_dump($settings);

    if ( $settings['position']=='below' ) {
        include apply_filters( 'sss4givewp_template', SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'templates/basic-template.php');
    }
}