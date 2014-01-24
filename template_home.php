<?php 
/* 
Template Name: Home
*/ 
?>

<?php 
// On sort si on accède directement au fichier

if ( ! defined( 'ABSPATH' ) ) exit;
	
?>
<?php get_header(); ?>

<?php
$display_blocks = of_get_option('etendard_blocks_presence');
//$ordre_blocks = array('titre'=>of_get_option('etendard_blocks_ordre_titre'), 
//					  'slider'=>of_get_option('etendard_blocks_ordre_slider'),
//					  'cta'=>of_get_option('etendard_blocks_ordre_cta'),
//					  'portfolio'=>of_get_option('etendard_blocks_ordre_portfolio'),
//					  'articles'=>of_get_option('etendard_blocks_ordre_articles'));
$ordre_blocks = array('titre'=>0, 
					  'slider'=>1,
					  'cta'=>2,
					  'services'=>3,
					  'portfolio'=>4,
					  'articles'=>5);
asort($ordre_blocks);
?>

<?php 
foreach ($ordre_blocks as $block=>$ordre){
	if (!$display_blocks || !array_key_exists($block, $display_blocks) || !$display_blocks[$block]) continue;
	
	switch ($block){
		case 'titre':
			get_template_part('home_elements/titre');
			break;
		case 'slider':
			get_template_part('home_elements/slider');
			break;
		case 'services':
			get_template_part('home_elements/services');
			break;
		case 'portfolio':
			get_template_part('home_elements/portfolio');
			break;
		case 'articles':
			get_template_part('home_elements/articles');
			break;
		case 'cta':
			get_template_part('call_to_action');
			break;
	}
}
?>

<?php get_footer(); ?>