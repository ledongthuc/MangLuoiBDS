<?php // no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('jea.css', 'media/com_jea/css/');
include_once "libraries/unisonlib/com_jea_lib.php";

/*
//hoan dang lam
$ta = getSamLand();
$rows = $ta['rows'];
include_once "libraries/unisonlib/test.php";
*/
?>

<div>
	<!-- left -->
	<div style="width:24.5%; float:left;" class="realtor_left">
		<!-- info -->
		<div class="r_left">
			<!-- image -->
			<div >
				<img src="<?php echo $this->row->image["image"]["name"];?>" width="90px" height="120px" />
			</div>
			<!-- name, employee type -->
			<div class="r_name">
				<?php echo $this->row->name . "<br/><span style='color:red;'> (" . $this->row->employee_type . ")</span>";?>
			</div>
			<!-- slogan -->
			<div class="slogan">
	<?php echo $this->row->slogan;?>
			</div>
			<!-- phone -->
			<div>
				<?php echo JText::_("PHONE") . ": " . $this->row->phone;?>
			</div>
			<!-- email -->
			<div>
				<?php echo JText::_("email") . ": " . $this->row->email;?>
			</div>
			<!-- website -->
			<div class="r_web">
			<?php echo JText::_("WEBSITE") . ":<a href='#'> ". $this->row->website." </a>";?>
			</div>
			<!-- address -->
			<div class="r_address">
				<?php echo JText::_("ADDRESS") . ": " . $this->row->address;?>
			</div>
			<!-- operation range -->
			<div>
				<?php echo JText::_("OPERATIONAL RANGE") . ": " . $this->row->operational_range;?>
			</div>			
		</div>
		<!-- contact - get common template -->

			<div class="r_contact"><?php echo JText::_("CONTACT WITH") . $this->row->name;?>
			</div>			
			<!--<form>
			<?php echo JText::_("CONTACT WITH") . " " . $this->row->name;?>
			<br/>	
			--><form action="index.php?option=com_jea&controller=realtors&task=sendmail" method="post" name="frmsendmail">	
			<table class="r_left">
				<!-- name -->
  <tr>
					<td width="69">
						<?php echo JText::_("NAME");?>					</td>
			  <td width="167">
<input name="contact_name" id="contact_name"/>
					</td>
			  </tr>
				<!-- email -->
				<tr>
					<td>
						<?php echo JText::_("EMAIL");?>
					</td>
					<td>
						<input name="contact_email" id="contact_email"/>
					</td>
				</tr>
				<!-- phone -->
				<tr>
					<td>
						<?php echo JText::_("PHONE");?>
					</td>
					<td>
						<input name="contact_phone" id="contact_phone"/>
					</td>
				</tr>
				<!-- content -->
				<tr>
					<td>
						<?php echo JText::_("CONTENT");?>
					</td>
					<td>
						<textarea rows="4" cols="19" name="contact_content" ></textarea>
					</td>
				</tr>
				<!-- submit button -->
				<tr>
					<td colspan="2" align="center">
						<div style="text-align:center;"><input class="button" id="contact_submit" name="contact_submit" type="submit" 
								value="<?php echo JText::_("SEND MAIL");?>"/>
                                </div>
					</td>
				</tr>
			</table>
			<?php
			$cateid=JFactory::getURI()->getVar("proid");
			//print_r("3333333333".$cateid);
			
			?>
			<input type="hidden" name="task" value="sendmail" />
			<input type="hidden" name="realtor_email" value="<?php echo $this->row->email;?>" />
			<input type="hidden" name="realtor_id" value="<?php echo $this->row->id;?>" />
			<input type="hidden" name="proid" value="<?php echo $cateid ;?>" />
			</form>
			
			
			<?php
			if(isset($_POST['contact_submit']))
			{
				JeaControllerRealtors::sendmail();
				//exit;
			}


?>
			
			
			
		<div>
		</div>
		<!-- search - render module search-->
		<div id="r_search">
			<?php echo $this->row->mod_search;?>
		</div>
	</div>
	<!-- right -->
	<div style=" float:right; width:75%">
		<!-- realtor's properties -->
		<div>
			<?php echo $this->row->mod_realtors_properties;?>
		</div>
		<!-- concerned properties -->
		<div>
			<?php echo $this->row->mod_same_properties;?>
		</div>
		<!-- successful properties -->
		<div>
			<?php echo $this->row->mod_successful_properties;?>
		</div>
	</div>
</div>
