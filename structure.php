<?php
function load_cc_bmi_calc($id, $parameters)
{
    extract($parameters);
    // to keep compatibility with previous versions
    if (isset($allow_cc_urls)) { $dev_credit = $allow_cc_urls;}
    // ^^^^^^^

    if ($onlyunits != 'all')
    {
        $units = $onlyunits;
    }

    if ($dev_credit == 1)
        //load_cc_bmi_custom_colors($id, $bg_color, $border_color, $text_color);
        load_cc_bmi_custom_colors($id, $parameters);
?>


        <div id="CCB-calc" class="CCB-Widget-<?php echo $id; ?>">
            <div id="calc-header" class="CCB-calc-header-<?php echo $id; ?>">
                <h3><?php echo "Health Calculator"; ?></h3>
                <h4><?php echo "Get your right feedback";?></h4>
            </div>
            <div id="calc-controls">
                
                <div id="cal-data" role="form">
                    <div id="<?php echo $id; ?>-imperial" <?php if($units != 'imperial'){ echo 'class="bmi-hidden"'; } ?>>
                        <div class="form-group">
                            <label for="<?php echo $id; ?>-height-ft" class="col-200-4 control-label">Height</label>
                            <div class="col-200-8">
                                <div class="col-200-6 ft_input">
                                    <div class="input-group">
                                        <input type="tel" class="form-control integer height-ft ccb-form-control-<?php echo $id; ?>" id="<?php echo $id; ?>-height-ft" placeholder="feet">
                                        <span class="input-group-addon ccb-addon-<?php echo $id; ?>">ft</span>
                                    </div>
                                </div>
                                <div class="col-200-6 in_input">
                                    <div class="input-group">
                                        <input type="tel" class="form-control integer height-in ccb-form-control-<?php echo $id; ?>" id="<?php echo $id; ?>-height-in" placeholder="inches">
                                        <span class="input-group-addon ccb-addon-<?php echo $id; ?>">in</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="<?php echo $id; ?>-weight-lbs" class="col-200-4 control-label">Weight</label>
                            <div class="col-200-8">
                                <div class="input-group">
                                    <input type="tel" class="form-control decimal weight-lbs ccb-form-control-<?php echo $id; ?>" id="<?php echo $id; ?>-weight-lbs" placeholder="in killograms">
                                    <span class="input-group-addon ccb-addon-<?php echo $id; ?>">Kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group BMI-Description-group">
                        <div class="col-200-12">
                            <div id="<?php echo $id; ?>-BMI-Description" class="alert alert-success BMI-Description bmi-hidden" role="alert">
                                <p class="form-control-static"><span id="<?php echo $id; ?>-Health score-value">Health score</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-200-5">
                            <button id="<?php echo $id; ?>-calculate_btn" class="btn btn-info btn-block calculate_btn center-block">Calculate</button>
                        </div>
                        <div class="col-200-5 col-200-offset-1">
                            <button id="<?php echo $id; ?>-clear_btn" class="btn btn-info btn-block clear_btn center-block">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calc-footer" class="CCB-calc-footer-<?php echo $id; ?>">
                <?php if (($dev_credit) && (!$shortcode)) { ?>
                        <p>Provided by <a href="https://calculatorsworld.com/health/" target="_blank"></a></p>
                <?php } else { ?>
                        <p></p>
                <?php }?>
            </div>

        </div>
		
		<?php 
}

//function load_cc_bmi_custom_colors($id, $bg_color, $border_color, $text_color)
function load_cc_bmi_custom_colors($id, $parameters)
{
    extract($parameters);
?>
<style type="text/css">
    #CCB-calc #calc-header.CCB-calc-header-<?php echo $id; ?> H3 a,  #CCB-calc #calc-header.CCB-calc-header-<?php echo $id; ?> H3 a:visited,
    #CCB-calc .CCB-calc-header-<?php echo $id; ?>   {
    <?php echo (isset( $header_footer_bg_color) ? "background-color:" . $header_footer_bg_color . "!important;": ""); ?>
    <?php echo (isset( $header_footer_text_color) ? "color:" . $header_footer_text_color . " !important;": ""); ?>
}


    div#CCB-calc.CCB-Widget-<?php echo $id; ?> {
        <?php echo (isset( $border_color) ? "border-color:" . $border_color . "!important;" : ""); ?>
        <?php echo (isset( $bg_color) ? "background-color:" . $bg_color . "!important;": ""); ?>
        <?php echo (isset( $text_color) ? "color:" . $text_color . " !important;": ""); ?>
    }


    .CCB-Widget-<?php echo $id; ?> input[type=text], .CCB-Widget-<?php echo $id; ?> input[type=tel] {
        <?php echo (isset( $border_color) ? "border-color:" . $border_color . ";": ""); ?>
        <?php echo (isset( $text_color) ? "color:" . $text_color . ";": ""); ?>
        <?php echo (isset( $input_bg_color) ? "background-color:" . $input_bg_color . ";": ""); ?>
    } 

    .ccb-form-control-<?php echo $id; ?>,  .ccb-addon-<?php echo $id; ?> {
        <?php echo (isset( $border_color) ? "border-color:" . $border_color . "!important;" : ""); ?>
    }

    .ccb-addon-<?php echo $id; ?> {
        <?php echo (isset( $header_footer_bg_color) ? "background-color:" . $header_footer_bg_color . "!important;": ""); ?>
        <?php echo (isset( $header_footer_text_color) ? "color:" . $header_footer_text_color . " !important;": ""); ?>
    }

    #CCB-calc #calc-footer.CCB-calc-footer-<?php echo $id; ?> p, #CCB-calc #calc-footer.CCB-calc-footer-<?php echo $id; ?> p a, #CCB-calc #calc-footer.CCB-calc-footer-<?php echo $id; ?> p a:visited,
    #CCB-calc #calc-footer.CCB-calc-footer-<?php echo $id; ?> {
    <?php echo (isset( $header_footer_bg_color) ? "background-color:" . $header_footer_bg_color . "!important;": ""); ?>
    <?php echo (isset( $header_footer_text_color) ? "color:" . $header_footer_text_color . " !important;": ""); ?>
}

    button#<?php echo $id; ?>-calculate_btn, button#<?php echo $id; ?>-clear_btn{
        <?php echo (isset( $button_border_color) ? "border-color:" . $button_border_color . "!important;": ""); ?>
        <?php echo (isset( $button_text_color) ? "color:" . $button_text_color . "!important;": ""); ?>
        <?php echo (isset( $button_bg_color) ? "background-color:" . $button_bg_color . "!important;": ""); ?>
    }

</style>
<?php 
}
?>