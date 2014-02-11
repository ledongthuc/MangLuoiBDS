jQuery.noConflict();
jQuery(document).ready(function() {
	jQuery("#dktv").click(function() {		
		var captcha = jQuery("#captcha").val();		
        if(captcha == "") {
           $("#captcha").focus()
           return false;
        }
		var data_tring = 'captcha='+captcha;
		jQuery.ajax({
                type: "POST",
                url: "http://thietkewebbatdongsan.com/release/webmlbds2/includes/captcha/sendmail.php",
                data: data_tring,
                success: function(data_form) {
                    if(data_form == "true") {
                            //change_captcha();
                    	return true;
                    	//return	jQuery("#josForm").submit();
                    }else {
                       alert('captcha sai');
                       return false;
                    }
                }
            });
		return false;
	});
	jQuery("#load_captcha").click(function() {
        change_captcha();
    });

    function change_captcha() {
        document.getElementById('img_captcha').src="includes/captcha/captcha.php?rnd=" + Math.random();
    }
});