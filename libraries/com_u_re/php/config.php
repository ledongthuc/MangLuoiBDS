<?php
// Com URe config
if ( !class_exists( 'U_ReConfig' ) )
{
class U_ReConfig
{
	/*
	* Description: get instance of config
	* Author: Minh Chau
	* Version:
	* Date create: 16-03-2011
	*/
	function getParams()
	{
		// TODO: Add cache
		$configValue = U_ReConfig::_init();
		return $configValue;
	}
	
	/*
	* Description: Get config value by key
	* Author: Minh Chau
	* Version:
	* Date create: 14-03-2011
	*/
	function getValueByKey( $section, $key, $defaultValue='' )
	{
		$configValue = U_ReConfig::_init();
		$value = $configValue[$section][$key];
		if ( !$value )
		{
			return $defaultValue;
		}
		return $value;
	}
	
	/*
	* Description: clear cache
	* Author: Minh Chau
	* Version:
	* Date create: 14-03-2011
	*/
	function clearCache()
	{
		// TODO:
	}
	
	/*
	* Description: init config
	* Author: Minh Chau
	* Version:
	* Date create: 14-03-2011
	* Params: putToCache: boolean, true => put to cache, false => else
	*/
	function _init( $putToCache=false )
	{
		return parse_ini_file( JPATH_ROOT.DS.'com_u_re_config.ini', true );
	}
}
}
?>
