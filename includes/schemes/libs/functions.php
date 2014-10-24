<?php
/**
 * A few helper functions and function wrappers for the Color Scheme implementation
 * @author Fabian Wolf
 * @since 2.0r2
 * @package cc2
 */

if( !function_exists( 'cc2_init_scheme_helper' ) ) {
	function cc2_init_scheme_helper() {
		global $cc2_color_schemes;
		
		//$cc2_color_schemes = $GLOBALS['cc2_color_schemes'];
		if( empty( $cc2_color_schemes) ) {
			//new __debug( array( 'cc2_color_schemes' => $cc2_color_schemes ), 'init_scheme_helper starts' );
			
			
			//new __debug( defined( 'CC2_COLOR_SCHEMES_CLASS' ) ? 'color_scheme_class is defined' : 'something went HAGGARDLY wrong!' , 'init_scheme_helper starts' );
			
			do_action('cc2_init_color_schemes'); // should be unset-table / replaceable via plugin / filter hooks
			
			if( defined( 'CC2_COLOR_SCHEMES_CLASS') ) {
				
				
				//new __debug( CC2_COLOR_SCHEMES_CLASS, __METHOD__ . ': CC2_COLOR_SCHEMES_CLASS' );
				$_cc2_color_schemes_class = CC2_COLOR_SCHEMES_CLASS;
				
				if( class_exists( $_cc2_color_schemes_class ) ) {
				
					$cc2_color_schemes = $_cc2_color_schemes_class::init();
				}
			}
		}
		
		//new __debug( $cc2_color_schemes, 'init_scheme_helper ends' );
		
		return $cc2_color_schemes;
	}
	cc2_init_scheme_helper();
	
}


if( !function_exists('cc2_get_current_color_scheme') ) {
	function cc2_get_current_color_scheme() {
		$return = false;
		global $cc2_color_schemes;
		
		//cc2_init_scheme_helper();
		
		/*
		if( !isset( $cc2_color_schemes ) ) {
			
			do_action('cc2_init_color_schemes'); // should be unset-table / replaceable via plugin / filter hooks
			
			if( !isset( $cc2_color_schemes ) && isset( $cc2_color_scheme_class) ) {
				$cc2_color_scheme_class::init();
			}
			
		}*/
		
		
		$return = apply_filters('cc2_get_current_color_scheme', $cc2_color_schemes->get_current_color_scheme() );
				
		return $return;
	}
	
}

if( !function_exists('cc2_get_color_schemes') ) {
	function cc2_get_color_schemes() {
		global $cc2_color_schemes;
		$return = false;
		
		//$cc2_color_schemes = $GLOBALS['cc2_color_schemes'];
		
		//new __debug( $cc2_color_schemes, __METHOD__ . ': cc2_color_schemes' );
		
		cc2_init_scheme_helper();
		
		$return = apply_filters('cc2_get_all_color_schemes', $cc2_color_schemes->get_color_schemes() );
				
		return $return;
	}
}

if( !function_exists('cc2_get_color_scheme_by_slug') ) {
	function cc2_get_color_scheme_by_slug( $scheme_slug = false ) {
		$return = false;
	
		if( !empty( $scheme_slug ) && function_exists( 'cc2_get_color_schemes') ) {
			$arrSchemes = cc2_get_color_schemes();
			
			if( isset( $arrSchemes[ $scheme_slug ] ) != false ) {
				$return = $arrSchemes[ $scheme_slug ];
			}
			
		}

		return $return;
	}
	
}