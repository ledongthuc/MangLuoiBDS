<?php
$this->lang = 'vi'; //gan tam thoi
?>

<!-- <img src="../images/vi.gif"  style="cursor:pointer" onclick="getDataLang('vi')" />
<img src="../images/us.gif"  style="cursor:pointer"  onclick="getDataLang('en')" />  -->


<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
//echo "vao default form";
//exit;
?>
<?php
//echo $this->ten;
//exit;
//print_r($this->rows);
?>
<?php
	if ($this->tenBang == 'don_vi_tien')
	{
		include_once('price_unit.php');
	}
	else
	{
?>
<form action="index.php" method="post" name="adminForm" id="adminForm" onsubmit="getDataLang('vi')" >
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<span id ='changlabel'><?php echo JText::_( 'value' ); ?></span>
					:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="ten" id="ten" size="32" maxlength="250" value="<?php echo $this->ten;?>" />
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="vi_hidden_ten" id="vi_hidden_ten" value=" " />
<input type="hidden" name="en_hidden_ten" id="en_hidden_ten" value=" " />
<input type="hidden" name="tmp" id="tmp"  value="<?php echo $this->lang ?>" />
<!--<input type="hidden" name="currenlabel" id="currenlabel"  value=" " />-->
<input type="hidden" name="option" value="com_jea" />
<input type="hidden" name="controller" value="features" />
<input type="hidden" name="id" value="<?php echo $this->id ?>" />
<input type="hidden" name="townId" value="<?php echo $this->townId ?>" />
<input type="hidden" name="table" value="<?php echo $this->tenBang ?>" />
<input type="hidden" name="task" value="" />
<!-- 
<input type="hidden" name="loai_tien_ich_id" value="<?php echo $this->tien_ichID ?>" />
<input type="hidden" name="ten_loai" value="<?php echo $this->ten_tien_ich ?>" />
 -->
<?php echo JHTML::_( 'form.token' ) ?>
</form>
<?php } // end else?>
<script type="text/javascript">
function getDataLang(tmp)
{
	// alert(tmp);
	// tmp: luu tru gia tri ngon ngu hien tai
	var lang = document.getElementById('tmp').value;
	document.getElementById('tmp').value = tmp;
//	alert(lang);
	var name = document.getElementById('ten').value;
//	alert(name);
	document.getElementById(lang+'_hidden_ten').value = name;
	
	// reset lai o textbox khi chuyen qua ngon ngu moi hoac lay lai gia tri khi quay tro ve
	var hidden_name = document.getElementById(tmp+'_hidden_ten').value;
	document.getElementById('ten').value = hidden_name;
//alert(lang);
	if ( tmp == 'vi' )
	{
		document.getElementById('changlabel').innerHTML = 'Giá trị';
	}
	else
	{
		document.getElementById('changlabel').innerHTML = 'Value';
	}
	
//	alert(t);
	

}
</script>