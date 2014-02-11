<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="moduletable">
	<table cellpadding="1" cellspacing="1" bordercolor="#f0f0f0" border="1" width="100%">
		<tbody>
		<tr>
			<td colspan="3" background="modules/mod_giavang/images/bg.gif"><img src="modules/mod_giavang/images/gold.gif"> <b>Giá Vàng 9999:</b> (ngàn đ / l)</td>
		</tr>
		<tr>
			<td width="50">LOẠI</td>
			<td align="center">Mua</td>
			<td align="center">Bán</td>
		</tr>
		<tr>
			<td width="50">SBJ</td>
			<td align="center"><?php echo $vGoldSbjBuy; ?></td>
			<td align="center"><?php echo $vGoldSbjSell; ?></td>
		</tr>
		<tr>
			<td width="50">SJC</td>
			<td align="center"><?php echo $vGoldSjcBuy; ?></td>
			<td align="center"><?php echo $vGoldSjcSell; ?></td>
		</tr>
        <tr>
        	<td colspan="3"  align="center">
            	(Nguồn: <a href="http://www.sacombank-sbj.com/"><img src="modules/mod_giavang/images/logoSb.gif"></a>)
            </td>
        </tr>

	</tbody></table>		
</div>

