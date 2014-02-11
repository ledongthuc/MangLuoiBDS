<?php
		
if ( $this->totalPage <= 1 )
{
	return;
}

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
			$pre="<a style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging( ".($cur-1).",".$this->totalPage.",".$numdisplay.",'".$this->url."', '".$this->idElement."')\"  class='pre'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";			
		}
		if($cur+1<=$this->totalPage)
		{
			$next="<a style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging( ".($cur+1).",".$this->totalPage.",".$numdisplay.",'".$this->url."', '".$this->idElement."')\" class='next'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>";
		}
		for($i=0;$i<$pos_end;$i++)
		{
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
				$paging.="<a class='page_next' style='cursor: pointer; color: rgb(0, 102, 204);' onclick=\"getAjaxPaging( ".$pos_start.",".$this->totalPage.",".$numdisplay.",'".$this->url."', '".$this->idElement."')\">&nbsp;".$pos_start."&nbsp;</a>";
			}
			$pos_start++;
		}

    $paging=$pre.$paging.$next;
    echo $paging;
	?>