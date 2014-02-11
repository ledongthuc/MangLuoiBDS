<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
	function unicode($str)
	{
		if(!$str) return false;
		$unicode = array(
			'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ','ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ','Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ'),
			'b'=>array('B'),
			'n'=>array('N'),
			'm'=>array('M'),
			'q'=>array('Q'),
			'h'=>array('H'),
			'p'=>array('P'),
			'k'=>array('K'),
			't'=>array('T'),
			'c'=>array('C'),
			'd'=>array('đ'),
			'd'=>array('Đ'),
			'v'=>array('V'),
			'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề','ể','ễ','ệ','É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề','Ể','Ễ','Ệ'),
			'i'=>array('í','ì','ỉ','ĩ','ị','Í','Ì','Ỉ','Ĩ','Ị'),
			'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ','ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','ợ','Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ','Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','Ợ'),
			'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ','ử','ữ','ự','Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ','Ử','Ữ','Ự'),
			'y'=>array('ý','ỳ','ỷ','ỹ','ỵ','Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
			''=>array(',','.','^',':','"','|','/','~',')','(','%','!','&','*','!','@','#','$','(',')','®','+',"'",'`',"\\",'<','>','?','_','[',']','{','}'),
			''=>array('039;','grave;','&','circ;','tilde;',':','acute;','%','!','@','#','$','^','*','(',')','_','=','+','|','\\',',','?'),
			'-'=>array('&quot;','quot;','.',' - ',' ','amp;','--','---')
						);
  	        foreach($unicode as $nonUnicode=>$uni)
				{
					foreach($uni as $value)
					$str = str_replace($value,$nonUnicode,$str);
				}
    	return $str;
	}
	function getShortDescription( $content, $length )
	{
		if ( mb_strlen( $content, 'utf-8' ) < $length )
		{
			return $content;
		}
		$string = strip_tags(str_replace('[...]', '...', $content));
		$tempStr = mb_substr($string, 0, $length, 'utf-8'); 
		return mb_substr($tempStr, 0, mb_strrpos($tempStr, " ", -1, 'utf-8'), 'utf-8') . " ...";
	}
	function getNewSize($fileName,$width,$height)
	{
		$newSize =  array('width' => $width, 'height' => $height);
		$size = null;
		try 
		{
			$size = getimagesize($fileName);
		}catch (Exception $e)
		{
			return null;
		}
		$imageWidth 	=  $size[0];
		$imageHeight	=  $size[1];
		$pecentWidth 	=  $imageWidth / $width;
		$pecentHeight 	=  $imageHeight / $height;
		if($pecentWidth > $pecentHeight)
		{
			$newSize['height'] = $imageHeight / $pecentWidth;
			$newSize['width'] = $width; 
		}
		elseif($pecentWidth < $pecentHeight)
		{
			$newSize['height'] = $height;
			$newSize['width'] = $imageWidth / $pecentHeight;
		}
		if($pecentHeight == $pecentWidth)
		{
			$newSize['height'] = $height;
			$newSize['width'] = $width;
		}
		return 	$newSize;
	}
	function chiase(){
		echo "<script>
			function fbs_click() {
				u=location.href;
				t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
				return false;
			}
			</script>
			<a href=\"javascript:;\" onClick=\"return fbs_click()\" target=\"_blank\" title=\"".$titlefb."\"><img src=\"".JURI::base()."images/stories/facebook_icon.png\" alt=\"facebook\" width=\"22\" height=\"22\" border=\"0\" /></a>
			<a href=\"https://twitter.com/share?url=".urlencode($pageURL)."\" title=\"".$titletw."\" target=\"_blank\"><img src=\"".JURI::base()."images/stories/twitter-icon.png\" width=\"22px\" height=\"22px\" ></a>
			<a href=\"https://plus.google.com/share?url=".urlencode($pageURL)."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\">
				<img  src=\"".JURI::base()."images/stories/new-g-plus-icon-64.png\" alt=\"".$titlegg."\" width=\"21px\" height=\"22px\" />
			</a>
			<a href=\"mailto:\">
				<img src=\"".JURI::base()."images/stories/mail-icon.png\" width=\"22px\" height=\"22px\" />
			</a>
			<a href=\"#\" onClick=\"window.print()\">
				<img src=\"".JURI::base()."images/stories/printer-icon.png\" width=\"22px\" height=\"22px\" />
			</a>
			</div>
			";
		
	}