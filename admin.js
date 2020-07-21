var $J = jQuery.noConflict();

$J(document).ajaxComplete(function() {
    $J('#widgets-right .cc-color-field, .inactive-sidebar .cc-color-field').wpColorPicker();
});

$J(document).ready(function(){
    $J('#widgets-right .cc-color-field, .inactive-sidebar .cc-color-field').wpColorPicker();
});

function advancedOptionsClick(cb, options) {
    if (cb.checked) {
        $J("#"+ options).attr('display', 'block');
        $J("#"+ options).show();                    
    }
    else{
        $J("#"+ options).attr('display', 'none');
        $J("#"+ options).hide();                    
    }
}

function unitsChange(value, options) {
    if (value === 'all') {
        $J("#"+ options).attr('display', 'block');
        $J("#"+ options).show();                    
    }
    else{
        $J("#"+ options).attr('display', 'none');
        $J("#"+ options).hide();                    
    }
}   
