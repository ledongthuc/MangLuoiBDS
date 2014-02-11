function maillienhefrmValidate()
{
	
	var errorStr='';	
	my_name = document.frmmaillienhe.myName;
	my_email = document.frmmaillienhe.myEmail;
	my_phone = document.frmmaillienhe.myPhone;
	
	
	
		if(my_name.value == '')
		{
			errorStr += 'Bạn vui lòng nhập họ và tên \n ';
			my_name.style.borderColor  = "#FF0000";
			

		}
		if(my_phone.value == '')
		{
			errorStr += 'Bạn vui lòng nhập số điện thoại \n';
			my_phone.style.borderColor  = "#FF0000";
			

		}
		if(isNaN(my_phone.value))
		{
			
			errorStr += 'Điện thoại phải là số  \n';
			my_phone.style.borderColor  = "#FF0000";
			
		}
		if(my_email.value == '')
		{
			errorStr += 'Bạn vui lòng nhập Email \n';
			my_email.style.borderColor  = "#FF0000";
		}
		if(my_email.value!='')
		{
			
			if(echeck(my_email.value) == false)
			{
				errorStr += 'Email không đúng định dạng \n';
				my_email.style.borderColor  = "#FF0000";
			}
			
		}
		if(errorStr=='')
		{
			return true;
		}
	else
		{
			alert(errorStr);
			return false;
		}		
		
}
function echeck(str)
{
		
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
		if (str.indexOf(at)==-1){			  
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){		   
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){		   
			return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){				
			return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){				
			return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){			  
			return false
		 }
	

		 return true
}