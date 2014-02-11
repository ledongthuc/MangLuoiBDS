	jQuery.noConflict();
    jQuery(document).ready(function(){
		function read(param){return document.getElementById(param).value;}
		function write(param,value){return document.getElementById(param).value=value;}
		function inner(param,value){return document.getElementById(param).innerHTML=value;}
		
		var frommail=false;var tomail=false;var subject=false;		
		function checkemail(email){
			var remail='';
			for (i=0;i<=email.length-1;i++){
				remail+=email[email.length-i-1];				
			}
			return (email.indexOf('@')!=-1)&&(email.indexOf('.')!=-1)&&(remail.indexOf('.')>=2);
		}		
		jQuery('#tryagain').click(function(){
			alert('ok');
		});
		
		jQuery('#sendmail').click(function(){
			if (frommail&&tomail&&subject){
				jQuery('input').fadeOut('fast');
				jQuery('.alerttext').fadeOut('fast');
				jQuery('.detail_text').fadeOut('fast');
				jQuery('.form_detail').fadeOut('fast');
				inner('mailstatus','<img src="modules/mod_social/tmpl/email/img/load.png"/>');
				inner('successbox','<img src="modules/mod_social/tmpl/email/img/loader.gif" width="20px"/>');
				
				jQuery.ajax({
					type: "POST",
					url: "modules/mod_social/tmpl/email/sendmail.php",
					data: {mailfrom:read('mailfrom'),mailto:read('mailto'),subject:read('subject'),content:read('content')}})
					.success(function(msg){
						if (msg!=' '){
							inner('mailstatus','<img src="modules/mod_social/tmpl/email/img/success.png"/>');
							inner('successbox','Đã gửi email thành công ! <br/><br/><input type="button" value="Hoàn tất" onClick="window.location.reload()">');
						} else {
							inner('mailstatus','<img src="modules/mod_social/tmpl/email/img/fail.png"/>'); 
							inner('successbox','Đã có lỗi xảy ra. Vui lòng thử lại !');
						}	
					})
				jQuery('#successbox').fadeIn('slow');	
			}			
		});
		jQuery('#reinput').click(function(){
			write('mailfrom','Email người gửi'); inner('fromalert',''); frommail=false;
			write('mailto','Email người nhận'); inner('toalert','');  tomail=false;
			write('subject','Tiêu đề thư');	inner('subjectalert','');	subject=false;
			write('content','Nội dung thư');inner('contentalert','');	content=false;
		});
		
		jQuery('#mailfrom').focus(function(){
		    inner('fromalert','');
			read('mailfrom')=='Email người gửi'?write('mailfrom',''):''; 
		});
		
		jQuery('#mailfrom').blur(function(){
			if (read('mailfrom')=='') {write('mailfrom','Email người gửi');  frommail=false; exit();}
			if (checkemail(read('mailfrom'))){
				inner('fromalert','<img src="modules/mod_social/tmpl/email/img/ok.png"/>');
				frommail=true;	
			} else 
			{
				frommail=false;
				inner('fromalert','<img src="modules/mod_social/tmpl/email/img/error.png"/>');
			}
		});
				
		jQuery('#mailto').focus(function(){
		    inner('toalert','');
			read('mailto')=='Email người nhận'?write('mailto',''):''; 
		});
		
		jQuery('#mailto').blur(function(){
			if (read('mailto')=='') {write('mailto','Email người nhận'); frommail=false; exit();}
			if (checkemail(read('mailto'))){
				inner('toalert','<img src="modules/mod_social/tmpl/email/img/ok.png"/>');
				tomail=true;	
			} else 
			{
				tomail=false;
				inner('toalert','<img src="modules/mod_social/tmpl/email/img/error.png"/>');
			}
		});
		
		jQuery('#subject').focus(function(){
		    inner('subjectalert','');
			read('subject')=='Tiêu đề thư'?write('subject',''):''; 
		});
		
		jQuery('#subject').blur(function(){
			if (read('subject')=='') {write('subject','Tiêu đề thư'); frommail=false; exit();}
			if (read('subject').length>0){
				inner('subjectalert','<img src="modules/mod_social/tmpl/email/img/ok.png"/>');
				subject=true;	
			} else subject=false;
		});
		
		jQuery('#content').focus(function(){
			read('content')=='Nội dung thư'?write('content',''):''; 
		});
		
		jQuery('#content').blur(function(){
			if (read('content')=='') {write('content','Nội dung thư');  frommail=false; exit();}
		});		
	});
