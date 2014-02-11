<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div class="moduletable"  >
	<table cellpadding="1" cellspacing="1" bordercolor="#f0f0f0" border="1" width="100%">
		<tbody>
		<tr>
			<td colspan="3" background="modules/mod_tygia/images/bg.gif"><img src="modules/mod_tygia/images/forex.gif"> <b>Tỷ giá:</b> (VNĐ)</td>
		</tr>
		<tr><td>
			<div style="height:70px;overflow:auto;">
				<table cellpadding="1" cellspacing="1" bordercolor="#f0f0f0" border="1" width="100%">
			<?php	
			for ($i=0; $i < count($aray_vForexs); $i++){
					echo '<tr><td>'.$aray_vForexs[$i].'</td><td>'.$array_vCosts[$i].'</td></tr>';
				}
			?>	
			</table></div>
		</td></tr>	
              <tr>
			<td colspan="3" align="center">
            	Nguồn: <a href="http://www.eximbank.com.vn/"><img src="modules/mod_tygia/images/logo-EXIM.gif"></a>
            </td>
		</tr>
	
	</tbody></table>		
</div>
