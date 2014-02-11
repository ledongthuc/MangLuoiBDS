<?php
class Unison_jea_lib
{
	function getHtmlList($table, $title, $id ,$isTown=false){
	
		$sql = "SELECT `id` AS value ,`value` AS text FROM {$table} ORDER BY ordering" ;
	
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
	
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
	
		//unshift default option
		array_unshift($rows, JHTML::_('select.option', '0', $title ));
		if($isTown==true)
		{
			return JHTML::_('select.genericlist', $rows , $id, 'class="inputbox" size="1" onchange="town_change(this.value);" ' , 'value', 'text', 0);
		}
		else
		{
			return JHTML::_('select.genericlist', $rows , $id, 'class="inputbox" size="1" ' , 'value', 'text', 0);
		}
	}
	
	function getHtmlCheckBox($table,$colorLink){
	
		$sql = "SELECT `id` AS value ,`value` AS text FROM {$table} ORDER BY ordering" ;
	
		$db = & JFactory::getDBO();
		$db->setQuery($sql);
		$rows = $db->loadObjectList();
	
		if ( $db->getErrorNum() ) {
			JError::raiseWarning( 200, $db->getErrorMsg() );
		}
		$iCheck=0;
		foreach($rows as $item)
		{
			echo '<INPUT type="checkbox" name="loaidiaoc[]" value='.$item->value.'>'.'<a style="color:'.$colorLink.' !important;" href=# onclick="SetValues(\'fSearch\',\'loaidiaoc[]\',true,'.$iCheck.')" >'.$item->text.'</a><BR>';
			//<a href=# onclick="document.forms[0].submit(); return false" ></a>
			$iCheck++;
		}
	}
	
	function getSearchActionUrl($url)
	{
		$startPos = strrpos($url, '&id=');
		if ($startPos > 0)
		{
			$endPos = strpos($url, '&', $startPos + 1);
			if ($endPos > $startPos)
			{
				$removedStr = substr($url, $startPos, $endPos);
			}
			else
			{
				$removeStr = substr($url, $startPos, strlen($url) - 1);
			}
		}
	}
	
	/* function lay the <a> */
	function getTagA($value, $href, $title=null, $class=null, $id=null, $onclick=null, $style=null, $target=null, $name=null )
	{
			$Taga = "<a href='$href'
					title='$title' 
					class='$class' 
					id='$id' 
					onclick='$onclick' 
					style='$style' 
					target='$target'
					name='$name'>
					$value
					</a>";
					return @$Taga;
	}
	
	/* function lay the <img> */
	function getTagImg($src, $alt=null, $title=null, $style=null, $class=null, $id=null, $name=null)
	{
		$TagImg = "<img src='$src'
					alt='$alt' 
					title='$title' 
					style='$style' 
					class='$class' 
					id='$id' 
					name='$name' 
					 />";
		return $TagImg;
	}
	
	/* Hàm cut string*/
	function getcutstr($text,$length=64,$tail="...")
      {
	      $text = trim($text);
	      $txtl = strlen($text);
	      if($txtl > $length)
	      {
	     	for($i=1;$text[$length-$i]!=" ";$i++)
	     	{
	      		if($i == $length)
	      		{
	      			return substr($text,0,$length) . $tail;
	     		 }
	      	}
     	for(;$text[$length-$i]=="," || $text[$length-$i]=="." || $text[$length-$i]==" ";$i++) {;}
	      $text = substr($text,0,$length-$i+1) . $tail;
	      }
	      return $text;
      } 
}
?>