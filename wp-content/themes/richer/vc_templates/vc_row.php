<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';
$poster = $mp4 = $m4v = $webm = $ogv = $overlay = $extra_class = $video_open = $extra_class = $parallax = $parallax_class = $row_section_id = '';
$images = $parallax_out = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
    'css' => '',
    'use_container' => '',

    'poster'    => '',
    'mp4'     => '',
    'm4v'     => '',
    'webm'      => '',
    'ogv'     => '',
    'pad_top'     => '0',
    'pad_bottom'     => '0',
    'text_color'     => '#ffffff',
    'overlay'   => '',
    'row_section_id' => '',
    'parallax' => ''

), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
if($use_container != 'false') {
	$open_cont = '<div class="container">';
	$close_cont = '</div>';
} else {
	$open_cont = $close_cont = '';
}
$row_section_id = isset($row_section_id) ? 'id="'.$row_section_id.'"' : '';
/*video background*/

if($mp4 != '' || $m4v != '' || $webm != '' || $ogv != ''){
    $poster = wp_get_attachment_url($poster) ? wp_get_attachment_url($poster) : $poster;
    $overlay = wp_get_attachment_url($overlay) ? wp_get_attachment_url($overlay) : $overlay;
    if($poster != ''){
        $video_bg = 'background-image: url(' . $poster . ');';
    }
    if($overlay != '') {
        $overlay = 'background:url('.$overlay.') repeat;';
    }
    $extra_class = 'videosection';
    //$video_open = '[videosection poster="'.$poster.'" mp4="'.$mp4.'" m4v="'.$m4v.'" webm="'.$webm.'" ogv="'.$ogv.'" text_color="'.$font_color.'" pad_top="0" pad_bottom="0" overlay="'.$overlay.'"]';
    //$video_close = '[/videosection]';
    $video_open = '<div class="video-wrap">
          <video width="1920" height="800" preload="auto" poster="'.$poster.'" autoplay loop="loop" muted="muted">
            <source src="' . esc_url($webm) . '" type="video/webm">
            <source src="' . esc_url($mp4) . '" type="video/mp4">
            <source src="' . esc_url($m4v) . '" type="video/m4v">
            <source src="' . esc_url($ogv) . '" type="video/ogg">
          </video>
      </div>
      <div class="video-poster" style="' . $video_bg . '"></div>
      <div class="video-overlay" style="' . $overlay . '"></div>';
} 
if($parallax == 'yes') {
    $parallax_class = 'parallax-bg';
}
/* Parallax background */

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row ' . get_row_css_class() . $el_class .' '.$parallax_class.' '.$extra_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
if($margin_bottom == '') $margin_bottom = '0';
$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

$output .= '<div '.$row_section_id.' class="'.$css_class.'"'.$style.'>';
$output .= $open_cont;
$output .= wpb_js_remove_wpautop($content);
$output .= $close_cont;
$output .= $video_open;
$output .= $parallax_out;
$output .= '</div>'.$this->endBlockComment('row');
//$output .= $video_close;

echo $output;