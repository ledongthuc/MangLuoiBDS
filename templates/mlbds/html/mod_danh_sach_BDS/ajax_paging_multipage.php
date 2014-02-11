<?php
		
if ( $this->totalPage <= 1 )
{
	return;
}

// get current url
$currentGETPaging = '';

if ( !empty( $_GET['page'] ) )
{
	$currentGETPaging = $_GET['page'];
}
$currentURL = str_replace( '&page=' . $currentGETPaging, '', JURI::getInstance()->toString());
$currentURL = str_replace( '?page=' . $currentGETPaging, '', $currentURL);
$currentURL = str_replace( '/&', '/?', $currentURL);  
$checkCurrentURL = strpos( $currentURL, '?' );

		$anchorPage = 'paging' . $this->idElement;
		$paging="";
		$next="";
		$pre="";
		$pos_start=0;
		$pos_end=0;
		$numdisplay=10;		
		$cur = $this->currentPage;
		if($numdisplay>=$this->totalPage)
		{
			$pos_start=1;
			$pos_end=$this->totalPage;
		}
		else
		{
			$half=$numdisplay/2;
			if($cur<=$half)
			{
				$pos_start=1;
			}
			else
			{
				$pos_start=$cur-$half+1;
			}
			$pos_end=$numdisplay;
		}
		
		if($cur-1>0)
		{			
			if ( $checkCurrentURL )
			{
				$tempCur = $currentURL . '&page=' . ( $cur - 1 );
			}
			else 
			{
				$tempCur = $currentURL . '?page=' . ( $cur - 1 );
			}
			$pre="<a style='cursor: pointer; color: rgb(0, 102, 204);' href='$tempCur' class='pre'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";			
		}
		if($cur+1<=$this->totalPage)
		{
			if ( $checkCurrentURL )
			{
				$tempCur = $currentURL . '&page=' . ( $cur + 1 );
			}
			else 
			{
				$tempCur = $currentURL . '?page=' . ( $cur + 1 );
			}
			$next="<a style='cursor: pointer; color: rgb(0, 102, 204);'  href='$tempCur' class='next'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";
		}
		for($i=0;$i<$pos_end;$i++)
		{
			if ( $checkCurrentURL )
			{
				$tempCur = $currentURL . '&page=' . $pos_start;
			}
			else 
			{
				$tempCur = $currentURL . '?page=' . $pos_start;
			}
			if($i!=0)
			{
				$paging.="&nbsp;"; 
			}
			if($pos_start==$cur)
			{
				$paging.="<strong class='current'>&nbsp;".$pos_start."&nbsp;</strong>";
			}
			else
			{
				$paging.="<a class='page_next' style='cursor: pointer; color: rgb(0, 102, 204);' href='$tempCur' >&nbsp;".$pos_start."&nbsp;</a>";
			}
			$pos_start++;
		}

    $paging=$pre.$paging.$next;
    echo $paging;s
	?>
