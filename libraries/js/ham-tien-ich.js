// Dung de set home page



function SoSanh(Form, CheckBox, Value)
	{
	//alert("co check");
	    var objCheckBoxes = document.forms[Form].elements[CheckBox];
	    var countCheckBoxes = objCheckBoxes.length;
		var countChecked=0;
	    for(var i = 0; i < countCheckBoxes; i++)
		{
			if(objCheckBoxes[i].checked == true)
			countChecked++;
	      //  objCheckBoxes[iCheck].checked = Value; 		 
		}
		if(countChecked > 2)
		{
			alert("Bạn đã chọn "+countChecked+" tin ! Xin vui lòng chỉ chọn 2 tin để so sánh");
			return;
		}
		if(countChecked < 2)
		{
			alert("Bạn đã chọn "+countChecked+" tin !Xin vui lòng chọn 2 tin để so sánh");
			return;
		}
			//document.forms[Form].submit();
		//	alert("Bạn đã chọn "+countChecked+" tin ! tong check:"+countChecked);
			document.forms[Form].submit();
	}


//
function tongtien(thang,giatien,id)
{
	var tong=thang*giatien;
	document.getElementById(id).innerHTML ='<strong>'+thousandSeparator(tong)+' </strong> đồng';
}
// Ham dùng để thêm dấu phân cách hàng ngàn  vd:   1000 -> 1,000
function thousandSeparator(n,sep)
{
	var sRegExp = new RegExp('(-?[0-9]+)([0-9]{3})');
	sValue=n+'';
	if (sep === undefined) {sep=',';}
	while(sRegExp.test(sValue)) {
	sValue = sValue.replace(sRegExp, '$1'+sep+'$2');
	}
	return sValue;
}
//
/*function CheckSoSanh(Form, CheckBox, Value,iCheck,id)
{
	 var objCheckBoxes = document.forms[Form].elements[CheckBox];
	 var countCheckBoxes = objCheckBoxes.length;
	 if(objCheckBoxes[iCheck].checked == Value)
	 alert("id ne:"+id);
	 else
	 alert("ko check:"+id);
	//document.write('<?php echo "aaaaaaaaaaa"; ?>');
}*/









	
