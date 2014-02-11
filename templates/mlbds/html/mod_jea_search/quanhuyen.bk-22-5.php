<li>
	<span class='tinhthanh'>
		
	</span>
	<span class='clear'>
		<?php echo $tinh_thanh_tk;?>
	</span>
</li>
<li>
	<span class='quanhuyen'>
		
	</span>
	<span  class='clear' id="quan_huyen_search">
	<?php echo $quan_huyen_ycbds;?>
	</span>
		
</li>
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/css/jquery.multiselect.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo JURI::root()?>templates/mlbds/js/jquery-1.4.4.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery-ui.min.js"></script>
<script src="<?php echo JURI::root()?>modules/mod_taoyeucau/tmpl/js/jquery.multiselect.js"></script> 
<script type="text/javascript">
multi();
function multi(){
	$("#quan_huyen_id").multiselect();
}
function layseachquanhuyentk(area_name,town_id,lang,path,targetId )
{
	if(lang==null){
		lang='vi-VN';
	}	
	
	var address=path+"quanhuyen2.php?area_name="+area_name+"&town_id="+town_id+"&lang="+lang+"&quan_huyen_id=0";
	$('#quan_huyen_search').load(address,function(){
		$("#quan_huyen_id").multiselect();
	});
	layDanhSachDuAntk(0,lang,path);
	setTimeout(function () { 
		$('[name="multiselect_quan_huyen_id"]').each(function(){
			   $(this).click(function(){
			          var selectedValueTemp = $("#quan_huyen_id").val();

			          var selectedValue = '';
			          if ( selectedValueTemp != null )
			          {
				          selectedValue = selectedValueTemp.toString();
			          }
			          if ( selectedValue != null )
			          {
				          if ( selectedValue.indexOf( this.value ) >= 0 )
				          {
				        	  selectedValue = selectedValue.replace( this.value, "" );
					          if ( selectedValue.indexOf( "," ) == 0 )
					          {
					        	  selectedValue = selectedValue.replace( ",", "" );
					          }
				          }
				          else
				          {
					          if ( selectedValue != "" )
					          {
					          	selectedValue += "," + this.value;
					          } 
					          else if ( this.checked )
					          {
					        	  selectedValue = this.value;
					          }
				          }
			          }
			          if ( selectedValue == "," )
			          {
				          selectedValue = "";
			          }
			          layDanhSachDuAn1(selectedValue,'vi-VN','<?php echo JURI::base();?>');
			   });
			}); 

		$(".ui-multiselect-all").each(function(){
			   $(this).click(function(){
			          //alert(this.value);
					  			          
			          var selectedValueTemp = $("#quan_huyen_id").val();
			          
			          layDanhSachDuAn1(0,'vi-VN','<?php echo JURI::base();?>');
			   });
			});

		$(".ui-multiselect-none").each(function(){
			   $(this).click(function(){
			          //alert(this.value);
					  			          
			          var selectedValueTemp = $("#quan_huyen_id").val();
			          
			          layDanhSachDuAn1(selectedValueTemp,'vi-VN','<?php echo JURI::base();?>');
			   });
			});
		
    } , 1000);
	
}
/*$(function(){
	$('[name="multiselect_quan_huyen_id"]').change(function(){
		alert('change multi');
	});
})*/
</script>