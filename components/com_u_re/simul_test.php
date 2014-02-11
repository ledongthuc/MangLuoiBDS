<?php
class U_reSimulTest
{
	
	static  $_file=null;
	
	static  $_arr;
	
	function setFile($name="data.xml")
	{
		
		try
		{
			self::$_file= new SimpleXMLElement($name,null,true);
		}
		catch (Exception $e)
		{
			echo "Cannot find xml file";
			self::$_file=null;
			return ;
		}
		
	}
	
	/**
	 * set properties for property data.
	 */
	function setArrPro()
	{
		self::$_arr=array('id','title','type_id','kind_id','price','address','town_id','area_id',
				'living_space','rooms','bath_room','toilets','floor','advantages','description',
				'published','ordering','emphasis','date_created','checked_out','direction_id',
				'contact_name','contact_address', 'contact_phone', 'project_id' , 'living_width',
				'living_length','project_type_id','legal_id','currency_id','area_unit_id',
				'new_sest','realtor_id', 'map_lat' ,'map_lng' , 'success' ,'kind_value' ,'town_value');
	}
	
	/**
	 * set properties for type , kind , town, area , direction, project_type
	 * direction, legal , currency, area_unit, position DATA
	 */
	function setArrCommon()
	{
		self::$_arr=array('id','value','ordering');
	}
	
	/**
	 *
	 * set properties for project data
	 */
 	function setArrProj()
	{
	 	self::$_arr=array('id','name','address','town_id','town_value','area_id','area_value',
	 	'type_id','project_type_value','created_by','project_advantage_id','description',
	 	'short_description','start_date','end_date','people_area','status','investor','implement_unit',
	 	'management_unit','design_unit','total_area','number_of_floor','scheme','plain_diagram',
	 	'progress','contacts','newest','contact_address','contact_name','contact_phone','payment',
	 	'page_title','page_keywords','page_description','ordering','published','emphasis','checkout','checkout_time');
	}
	
	/**
	 * getData by id
	 */
	function _getById($id)
	{
		if(self::$_file==null) return;
		$data=self::$_file;
      	$list=array();
    	if(count($data)==0) return false;
		foreach ($data as $val)
		{
			if($val->id == $id)
				foreach (self::$_arr as $index)
					$list[$index]=$val->$index;
		}
		return $list;
	}
	/**
	 * get List project or property
	 */
	function _getList($field,$limitstart,$limit)
	{
	 	if(self::$_file==null) return;
		$data=self::$_file;
		$list=array();
		if(count($data)==0) return false;
		$arr=explode(',', $field);
		$total=count($data);
		$end=$limitstart+$limit;
		$k=-1;
		$i=0;
		foreach ($data as $val)
		{
			$k++;
			if($k>=$limitstart&&$k<$end)
			{
				foreach ($arr as $field)
				$list[$i][$field]=$val->$field;
				$i++;
			}
		}
		return $list;
	}
	
	function _getSameProject($value,$projectId,$item)
	{
		if(self::$_file==null) return;
		$data=self::$_file;
		self::setArrProj();
		$list=array();
		if(count($data)==0) return false;
		foreach ($data as $val)
		{
			if(strcmp($val->$item, $value)&& !strcmp($val->id,$projectId))
				foreach (self::$_arr as $index)
					$list[$index]=$val->$index;
		}
		return $list;
	}
	
	function _getListCommon()
	{
		if(self::$_file==null) return;
		$data=self::$_file;
		self::setArrCommon();
		$list=array();
		if(count($data)==0) return false;
		foreach (self::$_arr as $index)
			$list[$index]=$val->$index;
		return $list;
	}
	
	function getPropertyById($id)
	{
	 	self::setArrPro();
	 	return self::_getById($id);
	}
	 
	 function getPropertyList($field,$limitstart,$limit)
	 {
	 	echo "simul test";
	 	self::setFile( COM_U_RE_MODEL_DATAXML );
	 	self::setArrPro();
	 	return self::_getList($field, $limitstart, $limit);
	 }
	 
	 function getNextPropertyId($id)
	 {
	  	if(self::$_file==null) return;
		$data=self::$_file;
		self::setArrPro();
		$list=array();
		if(count($data)==0) return false;
		$flag=false;
		foreach ($data as $val)
		{
			if($flag==true)
			{
				foreach (self::$_arr as $index)
					$list[$index]=$val->$index;
				return $list;
			}
			
			if($val->id==$id)
			{
				$flag=true;
				continue;
			}
		}
	 }

	 function getSuccessProperty($realtorId)
	 {
		if(self::$_file==null) return;
		self::setArrPro();
		$data=self::$_file;
		$list=array();
		if(count($data)==0) return false;
		$i=0;
		foreach ($data as $val)
		{
			if($val->realtor_id==$realtorId && $val->success=='1')
			{
				foreach (self::$_arr as $index)
					$list[$i][$index]=$val->$index ;
				$i++;
			}
		}
		return $list;
	}

	function getTownList()
	{
		return self::_getListCommon();
	}
	
	function getAreaList()
	{
		return self::_getListCommon();
	}
	
	function getLegalList()
	{
		self::_getListCommon();
	}
	
	function getAdvantageList()
	{
		self::_getListCommon();
	}
	
	function getDirectionList()
	{
		self::_getListCommon();
	}
	
	function getPositionList()
	{
		self::_getListCommon();
	}
	
	function getKindList()
	{
		return self::_getListCommon();
	}
	
	function getTypeList()
	{
		return self::_getListCommon();
	}
	
	function getCurrencyList()
	{
		return self::_getListCommon();
	}
	
	function getAreaUnitList()
	{
		return self::_getListCommon();
	}
	
	function getPropertyListByRealtor($realtorId)
	{
		if(self::$_file==null) return;
		self::setArrPro();
		$data=self::$_file;
		$list=array();
		if(count($data)==0) return false;
		$i=0;
		foreach ($data as $val)
		{
			if($val->realtor_id==$realtorId)
			{
				foreach (self::$_arr as $index)
					$list[$i][$index]=$val->$index ;
				$i++;
			}
		}
		return $list;
	}
	
	function getProjectById($id)
	{
		self::setArrProj();
		self::_getById($id);
	}
	
	function getProjectsList($field, $limitstart, $limit)
	{
		self::setArrProj();
		return self::_getList($field, $limitstart, $limit);
	}
	
	function getProjectTypeName($id)
	{
		if(self::$_file==null) return;
		self::setArrProj();
		$data=self::$_file;
		$list=array();
		if(count($data)==0) return false;
		foreach ($data as $val)
		{
			if($val->id == $id)
				return $val->value;
		}
		
	}
	
	
	function getSameProjectsListByInvestor($projectId,$investor)
	{
		$item='investor';
		return self::_getSameProject($investor, $projectId, $item);
	}
	
	function getSameProjectsListByProjectType($projectId,$projType)
	{
		$item="type_id";
		return self::_getSameProject($projType, $projectId, $item);
	}
	
	/* project */
	 function getProjectList($field,$limitstart,$limit)
	 {
	 	echo "simul test";
	 	self::setFile( COM_U_RE_MODEL_DATAXML );
	 	self::setArrProj();
		return  self::_getList($field, $limitstart, $limit);
//	  print_r($t);
//	  exit;
	 }
	
}


//ClasGet::setFile("data.xml");
//$list=ClasGet::getPropertyById(20);
//if(!$list) echo "Không có dữ liệu";
//else echo $list['id'];


?>