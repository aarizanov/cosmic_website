<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'vixus_storage_get' ) ) {
	function vixus_storage_get( $var_name, $default = '' ) {
		global $VIXUS_STORAGE;
		return isset( $VIXUS_STORAGE[ $var_name ] ) ? $VIXUS_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'vixus_storage_set' ) ) {
	function vixus_storage_set( $var_name, $value ) {
		global $VIXUS_STORAGE;
		$VIXUS_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'vixus_storage_empty' ) ) {
	function vixus_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $VIXUS_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $VIXUS_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $VIXUS_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $VIXUS_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'vixus_storage_isset' ) ) {
	function vixus_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $VIXUS_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $VIXUS_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $VIXUS_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $VIXUS_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'vixus_storage_inc' ) ) {
	function vixus_storage_inc( $var_name, $value = 1 ) {
		global $VIXUS_STORAGE;
		if ( empty( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = 0;
		}
		$VIXUS_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'vixus_storage_concat' ) ) {
	function vixus_storage_concat( $var_name, $value ) {
		global $VIXUS_STORAGE;
		if ( empty( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = '';
		}
		$VIXUS_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'vixus_storage_get_array' ) ) {
	function vixus_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $VIXUS_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $VIXUS_STORAGE[ $var_name ][ $key ] ) ? $VIXUS_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $VIXUS_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $VIXUS_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'vixus_storage_set_array' ) ) {
	function vixus_storage_set_array( $var_name, $key, $value ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$VIXUS_STORAGE[ $var_name ][] = $value;
		} else {
			$VIXUS_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'vixus_storage_set_array2' ) ) {
	function vixus_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $VIXUS_STORAGE[ $var_name ][ $key ] ) ) {
			$VIXUS_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$VIXUS_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$VIXUS_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'vixus_storage_merge_array' ) ) {
	function vixus_storage_merge_array( $var_name, $key, $value ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$VIXUS_STORAGE[ $var_name ] = array_merge( $VIXUS_STORAGE[ $var_name ], $value );
		} else {
			$VIXUS_STORAGE[ $var_name ][ $key ] = array_merge( $VIXUS_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'vixus_storage_set_array_after' ) ) {
	function vixus_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			vixus_array_insert_after( $VIXUS_STORAGE[ $var_name ], $after, $key );
		} else {
			vixus_array_insert_after( $VIXUS_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'vixus_storage_set_array_before' ) ) {
	function vixus_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			vixus_array_insert_before( $VIXUS_STORAGE[ $var_name ], $before, $key );
		} else {
			vixus_array_insert_before( $VIXUS_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'vixus_storage_push_array' ) ) {
	function vixus_storage_push_array( $var_name, $key, $value ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $VIXUS_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $VIXUS_STORAGE[ $var_name ][ $key ] ) ) {
				$VIXUS_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $VIXUS_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'vixus_storage_pop_array' ) ) {
	function vixus_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $VIXUS_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $VIXUS_STORAGE[ $var_name ] ) && is_array( $VIXUS_STORAGE[ $var_name ] ) && count( $VIXUS_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $VIXUS_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $VIXUS_STORAGE[ $var_name ][ $key ] ) && is_array( $VIXUS_STORAGE[ $var_name ][ $key ] ) && count( $VIXUS_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $VIXUS_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'vixus_storage_inc_array' ) ) {
	function vixus_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( empty( $VIXUS_STORAGE[ $var_name ][ $key ] ) ) {
			$VIXUS_STORAGE[ $var_name ][ $key ] = 0;
		}
		$VIXUS_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'vixus_storage_concat_array' ) ) {
	function vixus_storage_concat_array( $var_name, $key, $value ) {
		global $VIXUS_STORAGE;
		if ( ! isset( $VIXUS_STORAGE[ $var_name ] ) ) {
			$VIXUS_STORAGE[ $var_name ] = array();
		}
		if ( empty( $VIXUS_STORAGE[ $var_name ][ $key ] ) ) {
			$VIXUS_STORAGE[ $var_name ][ $key ] = '';
		}
		$VIXUS_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'vixus_storage_call_obj_method' ) ) {
	function vixus_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $VIXUS_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $VIXUS_STORAGE[ $var_name ] ) ? $VIXUS_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $VIXUS_STORAGE[ $var_name ] ) ? $VIXUS_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'vixus_storage_get_obj_property' ) ) {
	function vixus_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $VIXUS_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $VIXUS_STORAGE[ $var_name ]->$prop ) ? $VIXUS_STORAGE[ $var_name ]->$prop : $default;
	}
}
