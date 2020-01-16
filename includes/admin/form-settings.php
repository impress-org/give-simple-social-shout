<?php
// Exit if access directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Example code to show how to add metabox tab to give form data settingd.
 *
 * @package     Give
 * @subpackage  Classes/Give_Metabox_Setting_Fields
 * @copyright   Copyright (c) 2020, Impress.org
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class SSS4GiveWP_Form_Settings {
	/**
	 * Give_Metabox_Setting_Fields constructor.
	 */
	function __construct() {
		$this->id     = 'sss4givewp-fields';
		$this->prefix = '_sss4givewp_';
		add_filter( 'give_metabox_form_data_settings', array( $this, 'setup_setting' ), 999 );
	}
	function setup_setting( $settings ) {

		$screen = get_current_screen();
        
        // Custom metabox settings.
		$settings["{$this->id}_tab"] = array(
			'id'        => "{$this->id}_tab",
			'title'     => __( 'Social', 'sss4givewp' ),
			'icon-html' => '<span class="dashicons dashicons-share"></span>',
			'fields'    => array(
				array(
					'id'       => "{$this->id}_status",
					'name'     => __( 'Enabled/Disable', 'sss4givewp' ),
					'type'     => 'radio',
					'desc'     => __( 'You can prevent the Simple Social Sharing from appearing on the Donation Confirmation page per-form by setting this to "Disabled".', 'sss4givewp' ),
					'options' => array( 
                        'enabled' => __('Enabled', 'sss4givewp'),
                        'disabled' => __('Disabled', 'sss4givewp'),
                     ),
                     'default' => 'enabled',
				),
			),
		);
		return $settings;
	}
	
}
new SSS4GiveWP_Form_Settings();