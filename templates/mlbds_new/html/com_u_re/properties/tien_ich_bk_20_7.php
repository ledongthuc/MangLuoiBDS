<?php 
if ( $this->allFlag ) {
foreach ( $this->tienIchAllList as $tienIchList) {?>
<div class="StructureC">
<h4 class='loai_tien_ich'>
	<?php if ( !empty( $tienIchList['data'] ) ) {
	 echo $tienIchList['ten'];
	 foreach ( $tienIchList['data'] as $tienIch ) {?>
</h4>
<div class='cautruc'>
	<li>
		<?php if (!empty( $tienIch['checked'] )) {?>
		<span class="advantageimg">
			<img height="12" width="12" src="images/com_jea/check.gif">
		</span>
		<?php } // end if ?>
		<span class="advantage">
			<?php echo $tienIch['ten_tien_ich'];?>
		</span>		
	</li>
	</div>

	<?php } // end if 
	 } // end foreach $tienIchList?>
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
<div class='cautruc'>
	<li>
		<span class="advantage">
			<?php echo $tienIch['ten_tien_ich'];?>
		</span>		
	</li>
	</div>
	<?php } // end foreach $tienIchList?>
</div>
<?php } // end foreach $tienIchAllList
} // end else?>
