<?php 
/*
Plugin Name: Sidebarmenu
Version: 1.0.1
Plugin URI: http://www.igomoon.com/products/plugins/
Description: 
Author: iGoMoon AB
Author URI: http://www.igomoon.com/
License: GPL v3

iGoMoon Testimonials
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

$prefix = 'menuuu';

/*************************
Includes
**************************/

add_action( 'wp_enqueue_scripts', 'menuu_load_scripts' );

function menuu_load_scripts() {
	wp_enqueue_script( 'isdfsdf_scriptss', plugins_url('/scripts.js', __FILE__), array( 'jquery' ), '1.0.0' );
	wp_enqueue_style('isdfsdfsdf_styles', plugins_url('/style.css', __FILE__),false,'1.1','all');
}


//add_filter( 'wp_nav_menu_items', 'add_has_children_to_nav_items', 10, 2 );

function add_has_children_to_nav_items($menu, $args){
	
	
	//$ost = str_replace('<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-76 current_page_item menu-item-has-children menu-item-83">', '<li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-76 current_page_item menu-item-has-children menu-item-83"><img src="'. plugins_url() .'/menuuuu/images/nav-bg.png"/>', $menu);
	
	//$ost = preg_replace('class=.*(menu-item-has-children).*>', 'fest', $menu);
	//echo $ost;
	
}





?>