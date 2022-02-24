<?php

add_action('give_payment_receipt_before_table', 'sss4givewp_output_sharing_above');
add_action('give_payment_receipt_after_table', 'sss4givewp_output_sharing_below');

function sss4givewp_template_args($args) {

    global $give_receipt_args, $donation;


    $args['ID']     = $donation->ID;
    $args['form_id'] = get_post_meta( $args['ID'], '_give_payment_form_id', true );
    $args['form_meta'] = get_post_meta( $args['form_id'] );
    $args['share_status'] = $args['form_meta']['sss4givewp-fields_status'];
    $args['enabled'] = give_get_meta( $args['ID'], 'sss4givewp-fields_status' );
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
}

function get_sss4givewp_template() {
    if (locate_template('sss4givewp.php') != '') {
        $template = get_template_directory() . '/sss4givewp.php';
    } else {
        $template = SIMPLE_SOCIAL_SHARE_4_GIVEWP_DIR . 'templates/basic-template.php';
    }
    return $template;
}

function sss4givewp_output_sharing_above() {

    $settings = sss4givewp_template_args($args = array())['settings'];
    $meta = sss4givewp_template_args($args = array());

    if ( $settings['position']=='above' ) {
        include get_sss4givewp_template();
    }
}

function sss4givewp_output_sharing_below() {

    $settings = sss4givewp_template_args($args = array())['settings'];
    $meta = sss4givewp_template_args($args = array());

    if ( $settings['position']=='below' ) {
        include get_sss4givewp_template($template);
    }
}


/**
 * Return set of default setting or defaultvalue for specific option
 *
 * @param mixed|null $setting_name
 *
 * @return mixed|null
 */
function sss4givewp_get_default_setting( $setting_name = null ) {
	$setting = array(
		'sss4give_title'         => __( 'Thank You for Your Donation!', 'sss-4-givewp' ),
		'sss4give_encouragement' => __( 'We\'d love your help spreading the word on social media:', 'sss-4-givewp' ),
		'sss4give_channels'      => array( 'fb', 'twitter' ),
		'sss4give_position'      => 'above',
	);

	if ( null !== $setting_name ) {
		if ( array_key_exists( $setting_name, $setting ) ) {
			return $setting[ $setting_name ];
		}

		return null;
	}

	return $setting;
}
