function ShowGoldPrice()
{
	function AddGoldPrice(loai,Currency, Rate)
	{
		document.writeln('<tr bgcolor="#ffffff" color="white"><td align=center>&nbsp;', loai, '</td><td align=center>&nbsp;', Currency, '</td><td align=center>', Rate, '&nbsp;</td></tr>');
	}
	if (!AddHeader('Gold', 'Gi&#225; v&#224;ng 9999', 3, PageHost.concat(theme+'goldIcon.png')))
		return;
		AddGoldPrice('Loại','Mua', 'Bán')
	if (typeof(vGoldSjcBuy) !='undefined' || typeof(vGoldSjcSell)!='undefined') AddGoldPrice('SJC', vGoldSjcBuy, vGoldSjcSell);
	if (typeof(vGoldSbjBuy) !='undefined' || typeof(vGoldSbjSell)!='undefined') AddGoldPrice('SBC', vGoldSbjBuy, vGoldSbjSell);
	document.writeln('<tr bgcolor="#ffffff"><td colspan=3 align=center><i>(Ngu&#7891;n: Cty SJC H&#224; N&#7897;i)</td></tr>');
	AddFooter();
}
ShowGoldPrice();