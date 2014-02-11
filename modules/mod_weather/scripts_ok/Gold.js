function ShowGoldPrice()
{
	function AddGoldPrice(Currency, Rate)
	{
		document.writeln('<tr bgcolor="#ffffff"><td >&nbsp;', Currency, '</td><td align=right>', Rate, '&nbsp;</td></tr>');
	}
	if (!AddHeader('Gold', 'Gi&#225; v&#224;ng 9999', 3, PageHost.concat(theme+'goldIcon.gif')))
		return;
	if (typeof(vGoldBuy) !='undefined') AddGoldPrice('Mua', vGoldBuy);
	if (typeof(vGoldSell)!='undefined') AddGoldPrice('B&#225;n', vGoldSell);
	document.writeln('<tr bgcolor="#ffffff"><td colspan=2 align=center><i>(Ngu&#7891;n: Cty SJC H&#224; N&#7897;i)</td></tr>');
	AddFooter();
}
ShowGoldPrice();