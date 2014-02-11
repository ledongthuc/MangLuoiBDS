function ShowForexRate()
{
	function AddCurrencyRate(Currency, Rate)
	{
		document.writeln('<tr bgcolor="#ffffff"><td >&nbsp;', Currency, '</td><td align=right>', Rate, '&nbsp;</td></tr>');
	}
	if (!AddForexHeader('Forex', 'Tỉ giá', 3, PageHost.concat(theme+'icon_stock.gif')))
		return;
	if (typeof(vForexs[1]) !='undefined' && typeof(vCosts[1]) !='undefined') AddCurrencyRate(vForexs[1], vCosts[1]);
	if (typeof(vForexs[2]) !='undefined' && typeof(vCosts[2]) !='undefined') AddCurrencyRate(vForexs[2], vCosts[2]);
	if (typeof(vForexs[3]) !='undefined' && typeof(vCosts[3]) !='undefined') AddCurrencyRate(vForexs[3], vCosts[3]);
	if (typeof(vForexs[4]) !='undefined' && typeof(vCosts[4]) !='undefined') AddCurrencyRate(vForexs[4], vCosts[4]);
	if (typeof(vForexs[5]) !='undefined' && typeof(vCosts[5]) !='undefined') AddCurrencyRate(vForexs[5], vCosts[5]);
	if (typeof(vForexs[6]) !='undefined' && typeof(vCosts[6]) !='undefined') AddCurrencyRate(vForexs[6], vCosts[6]);
	if (typeof(vForexs[7]) !='undefined' && typeof(vCosts[7]) !='undefined') AddCurrencyRate(vForexs[7], vCosts[7]);
	if (typeof(vForexs[8]) !='undefined' && typeof(vCosts[8]) !='undefined') AddCurrencyRate(vForexs[8], vCosts[8]);
	if (typeof(vForexs[9]) !='undefined' && typeof(vCosts[9]) !='undefined') AddCurrencyRate(vForexs[9], vCosts[9]);
	if (typeof(vForexs[10])!='undefined' && typeof(vCosts[10])!='undefined') AddCurrencyRate(vForexs[10], vCosts[10]);
	if (typeof(vForexs[11])!='undefined' && typeof(vCosts[11])!='undefined') AddCurrencyRate(vForexs[11], vCosts[11]);
	if (typeof(vForexs[12])!='undefined' && typeof(vCosts[12])!='undefined') AddCurrencyRate(vForexs[12], vCosts[12]);
	if (typeof(vForexs[13])!='undefined' && typeof(vCosts[13])!='undefined') AddCurrencyRate(vForexs[13], vCosts[13]);
	if (typeof(vForexs[14])!='undefined' && typeof(vCosts[14])!='undefined') AddCurrencyRate(vForexs[14], vCosts[14]);
	AddForexFooter();
}
ShowForexRate();

function AddForexHeader(Name, Header, Buttons, Symbol, AddChildTable)
{
	document.writeln('<table width="100%" border=0 cellspacing=0 cellpadding=1 class="title_forex"><tr><td>');

	if (Header!='')
	{
		document.writeln('<table width="100%" border=0 cellspacing=0 cellpadding=0>');
		document.writeln('<tr>');

		if (typeof(Symbol)!='undefined')
		{
			document.writeln('<td height=16><img src="', Symbol, '" border=0></td>');
		}

		document.writeln('<td height=16 width="100%" align=left>&nbsp;', Header, '</td>');

		if ((Buttons & 1) && fDSp)
		{
			document.write('<td width=15 align=right>');
			document.write('<a href="JavaScript:ItemMinimize(\x27', Name, '\x27)">');
			document.write('<img src="'+theme+'minus.gif" name="IDM_', Name, '" border=0 alt="Xem|Đóng">');
			document.write('</a></td>');
		}

		document.writeln('</tr></table>');
	}

	document.writeln('<table width="100%" border=0 cellspacing=0 cellpadding=0><tr><td id="IDM_', Name, '">');
	document.writeln('<table width="100%" border=0 cellspacing=0 cellpadding=0><tr><td>');
	if (typeof(AddChildTable)=='undefined')
	{
		document.writeln('<div style="position:related; overflow-y: scroll;height:82;width:100%;">');
		document.writeln('<table align=center width="100%" cellspacing=0 cellpadding=0 border=1>');
		LastChild = 1;
	}
	else
	{
		LastChild = 0;
	}
	return true;
}

function AddForexFooter()
{
	document.writeln('</table>');
	document.writeln('</div>');
	document.writeln('</td></tr>');
	document.writeln('<tr bgcolor="#ffffff"><td colspan=1 align=center><i>(Ngu&#7891;n: Ng&#226;n h&#224;ng<br> EXIMBANK VN)</td></tr>');
	document.writeln('</table>');
	document.writeln('</td></tr></table>');
	document.writeln('</td></tr></table>');
}
