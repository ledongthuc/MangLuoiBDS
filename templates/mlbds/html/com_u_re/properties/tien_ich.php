<?php 
if ( $this->allFlag ) {
foreach ( $this->tienIchAllList as $tienIchList) {?>
<div class="StructureC">
<dl class="listing-detail-stats-main">
	<?php if ( !empty( $tienIchList['data'] ) ) {
	
	 foreach ( $tienIchList['data'] as $tienIch ) {?>

<dt class="listing-detail-stats-main-key ">
	<li>
		
		
		
		<span class="advantage">
			<?php echo $tienIch['ten_tien_ich'];?>
		</span>		
		<span class="advantageimg">
		<?php if (!empty( $tienIch['checked'] )) {?>
			<img height="12" width="12" src="images/com_jea/check.gif">
			<?php } // end if ?>
		</span>
	</li>
	</dt>

	<?php } // end if 
	 } // end foreach $tienIchList?>
	 </dl>
</div><div class='clear'>
</div>
<?php } // end foreach $tienIchAllList
} else { // end if all
foreach ( $this->tienIchAllList as $tienIchList) {?>
<div class="StructureC">
<h4 class='loai_tien_ich'>
	<?php echo $tienIchList['ten'];
	foreach ( $tienIchList['data'] as $tienIch ) {?>
</h4>
<dt class="listing-detail-stats-main-key ">
	<li>
		<span class="advantage">
			<?php echo $tienIch['ten_tien_ich'];?>
		</span>		
	</li>
	</dt>
	<?php } // end foreach $tienIchList?>
</div>
<?php } // end foreach $tienIchAllList
} // end else?>
