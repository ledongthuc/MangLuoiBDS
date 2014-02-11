<?php
defined('_JEXEC') or die('Restricted access');
class HTML_project_slideshow
{
	
	function show()
	{
		
			$db =& JFactory::getDBO();
	        $query  = "SELECT * FROM #__proslideshow";
	        $db->setQuery($query);
			$result = $db->loadObjectList();
			
			foreach ($result as $rows)
			{
				$id=$rows->SID;
				$showstatus = $rows->showstatus;
				$shownumber = $rows->shownumber;
				$speed = $rows->speed;
				$textlengt = $rows->textlengt;
				$path = $rows->path;
				$session = $rows->session;
				$categories = $rows->categories;
				
			}

		switch ($showstatus)
		{
			case 1 :
				$tt1 = "selected";
				break;
			case 2 :
				$tt2 = "selected";
				break;
			case 3 :
				$tt3 = "selected";
				break;
		}
		echo "<form action='index.php' method='post' name='adminForm'>";
		echo "<table>";
		echo "<tr width='300px'>";
		echo "<td>";
		echo JText::_( 'Show kind' );
		echo "</td>";
		echo "<td>";
		echo "<select name='showstatus' id='showstatus' onchange=\"status(this.value)\">";
		echo "<option value='1' $tt1 >".JText::_( 'Project' )."</option>";
		echo "<option value='2' $tt2 >".JText::_( 'session' )."</option>";
		echo "<option value='3' $tt3  >".JText::_( 'Categories' )."</option>";
		echo "</select>";
		echo "</td>";
		echo "</tr>";
			
		echo "<br/>";
		
		echo "<tr width='300px'>";
		echo "<td>";
		echo JText::_( 'show number' );
		echo "</td>";
		echo "<td>";
		echo "<input type='text' name='shownumber' value='$shownumber'>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo JText::_( 'speed' );
		echo "</td>";
		echo "<td>";
		echo "<input type='text' name='speed' value='$speed'>";
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td>";
		echo JText::_( 'textlengt' );
		echo "</td>";
		echo "<td>";
		echo "<input type='text' name='textlengt' value='$textlengt'>";
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr id=\"project\">";
		echo "<td>";
		echo JText::_( 'path' );
		echo "</td>";
		echo "<td>";
		echo "<input type='text' name='path' size='70px' value='$path'>";
		echo "</td>";
		echo "</tr>";
		
		
		echo "<tr  id=\"session\">";
		echo "<td>";
		echo JText::_( 'SESSION' );
		echo "</td>";
		echo "<td>";
		$db =& JFactory::getDBO();
			        $query  = "SELECT * FROM #__sections";
			        $db->setQuery($query);
					$result = $db->loadObjectList();
					echo "<select name='session' id='price_list' class='inputbox'>";
					
					foreach ($result as $row)
					{
						$selected="";
					    if($session == $row->id)
					    {
					    	$selected="selected";
					    }
						echo "<option $selected value='" . $row->id . "'>" . $row->title . "</option>";
					}
					echo "</select>";
		echo "</td>";
		echo "</tr>";
		echo "<tr  id=\"categories\">";
		echo "<td>";
		echo JText::_( 'CATEGORY1' );
		echo "</td>";
		echo "<td>";
		$db =& JFactory::getDBO();
			        $query  = "SELECT * FROM #__categories";
			        $db->setQuery($query);
					$result = $db->loadObjectList();
					echo "<select name='categories' id='price_list' class='inputbox'>";
					foreach ($result as $row)
					{
						$selected="";
					    if($categories == $row->id)
					    {
					    	$selected="selected";
					    }
						echo "<option $selected value='" . $row->id . "'>" . $row->title . "</option>";
						
					}
					echo "</select>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	//	HTML_project_slideshow::save();
		
		?>
		<input type="hidden" name="option" value="com_project_slideshow" />
		<input type="hidden" name="task" value="" />
<!--		<input type="hidden" name="boxchecked" value="0" />-->
<!--		<input type="hidden" name="controller" value="bookmanager" />-->
	<?php echo JHTML::_( 'form.token' ); ?>
	
	</form>
	<?php
	}
	
	function save()
	{
		echo "vao toi day rui";
		exit;
//		 SET showstatus = ,shownumber= , speed = 1,textlengt= ,path= ,SESSION= ,categories=

		$showstatus = JRequest::getVar('showstatus');
		$shownumber = JRequest::getVar('shownumber');
		$speed = JRequest::getVar('speed');
		$textlengt = JRequest::getVar('textlengt');
		$path = JRequest::getVar('path');
		$session = JRequest::getVar('session');
		$categories = JRequest::getVar('categories');
//		speed = JRequest::getVar('speed');
		
				
			$db =& JFactory::getDBO();
	        $query  = "
	        UPDATE jos_proslideshow
	         	SET showstatus = '$showstatus' ,shownumber = '$shownumber' , speed = '$speed' ,
	        	textlengt = '$textlengt' ,path = '$path' ,session = '$session' ,categories = '$categories'
	        WHERE SID=1";
	        mysql_query($query);
	        //$db->setQuery($query);
	        
	      echo"<script>alert('Đã lưu thành công');document.location.href='index.php?option=com_project_slideshow&task=show'</script>";
//	        global $mainframe;
//			$mainframe->redirect('index.php?option=com_project_slideshow&task=show');
	        

	        // start debug
	        echo "<pre>";
	        print_r($query);
	        echo "</pre>";
	        // end debug
	       
			
	}
}
?>

<script language="javascript" type="text/javascript">
	function status(d1)
	{
//		alert(d);
		if(d ==1)
		{
			document.getElementById('project').style.display = 'block';
			document.getElementById('session').style.display = 'none';
			document.getElementById('categories').style.display = 'none';
			
		}
		else
			if(d == 2)
			{
				document.getElementById('project').style.display = 'none';
				document.getElementById('session').style.display = 'block';
				document.getElementById('categories').style.display = 'none';
			}
			else
			{
				document.getElementById('project').style.display = 'none';
				document.getElementById('session').style.display = 'none';
				document.getElementById('categories').style.display = 'block';
			}
		
//		document.getElementById('title_project').style.color  = "red";
//		document.getElementById('title_session').style.color  = "#000000";
//		document.getElementById('title_categories').style.color  = "#000000";
		
		
	}

</script>

		