/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

;
(function($) {
    
    $(document).ready(function($) {
        
        /******************************************************************/
        //Checbox multiselec
        /******************************************************************/
        
        var lastChecked = null;
        var handleChecked = function(e) {
            if (lastChecked && e.shiftKey) {
                var i = $('input[type="checkbox"]').index(lastChecked);
                var j = $('input[type="checkbox"]').index(e.target);
                var checkboxes = [];
                if (j > i) {
                    checkboxes = $('input[type="checkbox"]:gt('+ (i-1) +'):lt('+ (j-i) +')');
                } else {
                    checkboxes = $('input[type="checkbox"]:gt('+ j +'):lt('+ (i-j) +')');
                }

                if (!$(e.target).is(':checked')) {
                    $(checkboxes).removeAttr('checked');
                } else {
                    $(checkboxes).attr('checked', 'checked');
                }
            }
            lastChecked = e.target;
            // Other click action code.
        };
        $('input[type=checkbox]').click(handleChecked);
        
        //select all checkboxes
        $("#select_all").change(function() { 
            //change all "input[type=checkbox]" checked status
            $('input[type=checkbox]').prop('checked', $(this).prop("checked")); 
        });

        $('input[type=checkbox]').change(function() { 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if (false == $(this).prop("checked")) { //if this item is unchecked
                $("#select_all").prop('checked', false); //change "select all" checked status to false
            }
            //check "select all" if all checkbox items are checked
            if ($('input[type=checkbox]:checked').length == $('input[type=checkbox]').length ) {
                $("#select_all").prop('checked', true);
            }
        });
        
        //** end code **//
    });
})(jQuery);