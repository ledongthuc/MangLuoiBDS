<?php
ob_start();
/*
user:TheOcean
date:Dec 27, 2011
time:10:57:53 AM
*/
// no direct access

defined('_JEXEC') or die('Restricted access'); 
jimport('joomla.html.pagination');
$limitstart = 0;
if ( $total <= $limit ) { $limitstart = 0; }
$pageNav = new JPagination( $total, $limitstart, $limit );
?>


<script type="text/javascript">
	function resetData()
	{
		jQuery("#name").val("Họ tên") ;

		jQuery("#email").val("Email");

		jQuery("#title").val("Tiêu đề");

		jQuery("#osolCatchaTxt0").val("");

		reloadCapthcha0(0);
	}
	

	function addComment()
	{
		// kiem tra cac truong co rong khong
		
		// tieu de
		if ( jQuery("#name").val() == "Họ tên" || jQuery("#name").val() == "" )
		{
			alert('Bạn vui lòng nhập họ tên');
			return;
		}
			
		if ( jQuery("#email").val() == "Email" || jQuery("#email").val() == "" )
		{
			alert('Bạn vui lòng nhập email');
			return;
		}

		if ( jQuery("#comment").val() == "" )
		{
			alert('Bạn vui lòng nhập ý kiến');
			return;
		}

		if ( jQuery("#osolCatchaTxt0").val() == "" )
		{
			alert('Bạn vui lòng nhập mã bảo mật');
			return;
		}
		
		// set du lieu cho tieu de
		if ( jQuery("#title").val() == "Tiêu đề" )
		{
			jQuery("#title").val("");
		}

		dulieu = jQuery("#fcomment").serialize(); 
		jQuery.post('<?php echo JURI::base();?>0_comment.php',dulieu,xuly);	
		jQuery("#title").val("");
		jQuery("#name").val("");
		jQuery("#email").val(" ");
		jQuery("#comment").val(" ");
	}
	function xuly(data){
		if(data=="OK"){
			jQuery("#thongbao").html("<?php echo JText::_('THANKS_FOR_COMMENT')?>");
			// reset data
			resetData();
		}
		else if ( data=="Wrong_code" )
		{
			jQuery("#thongbao").html("<?php echo JText::_('Mã bảo mật không đúng, bạn vui lòng nhập lại')?>");
			resetData();
			// reset data
		}
	}
	
	function showCommentForm()
	{
		// show form
		$("#comment_form").show();
		
		// hide link
		$("#comment_link").hide();
	}

	function xoaGiaTriTrongTextBox( elementId, elementTitle )
	{       
        var temp=document.getElementById(elementId).value;
		if(temp == elementTitle)
		{
        	document.getElementById(elementId).value = "";
		}
    }
    
    function traVeGiaTriTrongTextBox( elementId, elementTitle )
    {
    	var temp=document.getElementById(elementId).value;
    	if ( temp == "" )
    	{
    		document.getElementById(elementId).value = elementTitle;
    	}
    }
   
</script>
<div id='commentbox-big' class='commentbox-big'>

<?php 
	if ( !empty($rows) )
	{
	foreach ($rows as $k => $v)
	{
?>	

<div id="bogoc">
<table width="100%" class='commentbox'>
	<tr>
    <td><p class="tieude_comment"><?php  echo $v[0]?> </p>
    <p class="tieude"><span class="noidung"><?php echo $v[1]?> </span></p></td>
  </tr>
  <tr>
    <td align="left"><span class="ngay">Người gửi:<?php echo $v[2]?> </span>
    <!--  <span class="ngay">Gửi lúc:<?php echo $v[4]?>  </span>--></td>
  </tr>
  </table>
</div>

<?php }?>
<?php } // if empty row?>
</div>
<div id="phantrang"><?php echo $pageNav->getPagesLinks(); ?></div>
<!--<div><span class='gh5'><?php //echo JText::_('ADD_COMMENT');?></span></div>-->

<a id="comment_link" onclick="showCommentForm()"> </a>

<div style="color:red" id="thongbao"></div>
<div id="comment_form" style="display:none">
<form id="fcomment" name="fcomment" method="post" action="index.php">
  <table width="100%" border="0">
  <tr>
    <td width="50%">
    <input id="name" name="name" class="email" type="text" value="Họ tên" size="26"
    	onclick="xoaGiaTriTrongTextBox('name', 'Họ tên')" onblur="traVeGiaTriTrongTextBox( 'name', 'Họ tên' )">
    </td>
    <td width="50%">
    	<input  value="Email" class="email" name="email" type="text" id="email" size="26" 
    		onclick="xoaGiaTriTrongTextBox('email', 'Email')" onblur="traVeGiaTriTrongTextBox( 'email', 'Email' )"/>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    	<input class="email" value="Tiêu đề" name="title" type="text" id="title" size="60" 
    	onclick="xoaGiaTriTrongTextBox('title', 'Tiêu đề')" onblur="traVeGiaTriTrongTextBox( 'title', 'Tiêu đề' )"/>
    </td>
    
  </tr>
  
  <tr>
    
    <td style='padding:0px;' colspan="2"><textarea  value="Nhập nội dung của bạn" name="comment" id="comment" cols="47" rows="5"></textarea></td>
  </tr>
  <tr>
  <!--<td><input type="hidden" name="task" value="add">
				 <img id="captcha_img" src="<?php echo JURI::base()?>components/com_datcho/random_images.php" /> <br/>
				 <input type="text" name="txtCaptcha" maxlength="10" size="10" />
				 <br/><span class="required"><?php if(!empty($errors['txtCaptcha'])) echo $errors['txtCaptcha']?></span>
				</td>
				<td><input class="save_datcho" type="submit" name="save" value="Gửi yêu cầu"/></td>
  	-->
  	<td colspan="2"> <?php
		global $mainframe;
		//set the argument below to true if you need to show vertically( 3 cells one below the other)
		$mainframe->triggerEvent('onShowOSOLCaptcha', array(false));
		
//		echo "<pre>";
//		print_r( $_SESSION );
//		echo "</pre>";
	?></td>
    
        
  </tr>
  <tr>
    <td colspan="2"><input type="hidden" name="id" value="<?php echo $topicId; ?>" />
    <input type="hidden" name="component_name" value="<?php echo $componentName; ?>" />
    <input type="hidden" name="topic_name" value="<?php echo $topicName; ?>" />
    <input type="button" class="button" name="btnComment" id="btnComment" value="Gửi" onclick="addComment()"/> </td>
  </tr>
</table>
</form>

</div>

<?php 
$session = JFactory::getSession();
//		echo "<pre>";
//		print_r( $session->get('securiy_code0') );
//		print_r( $session );
//		print_r( $_SESSION );
//		echo "</pre>";

?>

<?php if( count( $rows ) == 0 ) {?>
<script>
$(document).ready(function() {
		document.getElementById('commentbox-big').style.height='0px';
	});
</script>
<?php }?>