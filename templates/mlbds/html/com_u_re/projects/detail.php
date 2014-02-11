<link rel="stylesheet" href="../templates/mlbds/css/templates.css" />
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/admin_utils.js"></script>
<script type="text/javascript" src="<?php echo JURI::root()?>libraries/com_u_re/js/jstab.js"></script>

<?php


if ($this->status == 2 )
{
	echo "<div>";
?>

<script type="text/javascript" src="../libraries/js/ajax.js"></script>

<?php
$editor =& JFactory::getEditor();


}
?>

<form action="index.php?option=com_jea&controller=projects" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >  
<?php
if ( $this->status == 2)
{
?>
<div  style="padding-left: 120px;">
<input type="button" onclick="submitbutton_duan()" name="save" class="btn-search" value="<?php echo JText::_('LUU') ?>" />
<input type="button" onclick="submitbutton('cancel')" name="huy" class="btn-search" value="<?php echo JText::_('CANCEL') ?>" />
</div>
<?php
} /* Chỗ đóng móc không cho hiển thị ở fontent*/
?>  
<div class="total"> 
               

                <?php
				if( $this->status != 0 )
				{?>
				<table class='contentpane adminduan'>
					<tr>
						<td align="right">
							<span id='aj_PROJECT_NAME'>	<?php  echo JText::_('TEN_DU_AN'); ?></span>
						</td>
						<td>
							<input id="name" type="text" size="87" name="name" value="<?php echo $this->row['ten'] ?>" class="inputbox" onKeyPress = "locdau(this.value)" onchange="locdau(this.value)" AUTOCOMPLETE= OFF />
						</td>
					</tr>
					<tr>
						<td align="right">
							<span id='aj_PROJECT_NAME'>	<?php  echo JText::_('ALIAS').":"; ?></span>
						</td>
						<td>
							<input id="alias" type="text" size="87" name="alias" value="<?php echo $this->row['alias'] ?>" class="inputbox" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<li>
								<span id='ja_TINH_THANH'>	<?php echo JText::_('TINH_THANH');?>:</span>
							</li>
						</td>
						<td>
							<li>
								<?php echo $this->towns;?>					
							</li>
						</td>
					</tr>
					<tr>
						<td align="right">
							<li>
								<span id='ja_TINH_THANH'>Quận huyện :</span>
							</li>
						</td>
						<td>
							<li>
							
						<?php echo $this->areas;?>	
							</li>
						</td>
					</tr>
					
				</table>
				
				
					
				<?php
				}
				 ?>
               
</div> <!--  div chua title-->
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="zip_code" value="084" />
  <input type="hidden" name="id" value="<?php echo $this->row['id'] ?>" />
  <?php echo JHTML::_( 'form.token' ) ?>    

	
	<input type="hidden" name="vi_loai_du_an" id="vi_loai_du_an"  value="<?php echo $this->row['loai_du_an'] ?>" />
	<input type="hidden" name="en_loai_du_an" id="en_loai_du_an"  value="<?php echo $this->row['loai_du_an'] ?>" />
	
			<?php
		if ( $this->status == 2 )
		{
		?>
			<!--<input type="button" onclick="submitbutton_duan()" name="save" class="button" value="<?php echo JText::_('LUU') ?>" />
			<input type="button" onclick="submitbutton('cancel')" name="huy" class="button" value="<?php echo JText::_('CANCEL') ?>" />-->
		<?php
		}		
		//echo "</div>";
		?>
</form>

<script language="javascript" type="text/javascript">
  
  function locdau(str) {  
	  str= str.toLowerCase();  
	  str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
	  str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
	  str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
	  str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
	  str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
	  str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
	  str= str.replace(/đ/g,"d");  
	  str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-"); 
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */ 
	  str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1- 
	  str= str.replace(/^\-+|\-+$/g,"");  
	//cắt bỏ ký tự - ở đầu và cuối chuỗi  
  	document.getElementById('alias').value = str;
  }   
</script>
<input type="hidden" name="tab_current" id="tab_current"  value="tab_OVERVIEW" />