<?php 

class Footer_nav_walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // Don't output <ul> at all
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // Don't output </ul> at all
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        // Output the menu item
        $output .= '<li><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // Don't output </li> at all
    }
}
