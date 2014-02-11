<?php 
if ( $this->allFlag ) {
foreach ( $this->tienIchAllList as $tienIchList) {?>
<div class="StructureC">
<li class='loai_tien_ich'>
	<?php if ( !empty( $tienIchList['data'] ) ) {
	 echo $tienIchList['ten'];
	 foreach ( $tienIchList['data'] as $tienIch ) {?>
</li>
<div class='cautruc'>
	<li>


<?php 
$checked = '';
if (!empty( $tienIch['checked'] ))
{
	$checked = 'checked';
}
?>




		<input type="checkbox" <?php echo $checked ?> name="tien_ich[]" value="<?php echo $tienIchList['id'] . '-' . $tienIch['id']?>" />
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
<li class='loai_tien_ich'>
	<?php echo $tienIchList['ten'];
	foreach ( $tienIchList['data'] as $tienIch ) {?>
</li>
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
