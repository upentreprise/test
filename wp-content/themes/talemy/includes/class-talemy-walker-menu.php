<?php
/**
 * Talemy Walker Main Menu
 *
 * @since   1.0.0
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( 'Talemy_Walker_Main_Menu' ) ) {
	
	class Talemy_Walker_Main_Menu extends Walker_Nav_Menu {

		/**
		 * Mega menu variables
		 */
		private $megamenu_icon = '';
		private $megamenu_icon_image = '';
		private $megamenu_icon_only = '';
		private $megamenu_bg_color = '';
		private $megamenu_bg_image = '';
		private $megamenu_bg_position = '';
		private $megamenu_bg_repeat = '';
		private $megamenu_item_bg_color = '';
		private $megamenu_column_width = '';
		private $megamenu_hide_title = false;
		private $megamenu_new_row = false;
		private $megamenu_type = '';
		private $megamenu_width = '';
		private $megamenu_full_width = true;
		private $megamenu_width_class = '';
	
		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth. It is possible to set the
		 * max depth to include all depths, see walk() method.
		 *
		 * This method should not be called directly, use the walk() method instead.
		 *
		 * @since 2.5.0
		 *
		 * @param object $element           Data object.
		 * @param array  $children_elements List of elements to continue traversing (passed by reference).
		 * @param int    $max_depth         Max depth to traverse.
		 * @param int    $depth             Depth of current element.
		 * @param array  $args              An array of arguments.
		 * @param string $output            Used to append additional content (passed by reference).
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return;
			}
	
			if ( $element->talemy_megamenu_cat || $element->talemy_megamenu_page ) {
				$max_depth = 1;
			}
	
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
	
		// Starts the list before the elements are added.
	
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			$classes = array();
			$tag = 'ul';
			$menu_bg_style = '';
	
			if ( 'mega_menu' == $this->megamenu_type ) {
	
				if ( $depth == 0 ) {
					$classes[] = 'megamenu';
	
					if ( !$this->megamenu_full_width ) {
						$classes[] = $this->megamenu_width_class;
					}
	
					// mega menu styles
					if ( !empty( $this->megamenu_bg_color ) ) {
						$menu_bg_style .= 'background-color:'. $this->megamenu_bg_color . ';';
					}
	
					if ( !empty( $this->megamenu_bg_image ) ) {
						$menu_bg_style .= 'background-image:url('. $this->megamenu_bg_image . ');';
					}
	
					if ( !empty( $this->megamenu_bg_position ) ) {
						$menu_bg_style .= 'background-position:'. $this->megamenu_bg_position . ';';
					}
	
					if ( !empty( $this->megamenu_bg_repeat ) ) {
						$menu_bg_style .= 'background-repeat:'. $this->megamenu_bg_repeat . ';';
					}
	
					if ( !empty( $menu_bg_style ) ) {
						$menu_bg_style = ' style="'. $menu_bg_style . ';"';
					}
					
				} elseif ( $depth == 1 ) {
					$classes[] = 'megamenu-submenu';
				}
	
			} else {
				$classes[] = 'sub-menu';
			}
	
			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @since 4.8.0
			 *
			 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			$output .= "{$n}{$indent}<$tag$class_names$menu_bg_style>{$n}";
		}
	
		// Ends the list of after the elements are added.
	
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			
			if ( '' == $this->megamenu_type ) {
				$output .= "$indent</ul>{$n}";
			} else if ( $depth < 2 && 'mega_menu' == $this->megamenu_type ) {
				$output .= "$indent</ul>{$n}";
			}
		}
	
		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param object   $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
	
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
	
			// add menu options
			$menu_meta = get_post_meta( $item->ID, '_menu_item_sf_megamenu', true );
			$meta_data = isset( $menu_meta ) ? $menu_meta : array();
	
			$this->megamenu_icon = isset( $meta_data['icon'] ) ? $meta_data['icon'] : '';
			$this->megamenu_icon_image = isset( $meta_data['icon_image'] ) ? $meta_data['icon_image'] : '';
			$this->megamenu_icon_only = isset( $meta_data['icon_only'] ) ? (bool)$meta_data['icon_only'] : false;
			
			if ( apply_filters( 'sf_enable_mega_menu', true ) ) {
				$this->megamenu_column_width = isset( $meta_data['column_width'] ) ? $meta_data['column_width'] : 4;
				$this->megamenu_hide_title = isset( $meta_data['hide_title'] ) ? (bool)$meta_data['hide_title'] : false;
				$this->megamenu_new_row = isset( $meta_data['new_row'] ) ? (bool)$meta_data['new_row'] : false;
				
				if ( $depth == 0 ) {
					$this->megamenu_bg_color = isset( $meta_data['bg_color'] ) ? $meta_data['bg_color'] : '';
					$this->megamenu_bg_image = isset( $meta_data['bg_image'] ) ? $meta_data['bg_image'] : '';
					$this->megamenu_bg_position = isset( $meta_data['bg_position'] ) ? $meta_data['bg_position'] : '';
					$this->megamenu_bg_repeat = isset( $meta_data['bg_repeat'] ) ? $meta_data['bg_repeat'] : '';
					$this->megamenu_type = isset( $meta_data['type'] ) ? $meta_data['type'] : '';
					$this->megamenu_width = isset( $meta_data['width'] ) ? $meta_data['width'] : '';
				}
			}
	
			// megamenu classes
			if ( $depth == 0 ) {
	
				if ( 'mega_menu' == $this->megamenu_type ) {
	
					if ( empty( $this->megamenu_width ) || '8' == $this->megamenu_width ) {
						$classes[] = 'megamenu-full-width';
						$this->megamenu_full_width = true;
					} else {
						$classes[] = 'megamenu-custom-width';
						$this->megamenu_width_class = 'megamenu-width-'. $this->megamenu_width;
						$this->megamenu_full_width = false;
					}
				}
	
				if ( $this->megamenu_icon_only ) {
					$classes[] = 'menu-item-icon-only';
				} else {
					// if ( !empty( $meta_data['icon_item_bg_color'] ) ) {
	
					// }
				}
	
				if ( !empty( $meta_data['item_bg_color'] ) ) {
					$item_bg_color = $meta_data['item_bg_color'];
				}
			}
	
			if ( $depth == 1 && 'mega_menu' == $this->megamenu_type ) {
				
				$this->megamenu_link_class = 'megamenu-title';
				$classes[] = $this->get_megamenu_column_class( $this->megamenu_column_width );
	
				if ( $this->megamenu_new_row ) {
					$classes[] = 'megamenu-new-row';
				}
				
				if ( $this->megamenu_hide_title ) {
					$classes[] = 'megamenu-hide-title';
				}
			}
	
			else {
				$this->megamenu_link_class = '';
			}
	
			$item_icon_style = '';
	
			if ( !empty( $meta_data['icon_bg_color'] ) ) {
				$item_icon_style .= 'background-color:'. $meta_data['icon_bg_color'] .';min-width:40px!important;';
			}
	
			if ( !empty( $meta_data['icon_color'] ) ) {
				$item_icon_style .= 'color:'. $meta_data['icon_color'] .';';
			}
	
			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param WP_Post  $item  Menu item data object.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
	
			/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	
			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $item    The current menu item.
			 * @param stdClass $args    An object of wp_nav_menu() arguments.
			 * @param int      $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	
			$output .= $indent . '<li' . $id . $class_names .'>';
	
			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
	
			if ( !empty( $item_bg_color ) ) {
				$atts['style'] = 'background-color:'. $item_bg_color;
			}
	
			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
	
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
	
			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );
	
			if ( talemy_get_option( 'menu_dropdown_indicator' ) ) {
				add_filter( 'nav_menu_item_title', array( $this, 'add_dropdown_indicator_to_main_menu' ), 10, 4 );
			}
	
			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title The menu item's title.
			 * @param WP_Post  $item  The current menu item.
			 * @param stdClass $args  An object of wp_nav_menu() arguments.
			 * @param int      $depth Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
	
			remove_filter( 'nav_menu_item_title', array( $this, 'add_dropdown_indicator_to_main_menu' ) );
	
			$item_output = $args->before;
	
			// megamenu title class
			if ( !empty( $this->megamenu_link_class ) ) {
				$item_output .= '<a class="' . esc_attr( $this->megamenu_link_class ) . '" ' . $attributes . '>';
			} else {
				$item_output .= '<a' . $attributes . '>';
			}
	
			// icon & icon image
			 if ( !empty( $this->megamenu_icon_image ) ) {
				 $item_output .= '<img src="' . esc_url( $this->megamenu_icon_image ) . '" alt="' . esc_attr( $this->megamenu_link_class ) . '">';
			 } elseif ( !empty( $this->megamenu_icon ) ) {
				$icon = preg_replace( '/[^A-Za-z-\s]/', '', $this->megamenu_icon );
				$item_icon_attr_style = '';
				if ( !empty( $item_icon_style ) ) {
					$item_icon_attr_style = ' style="'. esc_attr( $item_icon_style ) .'"';
				}
				$item_output .= '<i class="'. esc_attr( $icon ) .'"'. $item_icon_attr_style .'></i>';
			}
	
			// icon only
			if ( !$this->megamenu_icon_only ) {
				$item_output .= '<span class="menu-text">';
				$item_output .= $args->link_before . $title . $args->link_after;
				$item_output .= '</span></a>';
			} else {
				$item_output .= '</a>';
			}
	
			// widget area
			if ( 'mega_menu' == $this->megamenu_type && $depth > 0 && $depth < 3 ) {
	
				if ( !empty( $this->megamenu_widget_area ) ) {
	
					if ( is_active_sidebar( $this->megamenu_widget_area ) ) {
						$item_output .= '<div class="megamenu-widget-area">';
						ob_start();
						dynamic_sidebar( $this->megamenu_widget_area );
						echo '</div>';
						$item_output .= ob_get_clean();
					}
				}	
			}
			
			$item_output .= $args->after;
	
			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $item        Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	
		// Ends the element output, if needed.
		
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
	
			if ( $depth > 2 && 'mega_menu' == $this->megamenu_type ) {
				$output .= '';
			} else {
				$output .= "</li>{$n}";
			}
		}
	
		public function get_megamenu_column_class( $index = 4 ) {
			$index = $index == '' ? $index = 4 : $index;
			$columns = array( 'megamenu-column-1-1','megamenu-column-1-2','megamenu-column-1-3','megamenu-column-2-3','megamenu-column-1-4','megamenu-column-3-4','megamenu-column-1-5','megamenu-column-2-5','megamenu-column-3-5','megamenu-column-4-5','megamenu-column-1-6','megamenu-column-5-6','megamenu-column-1-7','megamenu-column-2-7','megamenu-column-3-7','megamenu-column-4-7','megamenu-column-5-7','megamenu-column-6-7','megamenu-column-1-8','megamenu-column-3-8','megamenu-column-5-8','megamenu-column-7-8' );
			return $columns[ $index ];
		}
	
		/**
		 * Add dropdown indicator if menu item has children.
		 *
		 * @param  string $title The menu item's title.
		 * @param  object $item  The current menu item.
		 * @param  array  $args  An array of wp_nav_menu() arguments.
		 * @param  int    $depth Depth of menu item. Used for padding.
		 * @return string $title The menu item's title with dropdown icon.
		 */
		public function add_dropdown_indicator_to_main_menu( $title, $item, $args, $depth ) {
			foreach ( $item->classes as $value ) {
				if ( 0 === $depth && 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
					$title .= '<span class="menu-caret"><i class="ticon-angle-down"></i></span>';
				}
			}
			return $title;
		}
	}
}

if ( !class_exists( 'Talemy_Walker_Offcanvas_Menu' ) ) {
	
	class Talemy_Walker_Offcanvas_Menu extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			$output .= "{$n}$indent<ul>{$n}";
		}
	
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$n}<span class=\"menu-expand\"></span>";
		}
	}
}


