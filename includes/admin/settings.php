<?php
// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Example code to show how to add setting page to give settings.
 *
 * @package     Give
 * @subpackage  Classes/Give_BP_Admin_Settings
 * @copyright   Copyright (c) 2016, WordImpress
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class SSS_4_GiveWP_Admin_Settings extends Give_Settings_Page {

	/**
	 * Give_BP_Admin_Settings constructor.
	 */
	function __construct() {
		$this->id    = 'sss4givewp-setting-fields';
		$this->label = esc_html__( 'Social Sharing' );

		$this->default_tab = 'text_fields';

		parent::__construct();
	}

	/**
	 * Get setting.
	 *
	 * @return array
	 */
	function get_settings() {

        $settings = array(
            /**
             * File field setting
             */
            array(
                'name' => esc_html__( 'Sharing Options', 'sss-4-givewp' ),
                'desc' => '',
                'id'   => 'sss4give_settings_header',
                'type' => 'title',
            ),
            array(
                'name' => esc_html__( 'Social Share Title', 'sss-4-givewp' ),
                'desc' => '',
                'default' => sss4givewp_get_default_setting('sss4give_title'),
                'id'   => 'sss4give_title',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Social Share Encouragement', 'sss-4-givewp' ),
                'desc' => '',
                'default' => sss4givewp_get_default_setting('sss4give_encouragement'),
                'id'   => 'sss4give_encouragement',
                'type' => 'textarea',
            ),
            array(
                'name'    => __( 'Checkbox Field Settings', 'sss-4-givewp' ),
                'desc'    => '',
                'id'      => 'sss4give_channels',
                'type'    => 'multicheck',
                'default' => sss4givewp_get_default_setting('sss4give_channels'),
                'options' => array(
                    'fb'   => 'Facebook',
                    'twitter'  => 'Twitter',
                    'linkedin' => 'LinkedIn',
                ),
            ),
            array(
                'name'    => esc_html__( 'Positioning', 'sss-4-givewp' ),
                'desc'    => '',
                'id'      => 'sss4give_position',
                'type'    => 'radio_inline',
                'default' => sss4givewp_get_default_setting('sss4give_position'),
                'options' => array(
                    'above' => __( 'Above the table', 'sss-4-givewp' ),
                    'below' => __( 'Below the table', 'sss-4-givewp' ),
                ),
            ),
            array(
                'id'   => 'file_field_setting',
                'type' => 'sectionend',
            ),
        );

		return $settings;
	}
}

