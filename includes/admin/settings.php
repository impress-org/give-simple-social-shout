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
class GiveWP_PT4FB_Admin_Settings extends Give_Settings_Page {

	/**
	 * Give_BP_Admin_Settings constructor.
	 */
	function __construct() {
		$this->id    = 'givewppt4fb-setting-fields';
		$this->label = esc_html__( 'FB Pixel Tracking' );

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
                'id'   => 'givewppt4fb_settings_header',
                'type' => 'title',
            ),
            array(
                'name' => esc_html__( 'Social Share Title', 'sss-4-givewp' ),
                'desc' => '',
                'default' =>'',
                'id'   => 'givewppt4fb_title',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Social Share Encouragement', 'sss-4-givewp' ),
                'desc' => '',
                'default' => '',
                'id'   => 'givewppt4fb_encouragement',
                'type' => 'textarea',
            ),
            array(
                'name'    => __( 'Checkbox Field Settings', 'sss-4-givewp' ),
                'desc'    => '',
                'id'      => 'givewppt4fb_channels',
                'type'    => 'multicheck',
                'default' => '',
                'options' => array(
                    'fb'   => 'Facebook',
                    'twitter'  => 'Twitter',
                    'linkedin' => 'LinkedIn',
                ),
            ),
            array(
                'name'    => esc_html__( 'Positioning', 'sss-4-givewp' ),
                'desc'    => '',
                'id'      => 'givewppt4fb_position',
                'type'    => 'radio_inline',
                'default' => '',
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

