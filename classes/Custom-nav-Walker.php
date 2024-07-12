<?php 

class Custom_Nav_Walker extends Walker_Nav_Menu {
    // Start Level
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
    }

    // Start Element
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';

        // Check if the current item has children
        $has_children = !empty( $item->has_children );

        // Add 'dropdown' class to the list item if item has children
        if ( $has_children ) {
            $classes[] = 'dropdown';
        }

        $output .= $indent . '<li class="' . esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) ) ) . '">';

        $atts = array();
        $atts['class'] = 'nav-link';

        // Add 'dropdown-toggle' class and other attributes to the anchor tag if item has children
        if ( $depth === 0 && $has_children ) {
            $atts['class'] .= ' dropdown-toggle';
            $atts['role'] = 'button';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        }

        $atts['href'] = ( ! empty( $item->url ) ) ? esc_url( $item->url ) : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    // End Level
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }

    // Display Element
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output ) {
        if ( ! empty( $children_elements[ $element->ID ] ) ) {
            $element->has_children = true;
        }

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
