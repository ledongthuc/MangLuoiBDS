<div style="float: right;" class="ajax_paging_item">
	<!-- nut pre -->
	<div style="float:left; widht:50px;">
	<img style="cursor: pointer; color: rgb(0, 102, 204);" 
		onclick="getAjaxPagingContent( '<?php echo $this->url?>', '<?php echo $this->idElement?>', -1 )" 
		src="<?php echo IMAGE_AJAXPAGING_PRE;?>"
	/>
	</div>
	<div style="float:left; widht:50px;">
	<!-- hien thi thong tin trang hien tai va tong so trang -->	
	<span class="current_page" >
		<div style='float:left' id="current_page_<?php echo $this->idElement?>"><?php echo $this->currentPage ?></div>
		 <div style='float:left'>/</div> 
		<div style='float:left' id="total_page_<?php echo $this->idElement?>"><?php echo $this->totalPage;?></div>
	</span>
	</div>
	<div style="float:left; widht:50px;">
	<!-- nut next -->
	<img style="cursor: pointer; color: rgb(0, 102, 204);" 
		onclick="getAjaxPagingContent( '<?php echo $this->url ?>', '<?php echo $this->idElement?>', 1 )" 
		src="<?php echo IMAGE_AJAXPAGING_NEXT;?>"
	/>
	</div>
	
	
</div>
