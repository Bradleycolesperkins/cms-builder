<?php
//TYPOGRAPHY

//$options = apply_filters( 'cs_get_option', get_option( CS_OPTION ) );

//function get_str_by_number($str) {
//    $number = preg_replace("/[0-9|\.]/", '', $str);
//    return $number;
//}

//foreach ($options as $key => $item) {
//    if (is_array($item)) {
//        if (!empty($item['variant']) && $item['variant'] == 'regular') {
//            $item['variant'] = 'normal';
//        }
//    }
//    $options[$key] = $item;
//}

function calculateFontWeight( $fontWeight ) {
    $fontWeightValue = '';
    $fontStyleValue = '';

    switch( $fontWeight ) {
        case '100':
            $fontWeightValue = '100';
            break;
        case '100italic':
            $fontWeightValue = '100';
            $fontStyleValue = 'italic';
            break;
        case '300':
            $fontWeightValue = '300';
            break;
        case '300italic':
            $fontWeightValue = '300';
            $fontStyleValue = 'italic';
            break;
        case '500':
            $fontWeightValue = '500';
            break;
        case '500italic':
            $fontWeightValue = '500';
            $fontStyleValue = 'italic';
            break;
        case '700':
            $fontWeightValue = '700';
            break;
        case '700italic':
            $fontWeightValue = '700';
            $fontStyleValue = 'italic';
            break;
        case '900':
            $fontWeightValue = '900';
            break;
        case '900italic':
            $fontWeightValue = '900';
            $fontStyleValue = 'italic';
            break;
        case 'italic':
            $fontStyleValue = 'italic';
            break;
        case 'regular' :
            $fontWeightValue = '400';
            break;
    }
    return array('weight' => $fontWeightValue, 'style' => $fontStyleValue);
}

//function get_number_str($str){
//    $number = preg_replace("/[^0-9|\.]/", '', $str);
//    return $number;
//}

function coca_custom_styles() {

    $custom_css_styles = '';

    if ( cs_get_option('site_logo') == 'imglogo' ) {
        //Header logo image
        if ( cs_get_option('img_logo_style') == 'custom' ) {
            $custom_css_styles .= '.cs-logo__link {';
            if ( cs_get_option('img_logo_width') ) {
                 $logo_width = is_integer(cs_get_option('img_logo_width')) ? cs_get_option('img_logo_width') . 'px' : cs_get_option('img_logo_width');
                 $custom_css_styles .=  cs_get_option('img_logo_width') ? 'max-width:' . esc_attr($logo_width) . ' !important;' : '';
            }
            if ( cs_get_option('img_logo_height') ) {
                 $logo_height = is_integer(cs_get_option('img_logo_height')) ? cs_get_option('img_logo_height') . 'px' : cs_get_option('img_logo_height');
                 $custom_css_styles .=  cs_get_option('img_logo_height') ? 'max-height:' . esc_attr( $logo_height ) . ' !important;' : '';
            }
            $custom_css_styles .= '}';
        }
    }

    if ( cs_get_option('heading') ) {
        foreach (cs_get_option('heading') as $title) {
            $tag_element = $title['heading_tag'];
            $font_family = $title['heading_family'];
            $font_size = $title['heading_size'];
            $font_line_height = $title['heading_line_height'];
            $tag_color = $title['heading_color'];

            $custom_css_styles .= '' . $tag_element . '{';
            if ( ! empty( $font_family ) ) {
                $font_weight = calculateFontWeight( $font_family['variant'] );
                $custom_css_styles .= 'font-family: ' . $font_family['family'] . '!important;';
            }
            if ( ! empty( $font_weight['weight'] ) ) {
                $custom_css_styles .= 'font-weight: ' . $font_weight['weight'] . '!important;';
            }
            if ( ! empty( $font_weight['style'] ) ) {
                $custom_css_styles .= 'font-style: ' . $font_weight['style'] . '!important;';
            }
            if ( ! empty( $font_size ) ) {
                $custom_css_styles .= 'font-size: ' . $font_size . 'px !important;';
            }
            if ( ! empty( $font_line_height ) ) {
                $custom_css_styles .= 'line-height: ' . $font_line_height . '!important;';
            }
            if ( ! empty( $tag_color ) ) {
                $custom_css_styles .= 'color: ' . $tag_color . '!important;';
            }
            $custom_css_styles .= '}';
        }
    }

    /**
    * Menu typography.
    */
    $custom_menu_font_family = cs_get_option('custom_menu_font_family');
    if ( isset( $custom_menu_font_family ) && $custom_menu_font_family ) {
        $menu_item_family = cs_get_option('menu_item_family');
        $menu_item_size = cs_get_option('menu_item_size');
        $menu_line_height = cs_get_option('menu_line_height');
        $menu_item_color = cs_get_option('menu_item_color');

        if ( ! empty( $menu_item_family ) ) {
            $font_weight = calculateFontWeight( $menu_item_family['variant'] );
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {font-family: ' . $menu_item_family['family'] . ' !important;}';
            if ( ! empty( $font_weight['weight'] ) ) {
                $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {font-weight: ' . $font_weight['weight'] . ' !important;}';
            }
            if ( ! empty( $font_weight['style'] ) ) {
                $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {font-style: ' . $font_weight['style'] . ' !important;}';
            }
        }
        if ( ! empty( $menu_item_size ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {font-size: ' . $menu_item_size . 'px !important;}';
        }
        if ( ! empty( $menu_line_height ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {line-height: ' . $menu_line_height . ' !important;}';
        }
        if ( ! empty( $menu_item_color ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li>a, .cs-header .main-menu>li>a {color: ' . $menu_item_color . ' !important;}';
        }
    }

    /**
    * Sub menu typography.
    */
    $custom_submenu_font_family = cs_get_option('custom_submenu_font_family');
    if ( isset( $custom_submenu_font_family ) && $custom_submenu_font_family ) {
        $submenu_item_family = cs_get_option('submenu_item_family');
        $submenu_item_size = cs_get_option('submenu_item_size');
        $submenu_line_height = cs_get_option('submenu_line_height');
        $submenu_item_color = cs_get_option('submenu_item_color');

        if ( ! empty( $submenu_item_family ) ) {
            $font_weight = calculateFontWeight( $submenu_item_family['variant'] );
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {font-family: ' . $submenu_item_family['family'] . ' !important;}';
            if ( ! empty( $font_weight['weight'] ) ) {
                $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {font-weight: ' . $font_weight['weight'] . ' !important;}';
            }
            if ( ! empty( $font_weight['style'] ) ) {
                $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {font-style: ' . $font_weight['style'] . ' !important;}';
            }
        }
        if ( ! empty( $submenu_item_size ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {font-size: ' . $submenu_item_size . 'px !important;}';
        }
        if ( ! empty( $submenu_line_height ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {line-height: ' . $submenu_line_height . ' !important;}';
        }
        if ( ! empty( $submenu_item_color ) ) {
            $custom_css_styles .= '.cs-header--fixed:not([class$="-menu"]) .main-menu>li li a, .cs-header .main-menu>li li a {color: ' . $submenu_item_color . ' !important;}';
        }
    }

    /**
    * Link typography.
    */
    $custom_link_font_family = cs_get_option('custom_link_font_family');
    if ( isset( $custom_link_font_family ) && $custom_link_font_family ) {
        $link_heading_family = cs_get_option('link_font_family');
        $link_font_size = cs_get_option('link_font_size');
        $link_line_height = cs_get_option('link_line_height');
        $link_color = cs_get_option('link_color');

        if ( ! empty( $link_heading_family ) ) {
            $font_weight = calculateFontWeight( $link_heading_family['variant'] );
            $custom_css_styles .= '.cs-btn {font-family: ' . $link_heading_family['family'] . ' !important;}';
            if ( ! empty( $font_weight['weight'] ) ) {
                $custom_css_styles .= '.cs-btn {font-weight: ' . $font_weight['weight'] . ' !important;}';
            }
            if ( ! empty( $font_weight['style'] ) ) {
                $custom_css_styles .= '.cs-btn {font-style: ' . $font_weight['style'] . ' !important;}';
            }
        }
        if ( ! empty( $link_font_size ) ) {
            $custom_css_styles .= '.cs-btn {font-size: ' . $link_font_size . 'px !important;}';
        }
        if ( ! empty( $link_line_height ) ) {
            $custom_css_styles .= '.cs-btn {line-height: ' . $link_line_height . ' !important;}';
        }
        if ( ! empty( $link_color ) ) {
            $custom_css_styles .= '.cs-btn {color: ' . $link_color . ' !important;}';
        }
    }

    wp_add_inline_style('coca-theme', $custom_css_styles);
}

add_action( 'wp_enqueue_scripts', 'coca_custom_styles', 100 );