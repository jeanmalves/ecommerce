<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * My Form Helpers extended
 *
 * @category	Helpers
 * @author		Rafael Dantas
 */

// ------------------------------------------------------------------------

/**
 * Value Field
 *
 * Grabs a value from the POST array for the specified field so you can
 * re-populate an input field, textarea or select menu. This helper
 * differs from the original set_value() by not need an Form Validation
 * active
 *
 * @access	public
 * @param	array
 * @param	array
 * @return	bool
 */
if ( ! function_exists('value_field'))
{
    function value_field($field = '', $default = '') {
	    return ( isset($_POST[$field]) ? form_prep($_POST[$field], $field) : $default );
	}
}

// ------------------------------------------------------------------------