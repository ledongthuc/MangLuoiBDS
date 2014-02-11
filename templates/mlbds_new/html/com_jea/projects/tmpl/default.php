<link rel="stylesheet" href="../../css/templates.css" />
<?php 
$rowsCount = count( $this->rows );

if($rowsCount <=0 )
{
	echo JText::_('updating') ;
}
?>


		 <h2 class="list-title">
Danh sách dự án
	</h2>
	<?php 
	foreach($this->rows as $item)
	{
		?>
		<div id='items-list'>
		<div class='item-project'>
		<img src=<?php echo $item['img']?>>
			<div>
				 <a href='#'><?php echo$item['title']?></a>
			</div>
			<div class='list3'>
				<p><?php echo$item['noidung']?></p>
                <a href="#" class="readon">Xem chi tiết</a>
			</div>
		</div>
		
		</div>
        <div class='clear'></div>
		<?php 
	}
	?>
	
<div id="pagination">
&lt;&lt;
<a class="pagenav">Bắt đầu</a> 
&lt;
<a href="#" class="pagenav">Lùi</a>
<a href="#" class="pagenav">1</a>
<a href="#" class="pagenav">2</a>
<a href="#" class="pagenav">3</a>
<a href="#" class="pagenav">4</a>
<a href="#" class="pagenav">Cuối</a>
</div>

 
	