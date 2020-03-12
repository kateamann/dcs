<?php
/**
 * Logged in users only
 * Template Name: Viewable only if logged in
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
**/


if ( !is_user_logged_in() ) {
   auth_redirect();
}

genesis();