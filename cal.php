<?php

/*
Plugin Name: Health-calculator
Description: A health Calculator for adult,can be used for self check,and get feedback
Version: 0.1
Author: Simmi
*/

include 'structure.php';


class cc_bmi_calculator extends WP_Widget {

	// constructor
	function __construct() {
		$options = array(		
			'name' => __('CC BMI Calculator','cctextdomain'), 
			'description' => __('BMI (Body Mass Index) Calculator','cctextdomain')
		);

		parent::__construct('cc_bmi_calculator', '', $options);
	}

	// widget form creation
	function form($instance) {	

        // Merge the user-selected arguments with the defaults
        $instance = wp_parse_args( (array) $instance, self::get_defaults() ); 

        extract($instance);

		?>
        
		<div>
        <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
        <input id="<?php echo $this->get_field_id('dev_credit'); ?>" name="<?php echo $this->get_field_name('dev_credit'); ?>" type='checkbox' <?php echo (( $dev_credit == 1) ? "checked" : ""); ?> onclick='advancedOptionsClick(this, "<?php echo $this->id."-advanced-options"; ?>");' />
        <label for="<?php echo $this->get_field_id( 'dev_credit' ); ?>"><?php _e( "customize colors and allow links to developer's website" ); ?></label> 
        </p>
        <div id='<?php echo $this->id."-advanced-options"; ?>' <?php echo (( $dev_credit == 0) ? "style='display:none;'" : ""); ?> >

            
			<div id='<?php echo $this->id."-default-units"; ?>' <?php echo (($onlyunits != 'all') ? "style='display:none;'" : ""); ?>>
            <p>
                <label for="<?php echo $this->get_field_id( 'units' ); ?>"><?php _e( 'Default units: ' ); ?></label>
                <label for="<?php echo $this->get_field_id('imperial'); ?>"><?php _e( 'imperial' ); ?> </label>
				<input class="" id="<?php echo $this->get_field_id('imperial'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="imperial" <?php if($units === 'imperial'){ echo 'checked="checked"'; } ?> />
				<label for="<?php echo $this->get_field_id('metric'); ?>"><?php _e('metric'); ?></label>
				<input class="" id="<?php echo $this->get_field_id('metric'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="metric" <?php if($units === 'metric'){ echo 'checked="checked"'; } ?> />
                </p>
			</div>
            <label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _e( 'Text color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('text_color'); ?>" name="<?php echo $this->get_field_name('text_color'); ?>" value="<?php echo esc_attr( $text_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php _e( 'Background color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('bg_color'); ?>" name="<?php echo $this->get_field_name('bg_color'); ?>" value="<?php echo esc_attr( $bg_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'border_color' ); ?>"><?php _e( 'Border color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('border_color'); ?>" name="<?php echo $this->get_field_name('border_color'); ?>" value="<?php echo esc_attr( $border_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'header_footer_text_color' ); ?>"><?php _e( 'Header/footer text color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('header_footer_text_color'); ?>" name="<?php echo $this->get_field_name('header_footer_text_color'); ?>" value="<?php echo esc_attr( $header_footer_text_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'header_footer_bg_color' ); ?>"><?php _e( 'Header/footer background color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('header_footer_bg_color'); ?>" name="<?php echo $this->get_field_name('header_footer_bg_color'); ?>" value="<?php echo esc_attr( $header_footer_bg_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'button_text_color' ); ?>"><?php _e( 'Button text color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('button_text_color'); ?>" name="<?php echo $this->get_field_name('button_text_color'); ?>" value="<?php echo esc_attr( $button_text_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'button_bg_color' ); ?>"><?php _e( 'Button background color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('button_bg_color'); ?>" name="<?php echo $this->get_field_name('button_bg_color'); ?>" value="<?php echo esc_attr( $button_bg_color ); ?>" class='cc-color-field' />
            </br>
            <label for="<?php echo $this->get_field_id( 'button_border_color' ); ?>"><?php _e( 'Button border color:' ); ?></label> 
            </br>
            <input type="text" id="<?php echo $this->get_field_id('button_border_color'); ?>" name="<?php echo $this->get_field_name('button_border_color'); ?>" value="<?php echo esc_attr( $button_border_color ); ?>" class='cc-color-field' />
        </div>
		</div>

        <script>
         
        </script>
		<?php 	
	}

	// widget update
	function update($new_instance, $old_instance) {
        // Hex color code regular expression
        $hex_color_pattern = "/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"; 

        $instance = $old_instance;
        
        $defaultValues = self::get_defaults();

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : $instance['title'];

        $instance['text_color'] = ( preg_match($hex_color_pattern, $new_instance['text_color']) ) ? $new_instance['text_color'] : $defaultValues['text_color'];
        $instance['bg_color'] = ( preg_match($hex_color_pattern, $new_instance['bg_color']) ) ? $new_instance['bg_color'] : $defaultValues['bg_color'];
        $instance['border_color'] = ( preg_match($hex_color_pattern, $new_instance['border_color']) ) ? $new_instance['border_color'] : $defaultValues['border_color'];
        $instance['header_footer_text_color'] = ( preg_match($hex_color_pattern, $new_instance['header_footer_text_color']) ) ? $new_instance['header_footer_text_color'] : $defaultValues['header_footer_text_color'];
        $instance['header_footer_bg_color'] = ( preg_match($hex_color_pattern, $new_instance['header_footer_bg_color']) ) ? $new_instance['header_footer_bg_color'] : $defaultValues['header_footer_bg_color'];
        $instance['button_text_color'] = ( preg_match($hex_color_pattern, $new_instance['button_text_color']) ) ? $new_instance['button_text_color'] : $defaultValues['button_text_color'];
        $instance['button_bg_color'] = ( preg_match($hex_color_pattern, $new_instance['button_bg_color']) ) ? $new_instance['button_bg_color'] : $defaultValues['button_bg_color'];
        $instance['button_border_color'] = ( preg_match($hex_color_pattern, $new_instance['button_border_color']) ) ? $new_instance['button_border_color'] : $defaultValues['button_border_color'];
        $instance['dev_credit'] = isset($new_instance['dev_credit']) ? 1 : 0;
        $instance['units'] = $new_instance['units'];
        $instance['onlyunits'] = ($instance['dev_credit'] == 1) ? $new_instance['onlyunits'] : $defaultValues['onlyunits']; 

        write_log('$instance');
        write_log($instance);


		return $instance;
	}

	// widget display
	function widget($args, $instance) {
		echo $args['before_widget'];
        load_cc_bmi_calc($this->id, $instance);
		echo $args['after_widget'];
    }
    
    public static function get_defaults() {
        $defaults = array(
            'title'=>'BMI calculator',
            'dev_credit'=>'0',
            'units' => 'imperial',
            'onlyunits' => 'all',                
            'bg_color'=>'#f8f8f8',
            'border_color'=>'#ddd',
            'text_color'=>'#666666',
            'header_footer_bg_color'=>'#ddd',
            'header_footer_text_color'=>'#666666',
            'button_bg_color'=> '#a0a0a0', 
            'button_text_color'=> '#ffffff',
            'button_border_color'=> '#a0a0a0'
        );
        return $defaults;
    }

}

// register widget

function cc_bmi_calculator_init ()
{
    return register_widget('cc_bmi_calculator');
}
add_action ('widgets_init', 'cc_bmi_calculator_init');


// load widget style and javascript files
function cc_bmi_scripts() {
	wp_register_style( 'cal', plugins_url('/cal.css',__FILE__), NULL, '2.0.1'); 
	wp_enqueue_style( 'cal' );
    wp_enqueue_script( 'cal', plugins_url('/cal.js',__FILE__), array('jquery'), '2.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'cc_bmi_scripts' );


function cc_bmi_admin( $hook_suffix ) {
    // http://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'admin', plugins_url('admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

add_action( 'admin_enqueue_scripts', 'cc_bmi_admin' );

function cc_bmi_shortcode($shortcode_atts, $content=null)
{
    $atts = shortcode_atts (cc_bmi_calculator::get_defaults(), $shortcode_atts);
    if(!isset($shortcode_atts['dev_credit'])) $atts['dev_credit'] = 1;
    
	if ( $atts['dev_credit'] && !empty($atts['title'])) {
         $atts['title'] = '<a href="https://calculatorsworld.com/health/bmi-calculator/" target="_blank">' . $atts['title'] . '</a>';		
         $atts['shortcode'] = 1;
    }

    ob_start();
    load_cc_bmi_calc('cc_bmi_shortcode', $atts);
    $widget = ob_get_contents();
    ob_end_clean();
    return trim($widget);
}

add_shortcode('cc-bmi','cc_bmi_shortcode');

// debuging
if ( ! function_exists('write_log')) {
    function write_log ( $log )  {
       if ( is_array( $log ) || is_object( $log ) ) {
          error_log( print_r( $log, true ) );
       } else {
          error_log( $log );
       }
    }
 }

?>