<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta name="description" content="<?php bloginfo('description'); ?>" />

<!-- Basic Page Needs 
========================================================= -->
<?php global $options_data; global $post;
$description= '';
$keywords= '';
$author = '';
if(isset($post)){
	$terms = wp_get_post_terms( $post->ID, array('post_tag','category','portfolio_filter',"page_keywords"), array("fields" => "names"));
	$post_categories = wp_get_post_categories( $post->ID );
	$author = get_the_author_meta('display_name', $post->post_author);
	if(get_the_title($post->ID) != '') {
		$description = get_the_title($post->ID).' | '.get_bloginfo('name').' - '.get_bloginfo('description');
	}else{
		$description = bloginfo('name').' - '.bloginfo('description');
	}
}

$cats='';

if(!empty($terms)) {
	foreach($terms as $term){
		$keywords .= $term.', ';
	}
} else {
	$terms = get_terms( array('post_tag','category','portfolio_filter'), array('orderby' => 'count', 'order' => 'DESC', "fields" => "names", 'number'=> 9) );
	foreach($terms as $term){
		$keywords .= $term.', ';
	}
}
$description .= ', '.$keywords;
?>
<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
<meta charset="<?php bloginfo('charset'); ?>">
<?php if(!isset($options_data['check_seodisable']) || $options_data['check_seodisable'] != 1 ) {?>
<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="author" content="<?php echo $author; ?>">
<?php } ?>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Mobile Specific Metas & Favicons
========================================================= -->
<?php if($options_data['check_mobilezoom'] == 1) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"><?php } ?>

<link rel="shortcut icon" href="<?php if($options_data['media_favicon'] != "") { echo $options_data['media_favicon']; } else {echo get_template_directory_uri().'/favicon.ico';} ?>">

<!-- WordPress Stuff
========================================================= -->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<?php
$sidenav_position = (isset($options_data['sidenav_position']) && $options_data['sidenav_position'] == 'right') ? 'sidenav-right' : 'sidenav-left';  
$extra_sidenav_class = '';
if(isset($options_data['select_sidenav'])) {
	switch ($options_data['select_sidenav']) {
		case 'static':
			$extra_sidenav_class = 'side-navigation-enabled sidenav-static';
			break;
		case 'toggle':
			$extra_sidenav_class = 'side-navigation-enabled sidenav-toggle';
			break;
		case 'hover':
			$extra_sidenav_class = 'side-navigation-enabled sidenav-hover';
			break;
		default:
			$extra_sidenav_class = '';
			break;
	}
}
$extra_sidenav_class .= ' '.$sidenav_position;
?>
<body <?php body_class($extra_sidenav_class); ?>>
<?php if(isset($options_data['select_sidenav']) && $options_data['select_sidenav'] != 'hide') get_template_part('framework/headers/sidebar-navigation'); ?>	
<?php if ( $options_data['check_styleswitcher'] == 1 ) {get_template_part('framework/inc/switcher/switcher');} ?>		
<div id="main" class="<?php echo $options_data['select_layoutstyle'];?>">
<?php 
if(isset($options_data['disable_header']) && $options_data['disable_header'] != 1 || (isset($options_data['select_sidenav']) && $options_data['select_sidenav'] == 'hide' )){
	if($options_data['check_toparea'] != 0 ):?>
		<div class="toparea-sliding-area">
			<div class="toparea-content container">
				<div class="span12">
				<div class="row-fluid">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Topbar Widgets')); ?>
				</div>
				</div>
			</div>
			<a href="javascript:void(0);" class="toparea-sb"><i class="fa fa-plus"></i></a>
		</div>
	<?php endif; ?>
	<?php 
	if(isset($options_data['header_layout'])){
		$header_version = $options_data['header_layout'];
	} else {
		$header_version = 'version1';
	}
	if($options_data['check_topbar'] == 1 ) {
		get_template_part('framework/headers/topbar');
	}
	if($options_data['check_fixed_header'] == 1 ) {
		get_template_part('framework/headers/header-fixed');
	}
	get_template_part('framework/headers/header-'.$header_version.'');
}	 
?>
			