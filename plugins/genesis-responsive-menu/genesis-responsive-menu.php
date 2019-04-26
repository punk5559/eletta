<?php 
/*
Plugin Name: Genesis Responsive Menu
Version: 1.0.0
Plugin URI: http://www.igomoon.com/products/plugins/
Description: Plugin that implements Genesis Responsive Menu.
Author: iGoMoon AB
Author URI: http://www.igomoon.com/
License: GPL v3

Genesis Responsive Menu
Copyright (C) 2012-2013, iGoMoon AB - info@igomoon.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/



/*************************
Globala variabler
**************************/


/*************************
Includes
**************************/


//* Load Backstretch script and prepare images for loading
add_action( 'wp_enqueue_scripts', 'genesis_responsive_menu_scripts' );
function genesis_responsive_menu_scripts() {

	wp_enqueue_script( 'genesis_responsive_menu_scripts', plugins_url('/responsive-menu.js', __FILE__), array( 'jquery' ), '1.0.0' );
	wp_enqueue_style('genesis_responsive_menu_styles', plugins_url('/genesis-responsive-menu.css', __FILE__),false,'1.1','all');

}

?>