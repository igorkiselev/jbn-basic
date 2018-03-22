<?php 
/**
 * Plugin Name: Libraries
 * Plugin URI: http://www.igorkiselev.com/wp-plugins/jslibraries/
 * Description: Плагин отображаети встроенные JS библиотеки Wordpress и позволяет их выборочно подключать через систему администрирования.
 * Version: 0.0.1
 * Author: Igor Kiselev
 * Author URI: http://www.igorkiselev.com/
 * Copyright: Igor Kiselev
 * License: A "JustBeNice" license name e.g. GPL2.
 */

/* Библиотеки */

/* В будущем перепишу чтобы список библиотек был не руками прописан, а строился относительно наличия или отсутствия их в системе */

if( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_enqueue_scripts', function () {
	if (!wp_script_is('jquery')) {
		wp_enqueue_script('jquery');
	}
});

$ui_core_interactions = array(
	array('name' => "Draggable",	'slug' => "jquery-ui-draggable",	'info' => "Allow elements to be moved using the mouse.",	'link' => "http://jqueryui.com/demos/draggable/"),
	array('name' => "Droppable",	'slug' => "jquery-ui-droppable",	'info' => "Create targets for draggable elements",	'link' => "http://jqueryui.com/demos/droppable/"),
	array('name' => "Resizable",	'slug' => "jquery-ui-resizable",	'info' => "Change the size of an element using the mouse.",	'link' => "http://jqueryui.com/demos/resizable/"),
	array('name' => "Selectable",	'slug' => "jquery-ui-selectable",	'info' => "Use the mouse to select elements, individually or in a group.",	'link' => "http://jqueryui.com/demos/selectable/"),
	array('name' => "Sortable",	'slug' => "jquery-ui-sortable",	'info' => "Reorder elements in a list or grid using the mouse.",	'link' => "http://jqueryui.com/demos/sortable/")
);
$ui_core_widgets = array(
	array('name' =>"Accordion",		'slug' =>"jquery-ui-accordion",		'info' => "Displays collapsible content panels for presenting information in a limited amount of space.", 'link' => "http://jqueryui.com/demos/accordion/"),
	array('name' =>"Autocomplete",	'slug' =>"jquery-ui-autocomplete",	'info' => "Enables users to quickly find and select from a pre-populated list of values as they type, leveraging searching and filtering.", 'link' => "http://jqueryui.com/demos/autocomplete/"),
	array('name' =>"Button",			'slug' =>"jquery-ui-button",			'info' => "Enhances standard form elements like buttons, inputs and anchors to themeable buttons with appropriate hover and active styles.", 'link' => "http://jqueryui.com/demos/button/"),
	array('name' =>"Datepicker",		'slug' =>"jquery-ui-datepicker",		'info' => "Select a date from a popup or inline calendar", 'link' => "http://jqueryui.com/demos/datepicker/"),
	array('name' =>"Dialog",			'slug' =>"jquery-ui-dialog",			'info' => "Open content in an interactive overlay.", 'link' => "http://jqueryui.com/demos/dialog/"),
	array('name' =>"Menu",			'slug' =>"jquery-ui-menu",			'info' => "Themeable menu with mouse and keyboard interactions for navigation.", 'link' => "http://jqueryui.com/menu/"),
	array('name' =>"Progressbar",		'slug' =>"jquery-ui-progressbar",		'info' => "Display status of a determinate or indeterminate process.", 'link' => "http://jqueryui.com/demos/progressbar/"),
	array('name' =>"Selectmenu",		'slug' =>"jquery-ui-selectmenu",		'info' => "Duplicates and extends the functionality of a native HTML select element to overcome the limitations of the native control.", 'link' => "http://jqueryui.com/selectmenu/"),
	array('name' =>"Slider",			'slug' =>"jquery-ui-slider",			'info' => "Drag a handle to select a numeric value.", 'link' => "http://jqueryui.com/demos/slider/"),
	array('name' =>"Spinner",			'slug' =>"jquery-ui-spinner",			'info' => "Enhance a text input for entering numeric values, with up/down buttons and arrow key handling.", 'link' => "http://jqueryui.com/demos/spinner/"),
	array('name' =>"Tabs",			'slug' =>"jquery-ui-tabs",			'info' => "A single content area with multiple panels, each associated with a header in a list.", 'link' => "http://jqueryui.com/demos/tabs/"),
	array('name' =>"Tooltips",		'slug' =>"jquery-ui-tooltip",			'info' => "Customizable, themeable tooltips, replacing native tooltips.", 'link' => "http://jqueryui.com/demos/tooltip/")
);
$ui_core_utilities = array(
	array('name' =>"Widget",		'slug' =>"jquery-ui-widget",		'info' => "Create stateful jQuery plugins using the same abstraction as all jQuery UI widgets.",	'link' => "http://jqueryui.com/widget/"),
	array('name' =>"Position",	'slug' =>"jquery-ui-position",	'info' => "Position an element relative to the window, document, another element, or the cursor/mouse.",	'link' => "http://jqueryui.com/demos/position/"),
	array('name' =>"Mouse",		'slug' =>"jquery-ui-mouse",		'info' => "Mouse Interaction")
);
$ui_core_effects = array(
		array('name' => 'Blind', 'slug' => 'jquery-effects-blind'),
		array('name' => 'Bounce', 'slug' => 'jquery-effects-bounce'),
		array('name' => 'Clip', 'slug' => 'jquery-effects-clip'),
		array('name' => 'Drop', 'slug' => 'jquery-effects-drop'),
		array('name' => 'Explode', 'slug' => 'jquery-effects-explode'),
		array('name' => 'Fade', 'slug' => 'jquery-effects-fade'),
		array('name' => 'Fold', 'slug' => 'jquery-effects-fold'),
		array('name' => 'Highlight', 'slug' => 'jquery-effects-highlight'),
		array('name' => 'Pulsate', 'slug' => 'jquery-effects-pulsate'),
		array('name' => 'Scale', 'slug' => 'jquery-effects-scale'),
		array('name' => 'Shake', 'slug' => 'jquery-effects-shake'),
		array('name' => 'Slide', 'slug' => 'jquery-effects-slide'),
		array('name' => 'Transfer', 'slug' => 'jquery-effects-transfer')
);

add_action('admin_init', function () {
	global $ui_core_utilities, $ui_core_widgets, $ui_core_interactions, $ui_core_effects;
	
	register_setting( 'justbenice-basic', 'jbn-jquery-ui-core' );
	register_setting( 'justbenice-basic', 'jbn-jquery-effects-core' );
	
	foreach($ui_core_utilities as $key => $value){
		register_setting( 'justbenice-basic', 'jbn-'.$value['slug'] );
	}
	foreach($ui_core_widgets as $key => $value){
		register_setting( 'justbenice-basic', 'jbn-'.$value['slug'] );
	}
	foreach($ui_core_interactions as $key => $value){
		register_setting( 'justbenice-basic', 'jbn-'.$value['slug'] );
	}
	foreach($ui_core_effects as $key => $value){
		register_setting( 'justbenice-basic', 'jbn-'.$value['slug'] );
	}
		
});
add_action('wp_enqueue_scripts', function () {
	global $ui_core_utilities, $ui_core_widgets, $ui_core_interactions, $ui_core_effects;
	
	if(get_option( 'jbn-jquery-ui-core' )){
		wp_enqueue_script('jquery-ui-core');
	}
	if(get_option( 'jbn-jquery-effects-core' )){
		wp_enqueue_script('jquery-effects-core');
	}
	
	
	foreach($ui_core_utilities as $key => $value){
		if(get_option( 'jbn-'.$value['slug'])){
			wp_enqueue_script($value['slug']);
		}
	}
	foreach($ui_core_widgets as $key => $value){
		if(get_option( 'jbn-'.$value['slug'])){
			wp_enqueue_script($value['slug']);
		}
	}
	foreach($ui_core_interactions as $key => $value){
		if(get_option( 'jbn-'.$value['slug'])){
			wp_enqueue_script($value['slug']);
		}
	}
	foreach($ui_core_effects as $key => $value){
		if(get_option( 'jbn-'.$value['slug'])){
			wp_enqueue_script($value['slug']);
		}
	}
		
});


add_action('admin_menu', function () {
	add_options_page( 'Библиотеки', 'Библиотеки', 'manage_options', 'justbenice-basic', function(){
		global $ui_core_utilities, $ui_core_widgets, $ui_core_interactions, $ui_core_effects;
		if (!current_user_can('manage_options')) {wp_die( __('You do not have sufficient permissions to access this page.') );} ?>
		<?php function size_of_script($slug){
			$wp_scripts = wp_scripts();
	//		$array_jquery = [];
	//		foreach($wp_scripts->registered as $key => $value){
	// 			if (strstr($value->handle, "jquery")) {
	// 				if($value->handle != "jquery"){
	// 					$group = "other";
	// 					if (strstr($value->handle, "ui")) {$group = "ui";}
	// 					if (strstr($value->handle, "effects")) {$group = "effects";}
	// 					$array_jquery[] = (object) array('name' => $value->handle, 'size' => round(filesize('../'.$value->src) / 1024, 2).'KB', 'group' => $group);
	// 				}
	// 			}
	// 		}
			foreach($wp_scripts->registered as $key => $value){
				if (strstr($value->handle, $slug)) {
					if($value->handle != "jquery"){
						return round(filesize('../'.$value->src) / 1024, 2).' KB';
					}
				}
			}
			
		} ?>
		<div class="wrap">
			<h2>Настройка базовых библиотек</h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'justbenice-basic' ); ?>
				<style>
					.form-table table{margin-bottom: 3em;}
					.form-table table tr td{padding: 0em 3em 2em 0em; vertical-align: top; width:20%;}
					.form-table small{opacity:.2;}
					.form-table tr th h2{margin-top:-.25em}
					.form-table a.dashicons{color:#000; opacity:.2;}
					.form-table a.dashicons:hover{opacity:.5;}
					@media (max-width: 543px) { 
						.form-table table tr td{ width:100%;}
					}
				</style>
				<table class="form-table">
					<tr><th scope="row"><h2>jQuery UI</h2></th><td><label for="jbn-jquery-ui-core"><input id="jbn-jquery-ui-core" name="jbn-jquery-ui-core" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-jquery-ui-core' ) ); ?> /> UI core</label> <small>(<?php echo size_of_script('jquery-ui-core')?>)</small><p class="description"><a href="http://jqueryui.com">jQuery UI</a> is a curated set of user interface interactions, effects, widgets, and themes built on top of the jQuery JavaScript Library. </p></td></tr>
					<?php $col = 5; ?>
					<tr>
						<th scope="row">Interactions</th>
						<td>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
								<?php foreach($ui_core_interactions as $key => $value){ ?>
									<td>
										<label for="jbn-<?php echo $value['slug'];?>">
											<input id="jbn-<?php echo $value['slug']; ?>" <?php if(!get_option( 'jbn-jquery-ui-core' ) ) { ?>disabled<?php }?> name="jbn-<?php echo $value['slug']; ?>" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-'.$value['slug'] ) ); ?> />
											 <?php echo $value['name']; ?>
										</label> <small>(<?php echo size_of_script($value['slug'])?>)</small>
										<p class="description"><?php echo $value['info']; ?> <?php if ($value['link']){?><a href="<?php echo $value['link']; ?>" class="dashicons dashicons-editor-help" target="_blank"></a><?php }?></p>
									</td>
									<?php if(( $key + 1) % $col == 0) {?></tr><tr><?php } ?>
								<?php } ?>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th scope="row">Widget</th>
						<td>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
								<?php foreach($ui_core_widgets as $key => $value){ ?>
									<td>
										<label for="jbn-<?php echo $value['slug'];?>">
											<input id="jbn-<?php echo $value['slug']; ?>" <?php if(!get_option( 'jbn-jquery-ui-core' ) ) { ?>disabled<?php }?> name="jbn-<?php echo $value['slug']; ?>" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-'.$value['slug'] ) ); ?> />
											 <?php echo $value['name']; ?>
										</label> <small>(<?php echo size_of_script($value['slug'])?>)</small>
										<p class="description"><?php echo $value['info']; ?> <?php if ($value['link']){?><a href="<?php echo $value['link']; ?>" class="dashicons dashicons-editor-help" target="_blank"></a><?php }?></p>
									</td>
									<?php if(( $key + 1) % $col == 0) {?></tr><tr><?php } ?>
								<?php } ?>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<th scope="row">Utilities</th>
						<td>
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
								<?php foreach($ui_core_utilities as $key => $value){ ?>
									
									<td>
										<label for="jbn-<?php echo $value['slug'];?>">
											<input id="jbn-<?php echo $value['slug']; ?>" <?php if(!get_option( 'jbn-jquery-ui-core' ) ) { ?>disabled<?php }?> name="jbn-<?php echo $value['slug']; ?>" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-'.$value['slug'] ) ); ?> />
											 <?php echo $value['name']; ?>
										</label> <small>(<?php echo size_of_script($value['slug'])?>)</small>
										<p class="description"><?php echo $value['info']; ?> <?php if (isset($value['link'])){?><a href="<?php echo $value['link']; ?>" class="dashicons dashicons-editor-help" target="_blank"></a><?php } ?></p>
									</td>
									<?php if(( $key + 1) % $col == 0) {?></tr><tr><?php } ?>
								<?php } ?>
							</tr>
							</table>
						</td>
					</tr>
				</table>
				<hr>
				<table class="form-table">
					<tr>
						<th scope="row"><h2>jQuery Effects</h2></th>
						<td><label for="jbn-jquery-effects-core"><input id="jbn-jquery-effects-core" name="jbn-jquery-effects-core" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-jquery-effects-core' ) ); ?> /> Effects core</label> <small>(<?php echo size_of_script('jquery-effects-core')?>)</small><p class="description">Apply an <a href="http://jqueryui.com/effect/">animation effect</a> to an element.</p></td>
					</tr>
					<tr>
						<th scope="row">Effects</th>
						<td>
							<table width="100%">
								<tr>
								<?php foreach($ui_core_effects as $key => $value){ ?>
									<td>
										<label for="jbn-<?php echo $value['slug'];?>">
											<input id="jbn-<?php echo $value['slug']; ?>" <?php if(!get_option( 'jbn-jquery-effects-core' ) ) { ?>disabled<?php }?> name="jbn-<?php echo $value['slug']; ?>" type="checkbox" value="1" <?php checked( '1', get_option( 'jbn-'.$value['slug'] ) ); ?> />
											 <?php echo $value['name']; ?>
										</label> <small>(<?php echo size_of_script($value['slug'])?>)</small>
									</td>
									<?php if(( $key + 1) % $col == 0) {?></tr><tr><?php } ?>
								<?php } ?>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<?php do_settings_sections("theme-options"); ?>
				<?php submit_button(); ?>
			</form>
			<p>Плагин для упрощения работы от <a href="http://www.justbenice.ru/">Just Be Nice</a></p>
		</div>
		<?php 
	});
});

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), function($links){
	return array_merge( $links, array('<a href="' . admin_url( 'options-general.php?page=justbenice-basic' ) . '">Настройки</a>',) );
});

?>