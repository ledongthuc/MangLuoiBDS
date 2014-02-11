function ShowWeather()
{
	function AddCityWeather(City, Degree)
	{
		document.writeln('<tr bgcolor="#FFFFFF"><td >&nbsp;', Trim(City) , '</font></td><td align=right>', Trim(Degree), '&nbsp;&#176;&nbsp;</td></tr>');
	}

	if (!AddHeader('Weather', 'Th&#7901;i ti&#7871;t', 3, PageHost.concat(theme+'partly.cloudy.gif')))
	return;

	if (typeof(vHanoi)!='undefined'     && typeof(dHanoi)    !='undefined') AddCityWeather(vHanoi, dHanoi);
	if (typeof(vHaiPhong)!='undefined'       && typeof(dHaiPhong)      !='undefined') AddCityWeather(vHaiPhong, dHaiPhong);
	if (typeof(vDaNang)!='undefined'    && typeof(dDaNang)   !='undefined') AddCityWeather(vDaNang, dDaNang);
	if (typeof(vHoChiMinh)!='undefined' && typeof(dHoChiMinh)!='undefined') AddCityWeather(vHoChiMinh, dHoChiMinh);
	AddFooter();
}
ShowWeather();