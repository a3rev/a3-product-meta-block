<?php
class A3ProductMetaBlock {

	public $type_support;

	public $feature_box;

	public $whats_included;

	public $meta_prefix = '_a3protemp_';

	public function __construct () {

		$this->feature_box = array(

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Requires', 'a3-product-meta-block' ),
				'value' => __( 'WordPress 4.6 or higher', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Compatible up to', 'a3-product-meta-block' ),
				'value' => __( 'WordPress 4.9.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Requires', 'a3-product-meta-block' ),
				'value' => __( 'WooCommerce 3.0.0 or higher', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Compatible up to', 'a3-product-meta-block' ),
				'value' => __( 'WooCommerce 3.2.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Requires', 'a3-product-meta-block' ),
				'value' => __( 'Responsi 6.8.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Compatible up to', 'a3-product-meta-block' ),
				'value' => __( 'Responsi 6.8.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Requires', 'a3-product-meta-block' ),
				'value' => __( 'Responsi WooCommerce Templates', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Compatible up to', 'a3-product-meta-block' ),
				'value' => __( 'Responsi WooCommerce Templates x.x.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Minimum PHP version', 'a3-product-meta-block' ),
				'value' => __( 'x.x.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Version', 'a3-product-meta-block' ),
				'value' => __( 'x.x.x', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Released', 'a3-product-meta-block' ),
				'value' => __( '2017-12-29', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( '100% WPML Compatible', 'a3-product-meta-block' ),
				'value' => __( 'yes', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Translation ready', 'a3-product-meta-block' ),
				'value' => __( 'yes', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textfield',
				'label' => __( 'Languages', 'a3-product-meta-block' ),
				'value' => __( 'English', 'a3-product-meta-block' )
			),

			array(
				'display' => true,
				'type'  => 'textarea',
				'label' => __( 'Support to', 'a3-product-meta-block' ),
				'value' => __( '
					<ul class="list-unstyled" style="padding: 0 0 0 17px;margin: 0;">
						<li style="padding: 0px;margin-bottom: 5px;">All Responsi plugins</li>
						<li style="padding: 0px;">All Responsi themes</li>
					</ul>', 'a3-product-meta-block' )
			),

		);

		$this->whats_included = array(

			array(
				'display' => false,
				'type'  => 'textfield',
				'value' => __( '1-year extension updates', 'a3-product-meta-block' )
			),

			array(
				'display' => false,
				'type'  => 'textfield',
				'value' => __( '1-year support', 'a3-product-meta-block' )
			),

			array(
				'display' => false,
				'type'  => 'textfield',
				'value' => __( '30-day money-back guarantee', 'a3-product-meta-block' )
			),

		);

		add_action( 'woocommerce_process_product_meta', array( $this, 'save' ) );
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'feature_box_data_tabs' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'feature_box_data_panels' ) );

	}

	public function save( $post_id ) {

		global $wpdb;

		if( !isset( $_POST['_a3protemp_meta'] ) ) return;

		if( isset( $_POST[$this->meta_prefix.'meta'] ) && 0 < $_POST[$this->meta_prefix.'meta'] ){

			$data = $_POST[$this->meta_prefix.'meta'];

			if( is_array( $data ) && isset($data['feature']) ){
				foreach( $data['feature'] as $key => $value ){
					if( isset( $value['display'] ) ){
						$data['feature'][$key]['display'] = true;
					}else{
						$data['feature'][$key]['display'] = false;
					}
				}
			}

			if( is_array( $data ) && isset($data['whats_included']) ){
				foreach( $data['whats_included'] as $key => $value ){
					if( isset( $value['display'] ) ){
						$data['whats_included'][$key]['display'] = true;
					}else{
						$data['whats_included'][$key]['display'] = false;
					}
				}
			}

			$data = maybe_unserialize( $data );

			update_post_meta( $post_id, $this->meta_prefix.'meta', $data );
		}else{
			delete_post_meta( $post_id, $this->meta_prefix.'meta' );
		}
	}

	public function feature_box_data_tabs( $product_data_tabs ){

		$new_product_data_tabs = array();

		foreach ($product_data_tabs as $key => $value) {
			if( 'attribute' === $key ){
				$new_product_data_tabs['a3_product_template'] =  array(
					'label'  => __( 'a3 Meta Blocks', 'a3-product-meta-block' ),
					'target' => 'a3_product_template',
					'class'  => array('advanced_options'),
				);
				$new_product_data_tabs[$key] = $value;
			}else{
				$new_product_data_tabs[$key] = $value;
			}
		}

		return $new_product_data_tabs;
	}

	public function feature_box_data_panels(){
		global $post;
		?>
		<style type="text/css">
			.form-field-custom{display:inline-block;}
			.form-field-custom .form-field-label{display:inline-block;}
			.form-field-custom .form-field-value{display:inline-block;}
			.form-field-custom .form-field-label span{display:inline-block;}
			.form-field-custom .form-field-value span{display:inline-block;}
			.form-field-custom input{display:inline-block;}
			.form-field-custom textarea{display:inline-block;}
			.form-field-table{width: 50%}
			.form-field-table th{text-align:left;}
			.form-field-table input{width:100%!important;}
			.form-field-table tr{}
			.form-field-table td{padding:4px 0;}
			.form-field-table th{}
			.form-field-table input{}
			.form-field-table textarea{width:100%!important;min-height:80px;}
			table.form-field-table tbody td.column-handle{vertical-align:inherit!important;}
			table.form-field-table tbody td.column-handle::before{margin:0!important;}
			table.form-field-table tbody td.actions{text-align:center;line-height:0.8;}
			table.form-field-table tbody td.actions a{text-decoration:none;text-decoration:none;font-size:16px;display:block;line-height: 1}
			table.form-field-table tbody td.actions a.delete-row{color: red;}
			.woocommerce_options_panel div.form-field {
    			padding: 5px 20px 5px 162px!important
			}
			#a3_product_template td.column-handle{
				display: inline !important;
			}
			#a3_product_template td.form-field-checkbox{
				width: auto !important;
			}
			#a3_product_template .form-field-table tr {
			    display: flex;
			    align-items: center;
			    justify-content: space-between;
			    gap: 10px;
			}
			#a3_product_template .form-field-table tr .column-handle{
				flex-basis: 15px;
				display: block;
			}
			#a3_product_template .form-field-table tr .form-field-checkbox{
				flex-basis: 15px;
				display: block;
			}
			#a3_product_template .form-field-table tr .form-field-label{
				flex-basis: 150px;
				display: block;
			}
			#a3_product_template .form-field-table tr .form-field-value{
				flex-basis: 350px;
				display: block;
			}
			#a3_product_template .form-field-table tr .actions{
				flex-basis: 15px;
				display: block;
			}
			@media only screen and (max-width:500px) {
			    .woocommerce_options_panel div.form-field {
			        padding: 5px 20px!important
			    }
			}
		</style>
		<script type="text/javascript">
			jQuery( function( $ ) {

				$( document.body ).on( 'form-field-table-sort', function(){

					$('.form-field-table-details-compatibility tbody tr').each( function( index ){
						$(this).find( '.form-field-label input.short' ).attr( 'name' , '_a3protemp_meta[feature]['+index+'][label]' ).attr( 'id' , '_a3protemp_meta_feature_'+index+'_label' );
						$(this).find( '.form-field-value input.short, .form-field-value textarea.short' ).attr( 'name' , '_a3protemp_meta[feature]['+index+'][value]' ).attr( 'id' , '_a3protemp_meta_feature_'+index+'_value' );
						$(this).find( '.form-field-value input[type="hidden"]' ).attr( 'name' , '_a3protemp_meta[feature]['+index+'][type]' );
					});

					$('.form-field-table-whats-included tbody tr').each( function( index ){
						$(this).find( '.form-field-label input.short' ).attr( 'name' , '_a3protemp_meta[whats_included]['+index+'][label]' ).attr( 'id' , '_a3protemp_meta_whats_included_'+index+'_label' );
						$(this).find( '.form-field-value input.short, .form-field-value textarea.short' ).attr( 'name' , '_a3protemp_meta[whats_included]['+index+'][value]' ).attr( 'id' , '_a3protemp_meta_whats_included_'+index+'_value' );
						$(this).find( '.form-field-value input[type="hidden"]' ).attr( 'name' , '_a3protemp_meta[whats_included]['+index+'][type]' );
					});


					$('table.form-field-table').each( function( index ){
						if( $(this).find('tbody >tr.tr-input').length <= 1 ){
							$(this).find('tbody >tr.tr-input .delete-row').hide();
						}else{
							$(this).find('tbody >tr.tr-input .delete-row').show();
						}

						if( $(this).find('tbody >tr.tr-textarea').length <= 1 ){
							$(this).find('tbody >tr.tr-textarea .delete-row').hide();
						}else{
							$(this).find('tbody >tr.tr-textarea .delete-row').show();
						}
					});

				});

				var fixHelper = function(e, ui) {
					ui.children().each(function() {
						$(this).width($(this).width());
					});
					return ui;
				};

				$(".form-field-table").sortable({
					items: 'tr',
					helper: fixHelper,
					placeholder: "ui-state-highlight",
					handle: '.column-handle',
					opacity: 0.8, cursor: 'move',
					update: function() {
						$( document.body ).trigger( 'form-field-table-sort' );
					}
				});

				$( window ).on( 'load', function(){
					$( document.body ).trigger( 'form-field-table-sort' );
					return false;
		        });

				$( document ).on( 'click', ".form-field-table .tr-input .add-row" , function( e ){
					e.preventDefault();
					var clone = $(this).parent("td").parent("tr.tr-input").clone();
					$(clone).find( 'input.short, textarea.short' ).val('');
					$(this).parent("td").parent("tr.tr-input").after( clone );
					$( document.body ).trigger( 'form-field-table-sort' );
					return false;
		        });

				$( document ).on( 'click', ".form-field-table .tr-input .delete-row" , function( e ){
					e.preventDefault();
					if( $(this).parent('td').parent('tr').parent('tbody').find( 'tr.tr-input' ).length > 1 ){
						$(this).parent("td").parent("tr.tr-input").remove();
					}else{
					}
					$( document.body ).trigger( 'form-field-table-sort' );
					return false;
		        });

		        $( document ).on( 'click', ".form-field-table .tr-textarea .add-row" , function( e ){
					e.preventDefault();
					var clone = $(this).parent("td").parent("tr.tr-textarea").clone();
					$(clone).find( 'input.short, textarea.short' ).val('');
					$(this).parent("td").parent("tr.tr-textarea").after( clone );
					$( document.body ).trigger( 'form-field-table-sort' );
					return false;
		        });

		        $( document ).on( 'click', ".form-field-table .tr-textarea .delete-row" , function( e ){
					e.preventDefault();
					if( $(this).parent('td').parent('tr').parent('tbody').find( 'tr.tr-textarea' ).length > 1 ){
						$(this).parent("td").parent("tr.tr-textarea").remove();
					}else{
					}
					$( document.body ).trigger( 'form-field-table-sort' );
					return false;
		        });

		});
		</script>

		<?php
		$product_metas 						= metadata_exists( 'post', $post->ID, $this->meta_prefix.'meta' ) ? get_post_meta( $post->ID, $this->meta_prefix.'meta', true ) : $this->feature_box;
		$action_box_title 					= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['title'] ) ? $product_metas['action_box']['title'] : '';
		$action_box_description 			= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['description'] ) ? $product_metas['action_box']['description'] : '';
		$action_box_add_to_cart_shortcode 	= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['add_to_cart_shortcode'] ) ? $product_metas['action_box']['add_to_cart_shortcode'] : '';
		$action_box_add_to_cart_text 		= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['add_to_cart_text'] ) ? $product_metas['action_box']['add_to_cart_text'] : __( 'Get it For Free', 'a3-product-meta-block' );
		$action_box_more_details_url 		= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['more_details_url'] ) ? $product_metas['action_box']['more_details_url'] : '';
		$action_box_pageid 					= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['pageid'] ) ? $product_metas['action_box']['pageid'] : '';
		$action_box_more_details_text 		= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['more_details_text'] ) ? $product_metas['action_box']['more_details_text'] : __( '14 day free trial & pricing', 'a3-product-meta-block' );

		$action_box_offer_text 		= is_array($product_metas) && isset( $product_metas['action_box'] ) && isset( $product_metas['action_box']['offer_text'] ) ? $product_metas['action_box']['offer_text'] : __( 'OR', 'a3-product-meta-block' );

		$feature_box_title 					= is_array($product_metas) && isset( $product_metas['feature_box'] ) && isset( $product_metas['feature_box']['title'] ) ? $product_metas['feature_box']['title'] : __( 'Details and compatibility', 'a3-product-meta-block' );
		$product_metas_feature  			= is_array($product_metas) && isset( $product_metas['feature'] ) && is_array( $product_metas['feature'] ) ? $product_metas['feature'] : $this->feature_box;
		?>

		<div id="a3_product_template" class="panel woocommerce_options_panel hidden">

			<p class="form-field" style="width: auto;font-weight: bold;font-size: 14px;white-space: nowrap;">
				<label><?php esc_attr_e( 'Call to Action', 'a3-product-meta-block' ); ?></label>
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_title');?>"><?php echo esc_attr__( 'Title', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][title]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_title');?>" placeholder="" value="<?php echo htmlspecialchars( $action_box_title ); ?>" /><?php echo wp_kses_post(wc_help_tip( __( 'Enter an title show on Call to Action box.', 'a3-product-meta-block' ) ));?>
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_description');?>"><?php echo esc_attr__( 'Description', 'a3-product-meta-block' ); ?></label>
				<textarea class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][description]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_description');?>" placeholder="" rows="5" cols="50"><?php echo htmlspecialchars( $action_box_description ); ?></textarea><?php echo wp_kses_post(wc_help_tip( __( 'Enter an description show on Call to Action box.', 'a3-product-meta-block' ) ) );?>
			</p>

			<p class="form-field">
				<!-- <label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_add_to_cart_shortcode');?>"><?php echo esc_attr__( 'Cart Button Shortcode', 'a3-product-meta-block' ); ?></label> -->
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_add_to_cart_shortcode');?>"><?php echo esc_attr__( 'Product ID', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][add_to_cart_shortcode]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_add_to_cart_shortcode');?>" placeholder="" value="<?php echo htmlspecialchars( $action_box_add_to_cart_shortcode );?>" />
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_add_to_cart_text');?>"><?php echo esc_attr__( 'Cart Button text', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][add_to_cart_text]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_add_to_cart_text');?>" placeholder="" value="<?php echo htmlspecialchars( $action_box_add_to_cart_text );?>" />
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_more_details_url');?>"><?php echo esc_attr__( 'More Details link to', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][more_details_url]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_more_details_url');?>" placeholder="" value="<?php echo htmlspecialchars( $action_box_more_details_url ); ?>" />
				<?php
				$pages_obj = get_pages('sort_column=post_parent,menu_order');
				if( $pages_obj ){
					echo '<span style="display:block">'.esc_attr__( 'Or', 'a3-product-meta-block' ).'</span>';
					?>
					<select name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][pageid]');?>" class="select short">
						<option value="0"><?php echo esc_attr__( 'Select a page...', 'a3-product-meta-block' ); ?></option>
						<?php
						foreach ($pages_obj as $page) {
							?>
							<option value="<?php echo esc_attr($page->ID) ?>" <?php selected( $page->ID, $action_box_pageid ); ?>><?php echo htmlspecialchars( $page->post_title ); ?></option>
							<?php
						}
						?>
					</select>
					<?php
				}
				?>
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_action_box_more_details_text');?>"><?php echo esc_attr__( 'More Details text', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[action_box][more_details_text]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_action_box_more_details_text');?>" placeholder="" value="<?php echo htmlspecialchars( $action_box_more_details_text );?>" />
			</p>

			<p class="form-field" style="width: auto;font-weight: bold;font-size: 14px;white-space: nowrap;">
				<label><?php esc_attr_e( 'Details and compatibility', 'a3-product-meta-block' ); ?></label>
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_feature_box_title');?>"><?php echo esc_attr__( 'Heading', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature_box][title]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_box_title');?>" placeholder="" value="<?php echo htmlspecialchars( $feature_box_title ); ?>" />
			</p>

			<div class="form-field">
				<label></label>
				<table class="form-field-table form-field-table-details-compatibility wp-list-table">
					<thead>
						<tr>
						<th class="column-handle"></th>
						<th class="form-field-checkbox"> </th>
						<th class="form-field-label"><?php echo esc_attr__( 'Label', 'a3-product-meta-block' ); ?></th>
						<th class="form-field-value"><?php echo esc_attr__( 'Value', 'a3-product-meta-block' ); ?></th>
						<th class="actions"></th>
						</tr>
					</thead>
					<tbody>
						<?php

						foreach ( $product_metas_feature as $key => $value ) {

							$display 	= is_array( $value ) && isset( $value['display'] ) ? $value['display'] : true;
							$label 		= is_array( $value ) && isset( $value['label'] ) ? $value['label'] : '';
							$type 		= is_array( $value ) && isset( $value['type'] ) ? $value['type'] : 'textfield';
							$val 		= is_array( $value ) && isset( $value['value'] ) ? $value['value'] : '';

							switch ( $type ) {
								case 'textfield':
									echo '<tr class="tr-input">';
									?>
									<td class="column-handle ui-sortable-handle" style="border-bottom-width: 1px;"></td>
									<td class="form-field-checkbox">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][display]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_display');?>" <?php if( $display === true ) echo 'checked="checked" ';?>type="checkbox" value="true" />
									</td>
									<td class="form-field-label">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][label]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_label');?>" placeholder="" value="<?php echo htmlspecialchars( $label );?>" />
									</td>
									<td class="form-field-value">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][value]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_value');?>" placeholder="" value="<?php echo htmlspecialchars( $val );?>" />
										<input name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][type]');?>" type="hidden" value="<?php echo esc_attr($type);?>" />
									</td>
									<td class="actions" style="border-bottom-width: 1px;width:17px;"><a class="add-row" href="#">+</a><a class="delete-row" href="#">-</a></td>
									<?php
									echo '</tr>';

								break;

								case 'textarea':

									echo '<tr class="tr-textarea">';
									?>
									<td class="column-handle ui-sortable-handle" style="border-bottom-width: 1px;"></td>
									<td class="form-field-checkbox">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][display]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_display');?>" <?php if( $display === true ) echo 'checked="checked" ';?>type="checkbox" value="true" />
									</td>
									<td class="form-field-label">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][value]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_value');?>" placeholder="" value="<?php echo htmlspecialchars( $label );?>" />
									</td>
									<td class="form-field-value">
										<textarea class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][value]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_feature_'.esc_attr($key).'_value');?>" placeholder="" rows="5" cols="50"><?php echo htmlspecialchars( $val );?></textarea>
										<input name="<?php echo esc_attr($this->meta_prefix.'meta[feature]['.esc_attr($key).'][type]');?>" type="hidden" value="<?php echo esc_attr($type);?>" />
									</td>
									<td class="actions" style="border-bottom-width: 1px;width:17px;"><a class="add-row" href="#">+</a><a class="delete-row" href="#">-</a></td>
									<?php
									echo '</tr>';

								break;
							}
						}

						?>

					</tbody>
				</table>
			</div>

			<?php
			$whats_included_title 				= is_array($product_metas) && isset( $product_metas['whats_included_title'] ) && isset( $product_metas['whats_included_title']['title'] ) ? $product_metas['whats_included_title']['title'] : __( 'What\'s included', 'a3-product-meta-block' );
			$product_metas_whats_included  		= is_array($product_metas) && isset( $product_metas['whats_included'] ) && is_array( $product_metas['whats_included'] ) ? $product_metas['whats_included'] : $this->whats_included;
			?>

			<p class="form-field" style="width: auto;font-weight: bold;font-size: 14px;white-space: nowrap;">
				<label><?php esc_attr_e( 'What\'s included', 'a3-product-meta-block' ); ?></label>
			</p>

			<p class="form-field">
				<label for="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_title');?>"><?php echo esc_attr__( 'Heading', 'a3-product-meta-block' ); ?></label>
				<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[meta_whats_included_title][title]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_title');?>" placeholder="" value="<?php echo htmlspecialchars( $whats_included_title ); ?>" />
			</p>

			<div class="form-field">
				<label></label>
				<table class="form-field-table form-field-table-whats-included wp-list-table">
					<thead>
						<tr>
						<th class="column-handle"></th>
						<th class="form-field-checkbox"> </th>
						<th class="form-field-value"> </th>
						<th class="actions"></th>
						</tr>
					</thead>
					<tbody>
						<?php

						foreach ( $product_metas_whats_included as $key => $value ) {

							$display 	= is_array( $value ) && isset( $value['display'] ) ? $value['display'] : false;
							$type 		= is_array( $value ) && isset( $value['type'] ) ? $value['type'] : 'textfield';
							$val 		= is_array( $value ) && isset( $value['value'] ) ? $value['value'] : '';

							switch ( $type ) {
								case 'textfield':
									echo '<tr class="tr-input">';
									?>
									<td class="column-handle ui-sortable-handle" style="border-bottom-width: 1px;"></td>
									<td class="form-field-checkbox">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][display]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_'.esc_attr($key).'_display');?>" <?php if( $display === true ) echo 'checked="checked" ';?>type="checkbox" value="true" />
									</td>
									<td class="form-field-value">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][value]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_'.esc_attr($key).'_value');?>" placeholder="" value="<?php echo htmlspecialchars( $val );?>" />
										<input name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][type]');?>" type="hidden" value="<?php echo esc_attr($type);?>" />
									</td>
									<td class="actions" style="border-bottom-width: 1px;width:17px;"><a class="add-row" href="#">+</a><a class="delete-row" href="#">-</a></td>
									<?php
									echo '</tr>';

								break;

								case 'textarea':

									echo '<tr class="tr-textarea">';
									?>
									<td class="column-handle ui-sortable-handle" style="border-bottom-width: 1px;"></td>
									<td class="form-field-checkbox">
										<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][display]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_'.esc_attr($key).'_display');?>" <?php if( $display === true ) echo 'checked="checked" ';?>type="checkbox" value="true" />
									</td>
									<td class="form-field-value">
										<textarea class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][value]');?>" id="<?php echo esc_attr($this->meta_prefix.'meta_whats_included_'.esc_attr($key).'_value');?>" placeholder="" rows="5" cols="50"><?php echo htmlspecialchars( $val );?></textarea>
										<input name="<?php echo esc_attr($this->meta_prefix.'meta[whats_included]['.esc_attr($key).'][type]');?>" type="hidden" value="<?php echo esc_attr($type);?>" />
									</td>
									<td class="actions" style="border-bottom-width: 1px;width:17px;"><a class="add-row" href="#">+</a><a class="delete-row" href="#">-</a></td>
									<?php
									echo '</tr>';

								break;
							}
						}

						?>

					</tbody>
				</table>
			</div>

			<?php

			$dynamic_actions = array(
				'support' 		=> __( 'Support', 'a3-product-meta-block' ),
				'documentation' => __( 'Documentation', 'a3-product-meta-block' ),
				'version' 		=> __( 'Version', 'a3-product-meta-block' ),
				'extension' 	=> __( 'Want to test this extension?', 'a3-product-meta-block' ),
			);

			foreach ($dynamic_actions as $key => $value) {
				$title 					= is_array($product_metas) && isset( $product_metas[$key] ) && isset( $product_metas[$key]['title'] ) ? $product_metas[$key]['title'] : '';
				$text_before 			= is_array($product_metas) && isset( $product_metas[$key] ) && isset( $product_metas[$key]['text_before'] ) ? $product_metas[$key]['text_before'] : '';
				$text_after 			= is_array($product_metas) && isset( $product_metas[$key] ) && isset( $product_metas[$key]['text_after'] ) ? $product_metas[$key]['text_after'] : '';
				$button_text 			= is_array($product_metas) && isset( $product_metas[$key] ) && isset( $product_metas[$key]['button_text'] ) ? $product_metas[$key]['button_text'] : '';
				$button_url 			= is_array($product_metas) && isset( $product_metas[$key] ) && isset( $product_metas[$key]['button_url'] ) ? $product_metas[$key]['button_url'] : '';
				?>
				<p class="form-field" style="width: auto;font-weight: bold;font-size: 14px;white-space: nowrap;">
				<label><?php echo esc_attr($value); ?></label>
				</p>

				<p class="form-field">
					<label for="<?php echo esc_attr($this->meta_prefix.$key.'_title');?>"><?php echo esc_attr__( 'Title', 'a3-product-meta-block' ); ?></label>
					<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta['.$key.'][title]');?>" id="<?php echo esc_attr($this->meta_prefix.$key.'_title');?>" placeholder="" value="<?php echo htmlspecialchars( $title ); ?>" /><?php echo wp_kses_post(wc_help_tip( __( 'Enter an title show on '.$key.' box.', 'a3-product-meta-block' ) ));?>
				</p>

				<p class="form-field">
					<label for="<?php echo esc_attr($this->meta_prefix.$key.'_text_before');?>"><?php echo esc_attr__( 'Text before', 'a3-product-meta-block' ); ?></label>
					<textarea class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta['.$key.'][text_before]');?>" id="<?php echo esc_attr($this->meta_prefix.$key.'_text_before');?>" placeholder="" rows="5" cols="50"><?php echo htmlspecialchars( $text_before ); ?></textarea><?php echo wp_kses_post(wc_help_tip( __( 'Enter an text_before show on '.$key.' box.', 'a3-product-meta-block' ) ) );?>
				</p>

				<p class="form-field">
					<label for="<?php echo esc_attr($this->meta_prefix.'support_button_text');?>"><?php echo esc_attr__( 'Button text', 'a3-product-meta-block' ); ?></label>
					<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta['.$key.'][button_text]');?>" id="<?php echo esc_attr($this->meta_prefix.$key.'_button_text');?>" placeholder="" value="<?php echo htmlspecialchars( $button_text ); ?>" /><?php echo wp_kses_post(wc_help_tip( __( 'Enter an button text show on '.$key.' box.', 'a3-product-meta-block' ) ));?>
				</p>

				<p class="form-field">
					<label for="<?php echo esc_attr($this->meta_prefix.'support_button_url');?>"><?php echo esc_attr__( 'Button URL', 'a3-product-meta-block' ); ?></label>
					<input class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta['.$key.'][button_url]');?>" id="<?php echo esc_attr($this->meta_prefix.$key.'_button_url');?>" placeholder="" value="<?php echo htmlspecialchars( $button_url ); ?>" /><?php echo wp_kses_post(wc_help_tip( __( 'Enter an button url show on '.$key.' box.', 'a3-product-meta-block' ) ));?>
				</p>

				<p class="form-field">
					<label for="<?php echo esc_attr($this->meta_prefix.'support_text_after');?>"><?php echo esc_attr__( 'Text after', 'a3-product-meta-block' ); ?></label>
					<textarea class="short" style="" name="<?php echo esc_attr($this->meta_prefix.'meta['.$key.'][text_after]');?>" id="<?php echo esc_attr($this->meta_prefix.$key.'_text_after');?>" placeholder="" rows="5" cols="50"><?php echo htmlspecialchars( $text_after ); ?></textarea><?php echo wp_kses_post(wc_help_tip( __( 'Enter an text after show on '.$key.' box.', 'a3-product-meta-block' ) ) );?>
				</p>
				<?php
			}

			?>

		</div>
		<?php

	}
}
global $a3ProductMetaBlock;
$a3ProductMetaBlock = new A3ProductMetaBlock();
?>
