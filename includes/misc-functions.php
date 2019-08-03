<?php
/**
 * Show plugin dependency notice
 *
 * @since
 */
function __give_addon_boilerplate_dependency_notice() {
	// Admin notice.
	$message = sprintf(
		'<strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a>  %5$s %6$s+ %7$s.',
		__( 'Activation Error:', 'give-addon-boilerplate' ),
		__( 'You must have', 'give-addon-boilerplate' ),
		'https://givewp.com',
		__( 'Give', 'give-addon-boilerplate' ),
		__( 'version', 'give-addon-boilerplate' ),
		GIVE_ADDON_BOILERPLATE_MIN_GIVE_VERSION,
		__( 'for the Give Addon Boilerplate add-on to activate', 'give-addon-boilerplate' )
	);

	Give()->notices->register_notice( array(
		'id'          => 'give-activation-error',
		'type'        => 'error',
		'description' => $message,
		'show'        => true,
	) );
}

/**
 * Notice for No Core Activation
 *
 * @since
 */
function __give_addon_boilerplate_inactive_notice() {
	// Admin notice.
	$message = sprintf(
		'<div class="notice notice-error"><p><strong>%1$s</strong> %2$s <a href="%3$s" target="_blank">%4$s</a> %5$s.</p></div>',
		__( 'Activation Error:', 'give-addon-boilerplate' ),
		__( 'You must have', 'give-addon-boilerplate' ),
		'https://givewp.com',
		__( 'Give', 'give-addon-boilerplate' ),
		__( ' plugin installed and activated for the Give Addon Boilerplate add-on to activate', 'give-addon-boilerplate' )
	);

	echo $message;
}

