

var ccBMI = ccBMI || (function () {
    

    return {

        GetCategory: function (bmi) {
            var bmi_category, bmi_style;
            bmi_style = 'alert-success';
            bmi_category = 'Normal BMI';
            if (bmi < 16) {
                bmi_style = 'alert-danger';
                bmi_category = 'You have Severe Thinness-Eat strict Balanced diet';
            } else if (bmi < 17 ) {
                bmi_style = 'alert-warning';
                bmi_category = 'You have Moderate Thinness-Eat Balanced diet';
            } else if (bmi < 18.5) {
                bmi_style = 'alert-info';
                bmi_category = 'You have Mild Thinness-Improve your diet';
            } else if (bmi < 25) {
                bmi_style = 'alert-success';
                bmi_category = 'You have Normal BMI!Congratulations!';
            } else if (bmi < 30) {
                bmi_style = 'alert-info';
                bmi_category = ' You are Pre Obese-Follow proper diet and workout plan';
            } else if (bmi < 35) {
                bmi_style = 'alert-warning';
                bmi_category = 'Tou are in Obese Class I-Follow proper diet and workout plan';
            } else if (bmi < 40) {
                bmi_style = 'alert-warning';
                bmi_category = 'You are in Obese Class II-Follow proper diet and workout plan';
            } else {
                bmi_style = 'alert-danger';
                bmi_category = 'You are in Obese Class III-Follow proper diet and workout plan';
            }

            this.style = bmi_style;
            this.category = bmi_category;
        }
    };
}());

jQuery(document).ready(function ($J) {

    $J(".clear_btn").click(function (e) {
        e.preventDefault();
        clearForm(get_id(this.id, "clear_btn"));
    });

    $J(".calculate_btn").click(function (e) {
        e.preventDefault();
    });


    $J('.units').change(function () {
        widget_id = get_id(this.name, 'units');
        if ($J('#' + widget_id + '-radioMetric').prop('checked')) {
            $J("#" + widget_id + "-imperial").hide();
            $J("#" + widget_id + "-metric").show();
        } else {
            $J("#" + widget_id + "-metric").hide();
            $J("#" + widget_id + "-imperial").show();
        }
        clearForm(widget_id);
    });

    

    $J(".weight-lbs").keydown(function (e) {
        if (!(isDecimalKey(e, this.value))) e.preventDefault();
    });

    $J(".weight-lbs").keyup(function () {
        calculateImperialBMI(get_id(this.id, "weight-lbs"));
    });

    $J(".height-in").keydown(function (e) {
        if (!(isIntegerKey(e, this.value))) e.preventDefault();
    });

    $J(".height-in").keyup(function () {
        calculateImperialBMI(get_id(this.id, "height-in"));
    });

    $J(".height-ft").keydown(function (e) {
        if (!(isIntegerKey(e, this.value))) e.preventDefault();
    });

    $J(".height-ft").keyup(function () {
        calculateImperialBMI(get_id(this.id, "height-ft"));
    });

    function clearForm(widget_id) {
        $J('#' + widget_id + '-height-ft').val("");
        $J('#' + widget_id + '-height-in').val("");
        $J('#' + widget_id + '-weight-lbs').val("");

        $J('#' + widget_id + '-height').val("");
        $J('#' + widget_id + '-weight').val("");

        $J('#' + widget_id + '-BMI-Description').html("");
        $J('#' + widget_id + '-BMI-Description').hide();
    }

    function calculateMetricBMI(widget_id) {
        var weight_kg = parseFloat($J('#' + widget_id + '-weight').val()),
            height_m = parseFloat($J('#' + widget_id + '-height').val()) / 100,
            bmi,
            bmi_category;

        
        if (isNaN(weight_kg) || weight_kg === "" || isNaN(height_m) || height_m ==="") {
            $J('#' + widget_id + '-BMI-Description').hide();
            return;
        }

        bmi = weight_kg / Math.pow(height_m, 2);
        bmi_category = new ccBMI.GetCategory(bmi);

        $J('#' + widget_id + '-BMI-value').html(round2TwoDecimals(bmi));
        $J('#' + widget_id + '-BMI-Description').html("<p>Your Health score is " + round2TwoDecimals(bmi) + "</p><p> (" + bmi_category.category + ")</p>");
        $J('#' + widget_id + '-BMI-Description').toggleClass('alert-success alert-info alert-warning alert-danger', false);
        $J('#' + widget_id + '-BMI-Description').toggleClass(bmi_category.style, true);
        $J('#' + widget_id + '-BMI-Description').show();
    }

    function calculateImperialBMI(widget_id){
        var weight_lbs = parseFloat($J('#' + widget_id + '-weight-lbs').val()),
            height_ft = parseFloat($J('#' + widget_id + '-height-ft').val()),
            height_in = parseFloat($J('#' + widget_id + '-height-in').val()),
            bmi,
            bmi_category;

        // if no data entered
        if (isNaN(weight_lbs) || weight_lbs === "" || isNaN(height_ft) || height_ft === "" || isNaN(height_in) || height_in === "") {
            $J('#' + widget_id + '-BMI-Description').hide();
            return;
        }

        height_in = height_in + height_ft * 12;
        height_in=height_in/39.370;

        bmi = (weight_lbs / Math.pow(height_in, 2));
        bmi_category = new ccBMI.GetCategory(bmi);

        $J('#' + widget_id + '-BMI-value').html(round2TwoDecimals(bmi));
        $J('#' + widget_id + '-BMI-Description').html("<p>Your Health Score is " + round2TwoDecimals(bmi) + "</p><p> (" + bmi_category.category + ")</p>");
        $J('#' + widget_id + '-BMI-Description').toggleClass('alert-success alert-info alert-warning alert-danger', false);
        $J('#' + widget_id + '-BMI-Description').toggleClass(bmi_category.style, true);
        $J('#' + widget_id + '-BMI-Description').show();
    }

});


function get_id(long_id, fieldname) {
    return long_id.substr(0, long_id.lastIndexOf(fieldname) - 1);
}

function isIntegerKey(e)	  
  {
     var key = e.which || e.keyCode;
     var isInteger = (!e.shiftKey) && (key == 8 || 
            key == 9 ||
            key == 46 ||
            (key >= 35 && key <= 40) ||
            (key >= 48 && key <= 57) ||
            (key >= 96 && key <= 105));
    return isInteger;
            
  }
  
function isDecimalKey(e, number)
  {
     var key = e.which || e.keyCode;
     if ((!e.shiftKey) && ((key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 110 || key == 190 || key == 8 || key == 9 || (35 <= key && key <= 40) || key == 46 ))
         {
                   if (key == 110 || key == 190)
                  {
                     if (number.indexOf(".") > -1 || number.indexOf(",") > -1 || number.length === 0) 
                         return false; 
                  }
                  return true;
        }

     return false;
  };

function round2TwoDecimals(number)
     {
         return Math.round(number*100)/100						 
     };	