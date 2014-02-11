<?php
	defined('_JEXEC') or die('Restricted access'); 
?>
<table>
	<tr>
		<td>
		<?php echo JText::_('NUMBER_ONLINE');?>
		</td>
		<td>
		<?php 	echo $ShowDigit; ?>
		</td>
	</tr>
	
	<tr>
		<td>
		<div class='footer_tigia'>
		<a href="http://hcm.24h.com.vn/ttcb/giavang/giavang.php" target="blank">
		<img  alt="Giá vàng" src="./images/stories/giavang.png"/>
	<span class="footer_giavang">
	<?php echo JText::_('GOLD_PRICES');?>
	</span>
		</a>
	</div>
		</td>
		<td>
		<div class="footer_tigia">
		<a href="http://www.vietcombank.com.vn/exchangerates/" target="blank">
		<img alt="Tỉ giá" src="./images/stories/tigia.png"/>
			<span class="footer_giavang">
				<?php echo JText::_('RATE');?>		
			</span>
		</a>
	</div>
		</td>
	</tr>
	
	<tr>
		<td>
		<div class="footer_tigia">
		<a href="http://vnexpress.net/User/ck/hcm/" target="blank">
		<img alt="Giá chứng khoán" src="./images/stories/ttck.png"/>
		<span class="footer_giavang">
		<?php echo JText::_('STOCK_PRICES');?>
		</span>
		</a>
	</div>
		</td>
<!--		<td>-->
<!--		<div class='footer_logo'>-->
<!--		<a href="http://giaiphapbatdongsan.com/" target="blank">-->
<!--		<img alt="logo" src="./images/stories/logoiland.png"/>-->
<!--		</a>-->
<!--	</div>-->
<!--		</td>-->
	</tr>
	
</table>
